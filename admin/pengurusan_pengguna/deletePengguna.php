<?php
require("../../database/config.php");
// sql to delete a record

$sql3 = "SELECT * FROM usermatrix";
$query3 = mysqli_query($conn, $sql3);

$deleteID = $_GET['user_delete_id']; // get id through query string
$sql2 = "SELECT * FROM user WHERE USER_CODE='$deleteID'";
$query2 = mysqli_query($conn, $sql2);
$isUs = 0;

foreach ($query3 as $row3) {
  if ($row3['MODULE_CODE'] == $deleteID) {
    $isUs = 1;
    break;
  }
}

foreach ($query2 as $row) {
  if ($row['USER_STATUS'] == 0) {

    if ($isUs == 1) {
      echo "<script>alert('Modul Digunakan oleh User Matrik');</script>";
    }
    
    $sql = "DELETE FROM user WHERE USER_CODE='$deleteID'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
      echo "<script>if(!alert('Pengguna Berjaya Dipadam'))
      document.location='../../admin/pengurusan_pengguna/pengguna.php';</script>";
    } else {
      echo "<script>if(!alert('Pengguna Tidak Berjaya Dipadam'))
      document.location='../../admin/pengurusan_pengguna/pengguna.php';</script>";
    }
  } else {
    echo "<script>if(!alert('Pengguna Sedang Aktif'))
    document.location='../../admin/pengurusan_pengguna/pengguna.php';</script>";
  }
}
$conn->close();
