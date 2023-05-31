<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["role"]);
header("Location:../index.php");
session_destroy();
?>
