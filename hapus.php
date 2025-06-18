<?php
sessios_start();
$id = $_GET['id'];
unset($_SESSION["daftar"][$id]);
header("location: dashboard.php");
?>