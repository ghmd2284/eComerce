<?php
require 'header.php';
if (isset($_POST['upload'])) {
    $nama = $_POST['nama'];

    // Periksa apakah foto sudah diunggah
    if ($_FILES['foto']['error'] === UPLOAD_ERR_NO_FILE) {
        // Foto belum diunggah
        $_SESSION['result'] = array(
            'response' => 'Gagal!',
            'message' => 'Mohon unggah foto produk.',
            'swal' => 'yes'
        );
    } else {
        $foto = $_FILES['foto'];
        $foto_name = $foto['name'];
        $foto_tmp = $foto['tmp_name'];
        $foto_ext = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));

        // Menentukan ekstensi yang diperbolehkan
        $allowed_extensions = array('jpg', 'jpeg', 'png');

        // Memeriksa apakah ekstensi file diunggah diperbolehkan
        if (!in_array($foto_ext, $allowed_extensions)) {
            $_SESSION['result'] = array(
                'response' => 'Gagal!',
                'message' => 'Ekstensi file tidak valid. Hanya file dengan ekstensi JPG, JPEG, dan PNG yang diperbolehkan.',
                'swal' => 'yes'
            );
        } else {
            // Menentukan nama file baru berdasarkan input nama
            $new_foto_name = 'portfolio-' . $nama . '.' . $foto_ext;

            // Menentukan lokasi penyimpanan foto
            $foto_destination = '../assets/img/portfolio/' . $new_foto_name;

            // Cek apakah file dengan nama yang sama sudah ada
            if (file_exists($foto_destination)) {
                // File sudah ada
                $_SESSION['result'] = array(
                    'response' => 'Gagal!',
                    'message' => 'File dengan nama tersebut sudah ada.',
                    'swal' => 'yes'
                );
            } else {
                // Memindahkan foto ke lokasi tujuan dengan nama baru
                if (move_uploaded_file($foto_tmp, $foto_destination)) {
                    // Foto berhasil diunggah
                    $_SESSION['result'] = array(
                        'response' => 'Berhasil!',
                        'message' => 'Foto berhasil diunggah dengan nama file: ' . $new_foto_name,
                        'swal' => 'no'
                    );
                } else {
                    // Gagal mengunggah foto
                    $_SESSION['result'] = array(
                        'response' => 'Gagal!',
                        'message' => 'Gagal mengunggah foto.',
                        'swal' => 'yes'
                    );
                }
            }
        }
    }
} elseif (isset($_POST['ubah'])) {
    $nama = $_POST['nama'];

    // Periksa apakah foto sudah diunggah
    if ($_FILES['foto']['error'] === UPLOAD_ERR_NO_FILE) {
        // Foto belum diunggah
        $_SESSION['result'] = array(
            'response' => 'Gagal!',
            'message' => 'Mohon unggah foto produk.',
            'swal' => 'yes'
        );
    } else {
        $foto = $_FILES['foto'];
        $foto_name = $foto['name'];
        $foto_tmp = $foto['tmp_name'];
        $foto_ext = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));

        // Menentukan ekstensi yang diperbolehkan
        $allowed_extensions = array('jpg', 'jpeg', 'png');

        // Memeriksa apakah ekstensi file diunggah diperbolehkan
        if (!in_array($foto_ext, $allowed_extensions)) {
            $_SESSION['result'] = array(
                'response' => 'Gagal!',
                'message' => 'Ekstensi file tidak valid. Hanya file dengan ekstensi JPG, JPEG, dan PNG yang diperbolehkan.',
                'swal' => 'yes'
            );
        } else {
            // Menentukan nama file berdasarkan input nama dan ekstensi yang sama
            $new_foto_name = 'portfolio-' . $nama . '.' . $foto_ext;

            // Menentukan lokasi penyimpanan foto
            $foto_destination = '../assets/img/portfolio/' . $new_foto_name;

            // Memindahkan foto baru ke lokasi tujuan dengan nama baru
            if (move_uploaded_file($foto_tmp, $foto_destination)) {
                $_SESSION['result'] = array(
                    'response' => 'Berhasil!',
                    'message' => 'Foto berhasil diunggah dengan nama file: ' . $new_foto_name,
                    'swal' => 'no'
                );
            } else {
                $_SESSION['result'] = array(
                    'response' => 'Gagal!',
                    'message' => 'Gagal mengunggah foto.',
                    'swal' => 'yes'
                );
            }
        }
    }
}



?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Upload Foto Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item active">Upload Foto Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-md-12">

                <!-- Default Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-file-image"></i> Upload Foto Produk</h5>
                        <?php require 'alert.php' ?>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahFoto"><i class="bi bi-pencil-fill"></i> Ubah Foto</button>
                            </div>
                        </div>
                        <hr>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"> Nama Produk</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="nama" id="nama">
                                        <option selected>Pilih Nama Produk</option>
                                        <?php
                                        $sql = "SELECT * FROM produk";
                                        $rsp = $dbh->query($sql);

                                        foreach ($rsp as $p) {

                                        ?>
                                            <option value="<?= $p['nama'] ?>"><?= $p['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="foto" name="foto">
                                </div>
                            </div>
<hr>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="upload"><i class="bi bi-cloud-upload-fill"></i> Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End Default Card -->
            </div>
        </div>
    </section>

</main>
<!-- Large Modal Ubah Foto Produk -->
<div class="modal fade" id="ubahFoto" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="nama" id="nama">
                                <option selected>Pilih Nama Produk</option>
                                <?php
                                $sql = "SELECT * FROM produk";
                                $rsp = $dbh->query($sql);

                                foreach ($rsp as $p) {

                                ?>
                                    <option value="<?= $p['nama'] ?>"><?= $p['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="ubah" id="ubah">Ubah</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div><!-- End Large Modal-->


<?php
require 'footer.php';
?>