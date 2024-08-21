<?php
if (isset($_SESSION['notification'])):
    $notificationMessage = $_SESSION['notification'];
    $notificationType = (strpos($notificationMessage, 'Gagal') !== false || strpos($notificationMessage, 'salah') !== false) ? 'error' : '';
    unset($_SESSION['notification']); // Clear notification after use
?>
<div id="notification" class="notification <?php echo $notificationType; ?> show">
      <?php echo htmlspecialchars($notificationMessage); ?>
</div>
<?php
endif;
?>