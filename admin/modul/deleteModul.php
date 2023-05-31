<?php
require("../../database/config.php");
// sql to delete a record

$sql4 = "SELECT * FROM processes";
$query4 = mysqli_query($conn, $sql4);

$sql3 = "SELECT * FROM usermatrix";
$query3 = mysqli_query($conn, $sql3);

$deleteID = $_GET['modul_delete_id']; // get id through query string
$sql2 = "SELECT * FROM modules WHERE MODULE_CODE='$deleteID'";
$query2 = mysqli_query($conn, $sql2);

$isPro = 0;
$isUs = 0;

foreach ($query4 as $row4) {
  if ($row4['MODULE_CODE'] == $deleteID) {
    $isPro = 1;
    break;
  }
}

foreach ($query3 as $row3) {
  if ($row3['MODULE_CODE'] == $deleteID) {
    $isUs = 1;
    break;
  }
}

foreach ($query2 as $row2) {
  if ($row2['MODULE_STATUS'] == 0) {
    if ($isPro == 1) {
      echo "<script>alert('Modul Digunakan oleh Proses');</script>";
    }

    if ($isUs == 1) {
      echo "<script>alert('Modul Digunakan oleh User Matrik');</script>";
    }

    $sql = "DELETE FROM modules WHERE MODULE_CODE='$deleteID'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
      echo "<script>if(!alert('Modul Berjaya Dipadam')) document.location='../../admin/modul/modul.php';</script>";
    } else {
      echo "<script>if(!alert('Modul Tidak Berjaya Dipadam')) document.location='../../admin/modul/modul.php';</script>";
    }
  } else {
    echo "<script>if(!alert('Modul Sedang Aktif')) document.location='../../admin/modul/modul.php';</script>";
  }
}
$conn->close();
