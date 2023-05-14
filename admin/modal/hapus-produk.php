<?php
require '../../dbkoneksi.php';
if (isset($_GET['idhapus'])) {
    $get_id = $_GET['idhapus'];
    $cek_produk = "SELECT * FROM produk WHERE id=?";
    $st = $dbh->prepare($cek_produk);
    $st->execute([$get_id]);
    $produk = $st->fetch();
    $id = $produk['id'];
    $kode = $produk['kode'];
    $nama = $produk['nama'];
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
</div>
<hr>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
</div>