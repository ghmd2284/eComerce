  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>TrendTrove</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    //===========================================================///
    function toggleSales(filter) {
      var salesTitle = document.getElementById("salesTitle");
      var salesValue = document.getElementById("salesValue");

      if (filter === 'todaysale') {
        salesTitle.innerHTML = "Sales <span>| Today</span>";
        salesValue.innerHTML = "<?= $totalSalesToday ?>";
      } else if (filter === 'weeksale') {
        salesTitle.innerHTML = "Sales <span>| This Week</span>";
        salesValue.innerHTML = "<?= $totalSalesWeek ?>";
      } else if (filter === 'monthsale') {
        salesTitle.innerHTML = "Sales <span>| This Month</span>";
        salesValue.innerHTML = "<?= $totalSalesMonth ?>";
      }
    }

    //=======================================================================///

    function toggleKeuntungan(filter) {
      var keuntunganTitle = document.getElementById("keuntunganTitle");
      var keuntunganValue = document.getElementById("keuntunganValue");

      if (filter === 'todaykeuntungan') {
        keuntunganTitle.innerHTML = "Revenue <span>| Today</span>";
        keuntunganValue.innerHTML = "Rp <?= number_format($totalKeuntunganToday) ?>";
      } else if (filter === 'weekkeuntungan') {
        keuntunganTitle.innerHTML = "Revenue <span>| This Week</span>";
        keuntunganValue.innerHTML = "Rp <?= number_format($totalKeuntunganWeek) ?>";
      } else if (filter === 'monthkeuntungan') {
        keuntunganTitle.innerHTML = "Revenue <span>| This Month</span>";
        keuntunganValue.innerHTML = "Rp <?= number_format($totalKeuntunganMonth) ?>";
      }
    }

    // =========================================================================== //

    function toggleCustomers(filter) {
      var customersFilter = document.getElementById("customersFilter");
      var customersValue = document.getElementById("customersValue");

      if (filter === 'today') {
        customersFilter.innerHTML = "| Today";
        customersValue.innerHTML = "<?= $totalCustomersToday ?>";
      } else if (filter === 'week') {
        customersFilter.innerHTML = "| This Week";
        customersValue.innerHTML = "<?= $totalCustomersThisWeek ?>";
      } else if (filter === 'month') {
        customersFilter.innerHTML = "| This Month";
        customersValue.innerHTML = "<?= $totalCustomersThisMonth ?>";
      }
    }
  </script>

  </body>

  </html>