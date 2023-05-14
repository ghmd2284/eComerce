<?php
require 'header.php';

?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Pesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active">Daftar Pesanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-cart3"></i> Daftar Pesanan </h5>
            <hr>
            <!-- Table with hoverable rows -->
            <div class="table-responsive">


                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Tiket</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Alamat Pemesan</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jumlah Pesanan</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Produk Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $dbh->prepare("SELECT * FROM pesanan");
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($data as $index => $row) {
                            $no = $index + 1;
                            $no_tiket = $row['no_tiket'];
                            $tanggal = $row['tanggal'];
                            $nama_pemesan = $row['nama_pemesan'];
                            $alamat_pemesan = $row['alamat_pemesan'];
                            $no_hp = $row['no_hp'];
                            $email = $row['email'];
                            $jumlah_pesanan = $row['jumlah_pesanan'];
                            $deskripsi = $row['deskripsi'];

                            $cek_kat = $dbh->prepare("SELECT produk.*, kategori_produk.nama AS kategori, kategori_produk.id AS id_kategori FROM produk
                                INNER JOIN kategori_produk ON kategori_produk.id = produk.kategori_produk_id WHERE produk.id = ?");
                            $cek_kat->execute([$row['produk_id']]);
                            $kat = $cek_kat->fetch(PDO::FETCH_ASSOC);
                            $kategori = $kat['kategori'];
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $no_tiket; ?></td>
                                <td><?= $tanggal; ?></td>
                                <td><?= $nama_pemesan; ?></td>
                                <td><?= $alamat_pemesan; ?></td>
                                <td><?= $no_hp; ?></td>
                                <td><?= $email; ?></td>
                                <td><?= $jumlah_pesanan; ?></td>
                                <td><?= $deskripsi; ?></td>
                                <td><?= $kategori; ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

            </div><!-- End Table with hoverable rows -->

        </div>
    </div>

</main>
<?php
require 'footer.php';
?>