<?php
session_start();
session_destroy();

// kirim parameter msg
header("Location: login.php?msg=logout");
exit;
?>