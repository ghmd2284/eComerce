<?php
require 'header.php';

$_kode = $_POST['kode'];
$unik = $_kode . rand(10000, 99999);
$_nama_pemesanan = $_POST['nama_pemesanan'];
$_alamat_pemesanan = $_POST['alamat_pemesanan'];
$_no_hp = $_POST['no_hp'];
$_email = $_POST['email'];
$_jumlah_pemesanan = $_POST['quantity'];
$_deskripsi = $_POST['deskripsi'];
$_produk_id = $_POST['produk_id'];

$_buy = $_POST['buy'];

// array data
$ar_data[] = $unik;
$ar_data[] = $_nama_pemesanan;
$ar_data[] = $_alamat_pemesanan;
$ar_data[] = $_no_hp;
$ar_data[] = $_email;
$ar_data[] = $_jumlah_pemesanan;
$ar_data[] = $_deskripsi;
$ar_data[] = $_produk_id;

$sql = "INSERT INTO pesanan (no_tiket,tanggal, nama_pemesan, alamat_pemesan, no_hp, email, jumlah_pesanan, deskripsi, produk_id) VALUES (?,CURDATE(),?,?,?,?,?,?,?)";
if (isset($sql)) {
    $st = $dbh->prepare($sql);
    $st->execute($ar_data);
}




//    header('location:index.php#produk');
?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php#produk">Home</a></li>
                <li><a href="">Details Produk</a></li>
                <li><a href="">Form Shopping</a></li>
                <li>Invoice</li>
            </ol>

        </div>
    </section><!-- End Breadcrumbs -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-9">
                <p class="mb-1 text-muted">Invoice >> <strong>ID: <a href="#" data-bs-toggle="modal" data-bs-target="#invoiceModal"><?= $unik ?></a></strong></p>

            </div>
            <div class="col-md-3 text-end">
                <a class="btn btn-light me-2" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
                <a class="btn btn-light" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
            </div>
        </div>
        <hr>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-primary shadow">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0">Terimkasih Sudah Berbelanja Disini</h5>
                        </div>
                        <div class="card-body">
                            <p class="lead text-center mb-0">Pesanan Anda Sudah Dicatat</p>
                            <div class="text-center mt-4">
                                <h6 class="mb-2">Nomor Pesanan:</h6>
                                <h4 class="text-primary mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#invoiceModal"><?= $unik ?></a></h4>
                                <p class="mt-2 mb-0">Silakan catat nomor pesanan Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h5 class="fw-bold mt-5 text-center">
            <a href="index.php#produk"><i class="fas fa-angle-left me-2"></i>Back to shopping</a>
        </h5>
    </div>
    <br>
    <br>
    <?php
    $sql = "SELECT * FROM pesanan WHERE no_tiket = ?";
    $st = $dbh->prepare($sql);
    $st->execute([$unik]);
    $produk = $st->fetch(PDO::FETCH_ASSOC);
    $tanggal = $produk['tanggal'];

    //query untuk mengambil data produk
    $sql = "SELECT * FROM produk WHERE id = ?";
    $st = $dbh->prepare($sql);
    $st->execute([$_produk_id]);
    $produk = $st->fetch(PDO::FETCH_ASSOC);
    $id_produk = $produk['id'];
    $nama_produk = $produk['nama'];
    $kategoriProduk = $produk['kategori_produk_id'];




    ?>
    <!-- Modal Invoice -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">Invoice #<?= $unik ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Nomor Tiket</th>
                                <td><?= $unik ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Pesanan</th>
                                <td><?= $tanggal ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Pemesan</th>
                                <td><?= $_nama_pemesanan ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Alamat Pemesan</th>
                                <td><?= $_alamat_pemesanan ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nomor HP</th>
                                <td><?= $_no_hp ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?= $_email ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Pesanan</th>
                                <td><?= $_jumlah_pemesanan ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi Pesanan</th>
                                <td><?= $_deskripsi ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Category</th>

                                <td><?php
                                    if ($kategoriProduk == 1) {
                                        echo 'Elektronik';
                                      } elseif ($kategoriProduk == 2) {
                                        echo 'Furniture';
                                      } elseif ($kategoriProduk == 3) {
                                        echo 'Minuman';
                                      } elseif ($kategoriProduk == 4) {
                                        echo 'Makanan';
                                      } else {
                                        echo 'ID kategori tidak valid';
                                      }
                                    ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    require 'footer.php';

    ?>