<?php
require 'header.php';
if (!isset($_GET['id'])) {
  exit("Anda Tidak Memiliki Akses!");
} 	

$_id = $_GET['id'];
// select * from produk where id = $_id;
//$sql = "SELECT a.*,b.nama as jenis FROM produk a
//INNER JOIN jenis_produk b ON a.jenis_produk_id=b.id WHERE a.id=?";
$sql = "SELECT * FROM produk WHERE id=?";
$st = $dbh->prepare($sql);
$st->execute([$_id]);
$row = $st->fetch();
//echo 'NAMA PRODUK ' . $row['nama'];
$img_src = 'assets/img/portfolio/portfolio-' . $row['nama'] . '.jpg';
$id_kategori = $row['kategori_produk_id'];


?>
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <ol>
        <li><a href="index.php#produk">Home</a></li>
        <li>Details Produk</li>
      </ol>
      <h2><?= $row['nama'] ?></h2>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Details Produk Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="row gy-4">
        <div class="col-lg-8">
          <div class="portfolio-details-slider swiper">
            <div class="swiper-wrapper align-items-center">

              <div class="swiper-slide">
                <img src="<?= $img_src ?>" alt="Foto <?= $row['nama']?>">
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>


        <div class="col-lg-4">
          <div class="portfolio-info">
            <h3>Produk Information</h3>
            <ul>
              <li><strong>Nama Produk </strong><?= $row['nama'] ?></li>
              <li><strong>Harga </strong><?= 'Rp' . number_format($row['harga_jual'], 0, ',', '.') ?></li>
              <li><strong>Stok </strong><?= $row['stok'] ?></li>
              <li><strong>Category </strong>
                <?php
                if ($id_kategori == 1) {
                  echo 'Elektronik';
                } elseif ($id_kategori == 2) {
                  echo 'Furniture';
                } elseif ($id_kategori == 3) {
                  echo 'Minuman';
                } elseif ($id_kategori == 4) {
                  echo 'Makanan';
                } else {
                  echo 'ID kategori tidak valid';
                }
                ?></li>
            </ul>

          </div>
          <div class="portfolio-description">
            <h2>Deskripsi Produk</h2>
            <p><?= $row['deskripsi'] ?></p>
          </div>
          <div>
            <a class="btn btn-primary btn-lg d-block w-100" href="form-shop.php?id=<?= $row['id'] ?>">Checkout</a>
          </div>
        </div>

      </div>

    </div>
    <h5 class="fw-bold mt-5 text-center">
                                        <a href="index.php#produk"><i class="fas fa-angle-left me-2"></i>Back to shopping</a>
                                    </h5>
  </section><!-- End Details Produk Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php
require 'footer.php';

?>