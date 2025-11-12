<?php
require_once '../backend/config.php';
session_start();
session_destroy();
$msg = urlencode("Je bent uitgelogd");
header("Location: index.php?msg=$msg");
exit;
?>
