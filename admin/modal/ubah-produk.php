<?php
require '../../dbkoneksi.php';
if (isset($_GET['idubah'])) {
    $get_id = $_GET['idubah'];
    $cek_produk = "SELECT * FROM produk WHERE id=?";
    $st = $dbh->prepare($cek_produk);
    $st->execute([$get_id]);
    $produk = $st->fetch();
    $id = $produk['id'];
    $kode = $produk['kode'];
    $nama = $produk['nama'];
    $harga_jual = $produk['harga_jual'];
    $harga_beli = $produk['harga_beli'];
    $stok = $produk['stok'];
    $min_stok = $produk['min_stok'];
    $deskripsi = $produk['deskripsi'];
    $kategori_id = $produk['kategori_produk_id'];
    $cek_kat = $dbh->prepare("SELECT produk.*, kategori_produk.nama AS kategori, kategori_produk.id AS id_kategori FROM produk
                    INNER JOIN kategori_produk ON kategori_produk.id = produk.kategori_produk_id WHERE produk.id=?");
    $cek_kat->execute([$get_id]);
    $kat = $cek_kat->fetch(PDO::FETCH_ASSOC);
    $kategori = $kat['kategori'];
    $id_kategori = $kat['id_kategori'];
    
}
?>
<div class="row">
    <div class="col-md-6">
        <label for="id" class="form-label">ID</label>

        <input type="text" class="form-control" id="id" name="id" value="<?= $id ?> " readonly>
    </div>
    <div class="col-md-6">
        <label for="kode" class="form-label">Kode</label>

        <input type="text" class="form-control" id="kode" name="kode" value="<?= $kode ?> " readonly>
    </div>
    <div class="col-md-12">
        <label for="nama" class="form-label">Nama Produk</label>

        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>">
    </div>
    <div class="col-md-6">
        <label for="harga_jual" class="form-label">Harga Jual</label>

        <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?= $harga_jual ?>">
    </div>
    <div class="col-md-6">
        <label for="harga_beli" class="form-label">Harga Beli</label>

        <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= $harga_beli ?>">
    </div>
    <div class="col-md-6">
        <label for="stok" class="form-label">Stok</label>

        <input type="text" class="form-control" id="stok" name="stok" value="<?= $stok ?>">
    </div>
    <div class="col-md-6">
        <label for="min_stok" class="form-label">Min Stok</label>

        <input type="text" class="form-control" id="min_stok" name="min_stok" value="<?= $min_stok ?>">
    </div>
    <div class="col-md-12">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $deskripsi ?>"></input>
    </div>
    <div class="col-md-12">
        <label for="kategoriProduk" class="form-label">Kategori Produk</label>
        <select class="form-select" id="kategoriProduk" name="kategoriProduk" value="">
        <option value="<?= $id_kategori ?>"><?= $kategori ?> -- Terpilih --</option>
            <?php
            $sql = "SELECT * FROM kategori_produk";
            $rskat = $dbh->query($sql);

            foreach ($rskat as $k) {
            ?>
                <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
            <?php
            }
            ?>


        </select>
    </div>
</div>
<hr>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
</div>