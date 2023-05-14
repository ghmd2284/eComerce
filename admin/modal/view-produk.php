<?php
require '../../dbkoneksi.php';
if (isset($_GET['idview'])) {
    $get_id = $_GET['idview'];
    $cek_produk = "SELECT * FROM produk WHERE id=?";
    $st = $dbh->prepare($cek_produk);
    $st->execute([$get_id]);
    $produk = $st->fetch();
    $kode = $produk['kode'];
    $nama = $produk['nama'];
    $harga_jual = $produk['harga_jual'];
    $harga_beli = $produk['harga_beli'];
    $stok = $produk['stok'];
    $min_stok = $produk['min_stok'];
    $deskripsi = $produk['deskripsi'];
    $cek_kat = $dbh->prepare("SELECT produk.*, kategori_produk.nama AS kategori From produk
                    INNER JOIN kategori_produk ON kategori_produk.id = kategori_produk_id");
    $cek_kat->execute();
    $kat = $cek_kat->fetch(PDO::FETCH_ASSOC);
    $kategori = $kat['kategori'];
}
?>

<div class="col-md-12">
    <table class="table">
        <tr>
            <th scope="row">Kode</th>
            <td><?= $kode ?></td>
        </tr>
        <tr>
            <th scope="row">Nama Produk</th>
            <td><?= $nama ?></td>
        </tr>
        <tr>
            <th scope="row">Harga Jual</th>
            <td><?= $harga_jual ?></td>
        </tr>
        <tr>
            <th scope="row">Harga Beli</th>
            <td><?= $harga_beli ?></td>
        </tr>
        <tr>
            <th scope="row">Stok</th>
            <td><?= $stok ?></td>
        </tr>
        <tr>
            <th scope="row">Min Stok</th>
            <td><?= $min_stok ?></td>
        </tr>
        <tr>
            <th scope="row">Deskripsi</th>
            <td><?= $deskripsi ?></td>
        </tr>
        <tr>
            <th scope="row">Kategori Produk</th>
            <td><?= $kategori ?>
            </td>
        </tr>
        <tr>
            <th scope="row">Foto Produk</th>
            <td>
    <?php
    // Memeriksa ekstensi file yang ada di folder
    $ekstensi = ['jpg', 'png', 'jpeg'];
    $namaFile = '';
    $ekstensiFile = '';
    foreach ($ekstensi as $ext) {
        $file = '../../assets/img/portfolio/portfolio-' . $nama . '.' . $ext;
        if (file_exists($file)) {
            $namaFile = $file;
            $ekstensiFile = $ext;
            break;
        }
    }
    ?>
    <img src="<?= '../assets/img/portfolio/portfolio-' . $nama . '.' . $ekstensiFile ?>" class="img-fluid img-thumbnail" alt="Foto Produk <?= $nama ?>">
</td>

        </tr>
    </table>

    </table>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>