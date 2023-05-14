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

$img_src = 'assets/img/portfolio/portfolio-' . $row['nama'] . '.jpg';
?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php#produk">Home</a></li>
                <li><a href="details-produk.php?id=<?= $row['id'] ?>">Details Produk</a></li>
                <li>Cart</li>
            </ol>
            <h2><?= $row['nama'] ?></h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <section class="shop-details">
        <div class="container">
        <form method="POST" action="invoice.php">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="row">
                        <div class="col-lg-6 ">
                            <h3 class="mb-5 pt-2 text-center fw-bold ">Your products</h3>
                            <div class="d-flex align-items-center mb-5">
                                <div class="flex-shrink-0">
                                    <img src="<?= $img_src ?>" class="img-fluid" style="width: 150px;" alt="Generic placeholder image">
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <a href="index.php#produk" class="float-end text-black"><i class="fas fa-times"></i></a>
                                    <h5 class="text-primary"><?= $row['nama'] ?></h5>
                                    <input type="hidden" name="produk_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="kode" value="<?= $row['kode'] ?>">
                                    <div class="d-flex align-items-center">

                                        <p class="fw-bold mb-0 me-5 pe-3"><?= 'Rp' . number_format($row['harga_jual'], 0, ',', '.') ?></p>
                                        <div class="input-group input-group-sm">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity(this)"><i class="fas fa-minus"></i></button>
                                            <input type="number" id="quantity" value="1" class="form-control form-control-sm quantity" name="quantity" onchange="updateTotal()">
                                            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity(this)"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">
                            <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                                <h5 class="fw-bold mb-0">Total:</h5>
                                <h5 class="fw-bold mb-0"><span id="total"><?= 'Rp' . number_format($row['harga_jual'], 0, ',', '.') ?></span></h5>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <h3 class="mb-5 pt-2 text-center fw-bold">Billing Address</h3>

                            <div class="form-outline mb-5">
                                <label class="form-label" for="nama_pemesanan">Nama</label>
                                <input type="text" id="nama_pemesanan" name="nama_pemesanan" class="form-control form-control-lg" size="17" value=""/>

                            </div>

                            <div class="form-outline mb-5">
                                <label class="form-label" for="alamat_pemesanan">Alamat</label>
                                <input type="text" id="alamat_pemesanan" name="alamat_pemesanan" class="form-control form-control-lg" size="17" value="" />

                            </div>
                            <div class="form-outline mb-5">
                                <label class="form-label" for="no_hp">No Handphone</label>
                                <input type="number" id="no_hp" name="no_hp" class="form-control form-control-lg" size="17" value="" />

                            </div>
                            <div class="form-outline mb-5">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" size="17" value="" />

                            </div>
                            <div class="form-outline mb-5">
                                <label class="form-label" for="deskripsi">Deskripsi</label>
                                <input type="text" id="deskripsi" name="deskripsi" class="form-control form-control-lg" size="17" value="" />

                            </div>

                            <p class="mb-5">Lorem ipsum dolor sit amet consectetur, adipisicing elit <a href="#!">obcaecati sapiente</a>.</p>

                            <input type="submit" name="buy" class="btn btn-primary btn-lg d-block w-100" value="Buy Now"/>
                

                            <h5 class="fw-bold mt-5 text-center">
                                <a href="index.php#produk"><i class="fas fa-angle-left me-2"></i>Back to shopping</a>
                            </h5>

                        </div>
                    </div>
                </div>
            </form>
        </div>
</main>
 <!-- End main -->


<script>
    function incrementQuantity(btn) {
        var input = btn.parentNode.querySelector('input[type=number]');
        input.stepUp();
        updateTotal();
    }

    function decrementQuantity(btn) {
        var input = btn.parentNode.querySelector('input[type=number]');
        input.stepDown();
        updateTotal();
    }

    function updateTotal() {
        var price = <?= $row['harga_jual'] ?>;
        var quantity = document.querySelector('.quantity').value;
        var total = price * quantity;
        document.getElementById('total').textContent = 'Rp' + number_format(total, 0, ',', '.');
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
        decimals = typeof decimals !== 'undefined' ? decimals : 0;
        dec_point = typeof dec_point !== 'undefined' ? dec_point : '.';
        thousands_sep = typeof thousands_sep !== 'undefined' ? thousands_sep : ',';

        var parts = number.toFixed(decimals).split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);

        return parts.join(dec_point);
    }
</script>

<?php
require 'footer.php';

?>