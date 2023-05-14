<?php
require 'header.php';

?>
<!-- ======= Hero Section ======= -->
<section id="hero">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    <div class="carousel-inner" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg)">
        <div class="carousel-container">
          <div class="container">
            <h2 class="animated fadeInDown">Welcome to <span class="elegant-text">TrendTrove</span></h2>
            <p class="animated fadeInUp">Discover the perfect blend of technology, exquisite furniture, and delightful cuisine.</p>
            <a href="#about" class="btn-get-started animated fadeInUp scrollto">Read More</a>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg)">
        <div class="carousel-container">
          <div class="container">
            <h2 class="animated fadeInDown">Temukan Penawaran Menarik di Ecommerce Kami</h2>
            <p class="animated fadeInUp"> Dapatkan Diskon Menarik untuk Berbagai Produk Unggulan Kami. Jangan Lewatkan Kesempatan Ini, Segera Beli Sekarang!</p>
            <a href="#produk" class="btn-get-started animated fadeInUp scrollto">Beli Sekarang</a>
          </div>
        </div>
      </div>
    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>

  </div>
</section><!-- End Hero -->
<!-- End Hero -->

<main id="main">

  <!-- ======= Portfolio Section ======= -->
  <section id="produk" class="portfolio">
    <div class="container-fluid">

      <div class="section-title">
        <h2>Produk</h2>
        <h3>Check our <span>Produk</span></h3>
        <p>Kami Menjual Beberapa Produk sebagai berikut.</p>
      </div>
      <?php
      $sql = "SELECT * FROM kategori_produk";
      $stmt = $dbh->query($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Filter
      $filters_html = '<li data-filter="*" class="filter-active">All</li>';
      foreach ($result as $row) {
        $filter = 'filter-' . ($row['id']);
        $filters_html .= '<li data-filter=".' . $filter . '">' . $row['nama'] . '</li>';
      }

      $sql = "SELECT * FROM produk";
      $stmt = $dbh->query($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      // Inisialisasi array Produk_items
      $portfolio_items = array();

      // Looping untuk setiap baris data yang diambil dari database
      foreach ($result as $row) {
        // Menambahkan data dari database ke dalam array portfolio_items
        $portfolio_items[] = array(
          'filter' => 'filter-' . ($row['kategori_produk_id']),
          'img_src' => 'assets/img/portfolio/portfolio-' . $row['nama'] . '.jpg',
          'title' => $row['nama'],
          'category' => number_format($row['harga_jual']),
          'lightbox_title' => $row['nama'],
          'details_url' => 'details-produk.php?id=' . $row['id'],
        );
      }

      foreach ($portfolio_items as $item) {
        // Lakukan operasi yang diinginkan dengan data portfolio_items
      }
      ?>
      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <?= $filters_html; ?>
          </ul>
        </div>
      </div>
      <div class="row portfolio-container justify-content-center">
        <?php foreach ($portfolio_items as $item) { ?>
          <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item <?= $item['filter']; ?>">
            <div class="portfolio-wrap">
              <img src="<?= $item['img_src']; ?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><?= $item['title']; ?></h4>
                <p>Rp <?= $item['category']; ?></p>
                <div class="portfolio-links">
                  <a href="<?= $item['img_src']; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= $item['lightbox_title']; ?>"><i class="bx bx-plus"></i></a>
                  <a href="<?= $item['details_url']; ?>" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End portfolio item -->
        <?php } ?>
      </div>
      <!-- End portfolio container -->

    </div>
    </div>

    </div>

    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container">

      <div class="text-center">
        <h3>Panggilan untuk Tindakan</h3>
        <p> Temukan Pengalaman Berbelanja yang Luar Biasa dengan Ecommerce Kami. 
          Kami Menyediakan Produk Berkualitas Tinggi dan Pelayanan Terbaik untuk Kepuasan Anda.
        </p>
        <a class="cta-btn" href="#produk">Beli Sekarang</a>
      </div>

    </div>
  </section><!-- End Cta Section -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
          <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a>
        </div>

        <div class="col-xl-5 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
          <h3>Temukan Dunia Elektronik, Furniture, Makanan, dan Minuman</h3>
          <p>Jelajahi berbagai produk elektronik berkualitas tinggi, furniture bergaya, makanan lezat, dan minuman menyegarkan. Kami menyediakan pengalaman belanja yang menghadirkan segala kebutuhan Anda.</p>

          <div class="icon-box">
            <div class="icon"><i class="bx bx-laptop"></i></div>
            <h4 class="title"><a href="">Elektronik</a></h4>
            <p class="description">Telusuri koleksi elektronik terkini kami untuk meningkatkan gaya hidup digital Anda. Kami menawarkan berbagai gadget, perangkat, dan aksesori teknologi.</p>
          </div>

          <div class="icon-box">
            <div class="icon"><i class="bx bx-chair"></i></div>
            <h4 class="title"><a href="">Furniture</a></h4>
            <p class="description">Ubah ruang hidup Anda dengan seleksi furniture yang eksklusif. Temukan furnitur bergaya dan fungsional yang akan meningkatkan suasana rumah Anda.</p>
          </div>

          <div class="icon-box">
            <div class="icon"><i class="bx bx-cookie"></i></div>
            <h4 class="title"><a href="">Makanan & Minuman</a></h4>
            <p class="description">Nikmati perjalanan kuliner dengan makanan lezat dan minuman menyegarkan kami. Dari makanan ringan gourmet hingga anggur pilihan, kami menawarkan berbagai hidangan yang memanjakan lidah.</p>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- End About Section -->

  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts section-bg">
    <div class="container-fluid">

      <div class="row counters">

        <div class="col-lg-3 col-6 text-center">
          <span data-purecounter-start="0" data-purecounter-end="12232" data-purecounter-duration="1" class="purecounter"></span>
          <p>Terjual</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span data-purecounter-start="0" data-purecounter-end="1521" data-purecounter-duration="1" class="purecounter"></span>
          <p>Produk</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
          <p>Costomer</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span data-purecounter-start="0" data-purecounter-end="11115" data-purecounter-duration="1" class="purecounter"></span>
          <p>Rating</p>
        </div>

      </div>

    </div>
  </section><!-- End Counts Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container-fluid">

      <div class="section-title">
        <h2>Services</h2>
        <h3>Check our <span>Services</span></h3>
        <p>Jelajahi Berbagai Layanan Kami yang Dirancang untuk Memenuhi Kebutuhan Anda dan Melampaui Harapan. 
          Mendorong Kesuksesan Anda, Setiap Langkahnya</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-xl-10">
          <div class="row">
            <div class="col-lg-4 col-md-6 icon-box">
              <div class="icon"><i class="bx bx-fast-forward"></i></div>
              <h4 class="title"><a href="#service">Pengiriman Cepat</a></h4>
              <p class="description">Kecepatan dalam Setiap Langkah! Nikmati Layanan Pengiriman Kilat 
                Kami untuk Memastikan Produk Anda Tiba dengan Cepat dan Tepat Waktu. 
                Percayakan Pengiriman Anda kepada Kami dan Rasakan Kepraktisan dan Kecepatan dalam Setiap Pesanan!</p>
            </div>
            <div class="col-lg-4 col-md-6 icon-box">
              <div class="icon"><i class="bx bxs-truck"></i></div>
              <h4 class="title"><a href="#service">Nikmati Gratis Ongkir</a></h4>
              <p class="description">Belanja di Ecommerce Kami dan Dapatkan Keuntungan Pengiriman Gratis untuk Setiap Pembelian. 
                Rasakan Kemudahan dan Manfaatkan Layanan Gratis Ongkir Kami Sekarang Juga!</p>
            </div>
            <div class="col-lg-4 col-md-6 icon-box">
              <div class="icon"><i class='bx bx-badge-check'></i></div>
              <h4 class="title"><a href="#service">Kualitas Terbaik, Kepuasan Terjamin!</a></h4>
              <p class="description">Temukan Produk dengan Standar Kualitas Tertinggi di Ecommerce Kami. 
                Kami Memberikan yang Terbaik untuk Anda, Jaminan Kualitas yang Tak Tertandingi!</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Services Section -->





  <?php
  require 'footer.php';

  ?>