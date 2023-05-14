<?php
require 'header.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];

    // Periksa apakah kode atau nama sudah ada dalam database
    $stmt = $dbh->prepare("SELECT * FROM kategori_produk WHERE id = ? OR nama = ?");
    $stmt->execute([$id, $nama]);
    $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingProduct) {
        // Kode atau nama sudah ada dalam database
        $_SESSION['result'] = array(
            'response' => 'Gagal!',
            'message' => 'ID atau nama sudah ada dalam database.',
            'swal' => 'yes'
        );
    } else {

        // Simpan data ke database
        $stmt = $dbh->prepare("INSERT INTO kategori_produk (nama) VALUES (?)");
        $stmt->execute([$nama]);

        if ($stmt->rowCount() > 0) {
            // Produk berhasil ditambahkan
            $_SESSION['result'] = array(
                'response' => 'Berhasil!',
                'message' => 'Kategori Produk berhasil ditambahkan.',
                'swal' => 'no'
            );
        } else {
            // Gagal menyimpan produk
            $_SESSION['result'] = array(
                'response' => 'Gagal!',
                'message' => 'Gagal menambahkan kategori produk.',
                'swal' => 'yes'
            );
        }
    }
}
if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];

    // Periksa jika ada perubahan pada produk
    $stmt = $dbh->prepare("SELECT * FROM kategori_produk WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = $dbh->prepare("UPDATE kategori_produk SET nama = ? WHERE id = ?");
    $result = $stmt->execute([$nama, $id]);

    if ($result) {
        // Produk berhasil diperbarui
        $_SESSION['result'] = array(
            'response' => 'Berhasil!',
            'message' => 'Produk berhasil diperbarui.',
            'swal' => 'no'
        );
    } else {
        // Gagal memperbarui produk
        $_SESSION['result'] = array(
            'response' => 'Gagal!',
            'message' => 'Gagal memperbarui produk.',
            'swal' => 'yes'
        );
    }
} elseif (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    // Periksa apakah kategori produk dengan ID yang diberikan ada dalam database
    $stmt = $dbh->prepare("SELECT * FROM kategori_produk WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        // Kategori produk tidak ditemukan
        $_SESSION['result'] = array(
            'response' => 'Gagal!',
            'message' => 'Kategori Produk tidak ditemukan.',
            'swal' => 'yes'
        );
    } else {
        // Periksa apakah ada produk terkait
        $stmt = $dbh->prepare("SELECT COUNT(*) as count FROM produk WHERE kategori_produk_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Ada produk terkait, tampilkan pesan error
            $_SESSION['result'] = array(
                'response' => 'Gagal!',
                'message' => 'Tidak dapat menghapus kategori produk karena ada produk terkait.',
                'swal' => 'yes'
            );
        } else {
            // Hapus kategori produk dari database
            $stmt = $dbh->prepare("DELETE FROM kategori_produk WHERE id = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                // Kategori produk berhasil dihapus
                $_SESSION['result'] = array(
                    'response' => 'Berhasil!',
                    'message' => 'Kategori Produk berhasil dihapus.',
                    'swal' => 'no'
                );
            } else {
                // Gagal menghapus kategori produk
                $_SESSION['result'] = array(
                    'response' => 'Gagal!',
                    'message' => 'Gagal menghapus kategori produk.',
                    'swal' => 'yes'
                );
            }
        }
    }
}

?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Kategori Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active">Daftar Kategori Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-tags"></i> Daftar Kategori Produk </h5>
            <?php require 'alert.php' ?>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createKategoriModal">
                    <i class="bi bi-plus"></i> Create Kategori
                </button>
            </div>
            <hr>
            <!-- Table with hoverable rows -->
            <div class="table-responsive">
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="post">
                            <?php
                            $stmt = $dbh->prepare("SELECT * FROM kategori_produk");
                            $stmt->execute();
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($data as $row) {
                                $id = $row['id'];
                                $nama = $row['nama'];
                            ?>

                                <tr>
                                    <th><input type="text" class="form-control" id="id" name="id" value="<?= $id ?>"></th>
                                    <td><input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>"></td>
                                    <td>
                                        <button type="submit" class="btn btn-warning" name="ubah" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Kategori Produk <?= $nama ?>"><i class="bi bi-pencil-fill"></i></button>
                                        <button type="submit" class="btn btn-danger" name="hapus" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Kategori Produk <?= $nama ?>"><i class="bi bi-trash-fill"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </form>

                    </tbody>
                </table>
            </div><!-- End Table with hoverable rows -->

        </div>
    </div>
</main>
<!-- Modal Create Produk-->
<div class="modal fade" id="createKategoriModal" tabindex="-1" aria-labelledby="createProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-t-0" id="createProdukModalLabel"><i class="bi bi-plus"></i> Create Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for creating new product -->
                <form class="row g-3" action="" method="POST">
                    <div class="col-md-12">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- end modal -->

</main>
<?php
require 'footer.php';
?>