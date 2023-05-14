<?php
if (isset($_SESSION['result'])) {
    if ($_SESSION['result']['response'] == 'Berhasil!') {
        $session_alert = 'info';
        $icon_alert = 'check-circle me-1';
        $swall = 'success';
    }
    if ($_SESSION['result']['response'] == 'Gagal!') {
        $session_alert = 'danger';
        $icon_alert = 'exclamation-octagon me-1';
        $swall = 'error';
    }
?>
    <div class="alert alert-<?= $session_alert?> alert-dismissible fade show" role="alert">
        <i class="bi bi-<?= $icon_alert?>"></i>
        <strong>Respon: </strong><?= $_SESSION['result']['response'] ?><br>
        <strong>Pesan: </strong><?= $_SESSION['result']['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php unset($_SESSION['result']);
} ?>