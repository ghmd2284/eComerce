<?php 
// Mendapatkan tanggal hari ini
$date = date("Y-m-d");

// Mendapatkan tanggal 7 hari yang lalu
$week = date("Y-m-d", strtotime("-7 days"));

// Mendapatkan tanggal 1 bulan yang lalu
$month = date("Y-m-d", strtotime("-1 month"));

//=============================================================================================//

//Filter Jumlah Pesanan 
$stmtSalesToday = $dbh->prepare("SELECT COALESCE(SUM(jumlah_pesanan), 0) FROM pesanan WHERE tanggal = :tanggal");
$stmtSalesToday->bindParam(':tanggal', $date);
$stmtSalesToday->execute();
$totalSalesToday = $stmtSalesToday->fetchColumn();

$stmtSalesWeek = $dbh->prepare("SELECT SUM(jumlah_pesanan) FROM pesanan WHERE tanggal BETWEEN :start_date AND :end_date");
$stmtSalesWeek->bindParam(':start_date', $week);
$stmtSalesWeek->bindParam(':end_date', $date);
$stmtSalesWeek->execute();
$totalSalesWeek = $stmtSalesWeek->fetchColumn();

$stmtSalesMonth = $dbh->prepare("SELECT SUM(jumlah_pesanan) FROM pesanan WHERE tanggal BETWEEN :start_date AND :end_date");
$stmtSalesMonth->bindParam(':start_date', $month);
$stmtSalesMonth->bindParam(':end_date', $date);
$stmtSalesMonth->execute();
$totalSalesMonth = $stmtSalesMonth->fetchColumn();

// ===================================================================================== //


// Filter Revuene
// Menghitung total keuntungan hari ini
 $sqlKeuntunganToday = "SELECT SUM((harga_jual - harga_beli) * jumlah_pesanan)
                FROM produk
                INNER JOIN pesanan ON produk.id = pesanan.produk_id
                WHERE pesanan.tanggal = :tanggal";

 $stmtKeuntunganToday = $dbh->prepare($sqlKeuntunganToday);
 $stmtKeuntunganToday->bindParam(':tanggal', $date);
 $stmtKeuntunganToday->execute();
 $totalKeuntunganToday = $stmtKeuntunganToday->fetchColumn();

 // Menghitung total keuntungan dalam 7 hari terakhir
 $sqlKeuntunganWeek = "SELECT SUM((harga_jual - harga_beli) * jumlah_pesanan)
    FROM produk
    INNER JOIN pesanan ON produk.id = pesanan.produk_id
    WHERE pesanan.tanggal BETWEEN :start_date AND :end_date";

 $stmtKeuntunganWeek = $dbh->prepare($sqlKeuntunganWeek);
 $stmtKeuntunganWeek->bindParam(':start_date', $week);
 $stmtKeuntunganWeek->bindParam(':end_date', $date);
 $stmtKeuntunganWeek->execute();
 $totalKeuntunganWeek = $stmtKeuntunganWeek->fetchColumn();

 // Menghitung total keuntungan dalam 1 bulan terakhir
 $sqlKeuntunganMonth = "SELECT SUM((harga_jual - harga_beli) * jumlah_pesanan)
    FROM produk
    INNER JOIN pesanan ON produk.id = pesanan.produk_id
    WHERE pesanan.tanggal BETWEEN :start_date AND :end_date";

 $stmtKeuntunganMonth = $dbh->prepare($sqlKeuntunganMonth);
 $stmtKeuntunganMonth->bindParam(':start_date', $month);
 $stmtKeuntunganMonth->bindParam(':end_date', $date);
 $stmtKeuntunganMonth->execute();
 $totalKeuntunganMonth = $stmtKeuntunganMonth->fetchColumn();

 // ==================================================================================== //

 // Filter Costomer
 $stmtCustomersToday = $dbh->prepare("SELECT COUNT(DISTINCT nama_pemesan) FROM pesanan WHERE tanggal = :tanggal");
$stmtCustomersToday->bindParam(':tanggal', $date);
$stmtCustomersToday->execute();
$totalCustomersToday = $stmtCustomersToday->fetchColumn();

$stmtCustomersThisWeek = $dbh->prepare("SELECT COUNT(DISTINCT nama_pemesan) FROM pesanan WHERE tanggal BETWEEN :start_date AND :end_date");
$stmtCustomersThisWeek->bindParam(':start_date', $week);
$stmtCustomersThisWeek->bindParam(':end_date', $date);
$stmtCustomersThisWeek->execute();
$totalCustomersThisWeek = $stmtCustomersThisWeek->fetchColumn();

$stmtCustomersThisMonth = $dbh->prepare("SELECT COUNT(DISTINCT nama_pemesan) FROM pesanan WHERE tanggal BETWEEN :start_date AND :end_date");
$stmtCustomersThisMonth->bindParam(':start_date', $month);
$stmtCustomersThisMonth->bindParam(':end_date', $date);
$stmtCustomersThisMonth->execute();
$totalCustomersThisMonth = $stmtCustomersThisMonth->fetchColumn();

// =================================================================

// Recent Sale
$stmtRecentSales = $dbh->prepare("SELECT pesanan.no_tiket, pesanan.nama_pemesan, produk.nama, produk.harga_jual, pesanan.jumlah_pesanan FROM pesanan JOIN produk ON pesanan.produk_id = produk.id ORDER BY pesanan.tanggal DESC LIMIT 10");
$stmtRecentSales->execute();
$dataRecentSales = $stmtRecentSales->fetchAll(PDO::FETCH_ASSOC);



?>
