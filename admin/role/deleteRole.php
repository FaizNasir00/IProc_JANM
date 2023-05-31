<?php
require("../../database/config.php");
// sql to delete a record

$deleteID = $_GET['role_delete_id']; // get id through query string
$sql2 = "SELECT * FROM roles WHERE ROLE_CODE='$deleteID'";
$query2 = mysqli_query($conn, $sql2);

foreach ($query2 as $row) {
  if ($row['ROLE_STATUS'] == 0) {
    $sql = "DELETE FROM roles WHERE ROLE_CODE='$deleteID'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
      echo "<script>if(!alert('Peranan Berjaya Dipadam')) document.location='../../admin/role/role.php';</script>";
    } else {
      echo "<script>if(!alert('Peranan Tidak Berjaya Dipadam')) document.location='../../admin/role/role.php';</script>";
    }
  } else {
    echo "<script>if(!alert('Peranan Sedang Aktif')) document.location='../../admin/role/role.php';</script>";
  }
}
$conn->close();
