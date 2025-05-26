<?php
session_start();
session_unset();
session_destroy();
header("Location: planding.php");  // arahkan ke halaman landing page (index.php)
exit;
?>
