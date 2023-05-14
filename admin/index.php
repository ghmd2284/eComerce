<?php
require 'header.php';
require 'library.php'

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->


      <!-- Sales Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">

          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><a class="dropdown-item" id="todayFilter" onclick="toggleSales('todaysale')">Today</a></li>
              <li><a class="dropdown-item" id="weekFilter" onclick="toggleSales('weeksale')">This Week</a></li>
              <li><a class="dropdown-item" id="monthFilter" onclick="toggleSales('monthsale')">This Month</a></li>
            </ul>
          </div>

          <div class="card-body" id="salesTodayCard">
            <h5 class="card-title" id="salesTitle">Sales <span>| Today</span></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-cart"></i>
              </div>
              <div class="ps-3">
                <h6 id="salesValue"><?= $totalSalesToday ?></h6>
              </div>
            </div>
          </div>

        </div>
      </div><!-- End Sales Card -->

      <!-- Revenue Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card revenue-card">

          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item" onclick="toggleKeuntungan('todaykeuntungan')">Today</a></li>
              <li><a class="dropdown-item" onclick="toggleKeuntungan('weekkeuntungan')">This Month</a></li>
              <li><a class="dropdown-item" onclick="toggleKeuntungan('monthkeuntungan')">This Year</a></li>
            </ul>
          </div>

          <div class="card-body">
            <h5 class="card-title" id="keuntunganTitle">Revenue <span>| This Today</span></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-currency-dollar"></i>
              </div>
              <div class="ps-3">
                <h6 id="keuntunganValue">Rp <?= number_format($totalKeuntunganToday) ?></h6>

              </div>
            </div>
          </div>

        </div>
      </div><!-- End Revenue Card -->

      <!-- Customers Card -->
      <div class="col-xxl-4 col-xl-12">

        <div class="card info-card customers-card">


          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><a class="dropdown-item" href="#" onclick="toggleCustomers('today')">Today</a></li>
              <li><a class="dropdown-item" href="#" onclick="toggleCustomers('week')">This Week</a></li>
              <li><a class="dropdown-item" href="#" onclick="toggleCustomers('month')">This Month</a></li>
            </ul>
          </div>

          <div class="card-body">
            <h5 class="card-title">Customers <span id="customersFilter">| Today</span></h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                <h6 id="customersValue"><?= $totalCustomersToday ?></h6>
              </div>
            </div>
          </div>

        </div>

      </div><!-- End Customers Card -->

      <!-- Reports -->

      <!-- End Reports -->

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">
            <h5 class="card-title">Recent Sales</h5>
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                  <th scope="col">Qty</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dataRecentSales as $index => $row) : ?>
                  <tr>
                    <th scope="row"><a href="#"><?= $row['no_tiket'] ?></a></th>
                    <td><?= $row['nama_pemesan'] ?></td>
                    <td><a href="#" class="text-primary"><?= $row['nama'] ?></a></td>
                    <td>Rp<?= number_format($row['harga_jual']) ?></td>
                    <td><?= $row['jumlah_pesanan'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- End Recent Sales -->

    </div>
  </section>

</main><!-- End #main -->

<?php
require 'footer.php';

?>