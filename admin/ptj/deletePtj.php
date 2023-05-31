<?php
require("../../database/config.php");
// sql to delete a record

$deleteID = $_GET['ptj_delete_id']; // get id through query string
$sql2 = "SELECT * FROM ptj WHERE PTJ_CODE='$deleteID'";
$query2 = mysqli_query($conn, $sql2);

foreach ($query2 as $row) {
  if ($row['PTJ_STATUS'] == 0) {
    $sql = "DELETE FROM ptj WHERE PTJ_CODE='$deleteID'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
      echo "<script>if(!alert('PTJ Berjaya Dipadam')) document.location='../../admin/ptj/ptj.php';</script>";
    } else {
      echo "<script>if(!alert('PTJ Tidak Berjaya Dipadam')) document.location='../../ptj/ptj.php';</script>";
    }
  } else {
    echo "<script>if(!alert('PTJ Sedang Aktif')) document.location='../../ptj/ptj.php';</script>";
  }
}
$conn->close();
