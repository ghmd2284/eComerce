<?php
require 'header.php';

if (isset($_POST['tambah'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];

    // Periksa apakah kode atau nama sudah ada dalam database
    $stmt = $dbh->prepare("SELECT * FROM produk WHERE kode = ? OR nama = ?");
    $stmt->execute([$kode, $nama]);
    $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingProduct) {
        // Kode atau nama sudah ada dalam database
        $_SESSION['result'] = array(
            'response' => 'Gagal!',
            'message' => 'Kode atau nama sudah ada dalam database.',
            'swal' => 'yes'
        );
    } else {
        $harga_jual = $_POST['harga_jual'];
        $harga_beli = $_POST['harga_beli'];
        $stok = $_POST['stok'];
        $min_stok = $_POST['min_stok'];
        $deskripsi = $_POST['deskripsi'];
        $kategoriProduk = $_POST['kategoriProduk'];

        // Simpan data ke database
        $stmt = $dbh->prepare("INSERT INTO produk (kode, nama, harga_jual, harga_beli, stok, min_stok, deskripsi, kategori_produk_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$kode, $nama, $harga_jual, $harga_beli, $stok, $min_stok, $deskripsi, $kategoriProduk]);

        if ($stmt->rowCount() > 0) {
            // Produk berhasil ditambahkan
            $_SESSION['result'] = array(
                'response' => 'Berhasil!',
                'message' => 'Produk berhasil ditambahkan.',
                'swal' => 'no'
            );
        } else {
            // Gagal menyimpan produk
            $_SESSION['result'] = array(
                'response' => 'Gagal!',
                'message' => 'Gagal menambahkan produk.',
                'swal' => 'yes'
            );
        }
    }
} elseif (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $min_stok = $_POST['min_stok'];
    $deskripsi = $_POST['deskripsi'];
    $kategoriProduk = $_POST['kategoriProduk'];

    // Periksa jika ada perubahan pada produk
    $stmt = $dbh->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $flag = false; // Flag untuk menandakan perubahan pada produk

    if ($row['nama'] != $nama || $row['harga_jual'] != $harga_jual || $row['harga_beli'] != $harga_beli || $row['stok'] != $stok || $row['min_stok'] != $min_stok || $row['deskripsi'] != $deskripsi || $row['kategori_produk_id'] != $kategoriProduk) {
        $flag = true;
    }

    if (!$flag) {
        // Tidak ada perubahan pada produk
        $_SESSION['result'] = array(
            'response' => 'Gagal!',
            'message' => 'Tidak ada perubahan pada produk.',
            'swal' => 'yes'
        );
    } else {
        // Update data produk di database
        $stmt = $dbh->prepare("UPDATE produk SET nama = ?, harga_jual = ?, harga_beli = ?, stok = ?, min_stok = ?, deskripsi = ?, kategori_produk_id = ? WHERE id = ?");
        $result = $stmt->execute([$nama, $harga_jual, $harga_beli, $stok, $min_stok, $deskripsi, $kategoriProduk, $id]);

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
    }
}
 elseif (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    // Periksa apakah produk dengan ID yang diberikan ada dalam database
    $stmt = $dbh->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        // Produk tidak ditemukan
        $_SESSION['result'] = array(
            'response' => 'Gagal!',
            'message' => 'Produk tidak ditemukan.',
            'swal' => 'yes'
        );
    } else {
        // Hapus produk dari database
        $stmt = $dbh->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            // Produk berhasil dihapus
            $_SESSION['result'] = array(
                'response' => 'Berhasil!',
                'message' => 'Produk berhasil dihapus.',
                'swal' => 'no'
            );
        } else {
            // Gagal menghapus produk
            $_SESSION['result'] = array(
                'response' => 'Gagal!',
                'message' => 'Gagal menghapus produk.',
                'swal' => 'yes'
            );
        }
    }
}


?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active">Daftar Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-list-ul"></i> Daftar Produk </h5>
           
            <?php require 'alert.php' ?>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProdukModal">
                    <i class="bi bi-plus"></i> Create Produk
                </button>
            </div> <hr>
            <!-- Table with hoverable rows -->
            <div class="table-responsive">


                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Min Stok</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $dbh->prepare("SELECT * FROM produk");
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($data as $row) {
                            $id = $row['id'];
                            $kode = $row['kode'];
                            $nama = $row['nama'];
                            $harga_jual = $row['harga_jual'];
                            $harga_beli = $row['harga_beli'];
                            $stok = $row['stok'];
                            $min_stok = $row['min_stok'];
                            $deskripsi = $row['deskripsi'];
                            $deskripsi_short = (strlen($deskripsi) > 30) ? substr($deskripsi, 0, 30) . '...' : $deskripsi;
                        ?>
                            <tr>
                                <th scope="row"><?= $id; ?></th>
                                <td><?= $nama; ?></td>
                                <td><?= $harga_jual; ?></td>
                                <td><?= $harga_beli; ?></td>
                                <td><?= $stok; ?></td>
                                <td><?= $min_stok; ?></td>
                                <td><?= $deskripsi_short; ?></td>
                                <td>
                                    <a href="javascript:;" onclick="modal('modal/view-produk.php?idview=<?= $id ?>')" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="View Produk <?= $nama ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="javascript:;" onclick="modal('modal/ubah-produk.php?idubah=<?= $id ?>')" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Produk <?= $nama ?>">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="javascript:;" onclick="modal('modal/hapus-produk.php?idhapus=<?= $id ?>')" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Produk <?= $nama ?>">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- End Table with hoverable rows -->

        </div>
    </div>
</main>


<!-- Modal Create Produk-->
<div class="modal fade" id="createProdukModal" tabindex="-1" aria-labelledby="createProdukModalLabel" aria-hidden="true">
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
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="col-md-12">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="col-md-6">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control" id="harga_jual" name="harga_jual" required>
                    </div>
                    <div class="col-md-6">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control" id="harga_beli" name="harga_beli" required>
                    </div>
                    <div class="col-md-6">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="text" class="form-control" id="stok" name="stok" required>
                    </div>
                    <div class="col-md-6">
                        <label for="min_stok" class="form-label">Min Stok</label>
                        <input type="text" class="form-control" id="min_stok" name="min_stok" required>
                    </div>
                    <div class="col-md-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="kategoriProduk" class="form-label">Kategori Produk</label>
                        <select class="form-select" id="kategoriProduk" name="kategoriProduk" required>
                            <option value="" selected disabled>Select Kategori Produk</option>
                            <?php
                            // Query untuk mendapatkan data kategori produk dari database
                            $stmt = $dbh->prepare("SELECT * FROM kategori_produk");
                            $stmt->execute();
                            $kategoriProduk = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($kategoriProduk as $kategori) {
                                echo "<option value='" . $kategori['id'] . "'>" . $kategori['nama'] . "</option>";
                            }
                            ?>
                        </select>
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


<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby=myProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content">
            <div class="modal-header" id="modal-header">
                <h5 class="modal-title m-t-0" id="myModalLabel"></i>Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body" id="modal-detail-body">



            </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function users(url) {
        $.ajax({
            type: "GET",
            url: url,
            beforeSend: function() {
                $('#modal-content').html('Sedang Memuat...');
            },
            success: function(result) {
                $('#modal-content').html(result);
            },
            error: function() {
                $('#modal-content').html('Terjadi Kesalahan.');
            }
        });
        $('#modal-detail').modal('show');
    }
</script>
<script type="text/javascript">
    function modal(url) {
        $.ajax({
            type: "GET",
            url: url,
            beforeSend: function() {
                $('#modal-detail-body').html('Sedang Memuat...');
            },
            success: function(result) {
                $('#modal-detail-body').html(result);
            },
            error: function() {
                $('#modal-detail-body').html('Terjadi Kesalahan.');
            }
        });
        $('#modal-detail').modal('show');
    }
</script>


<?php
require 'footer.php';
?>