<?php
include("../../database/config.php");
// sql to delete a record

$deleteID = $_GET['cp_delete_id']; // get id through query string
$sql2 = "SELECT * FROM usermatrix WHERE USERMATRIX_CODE='$deleteID'";
$query2 = mysqli_query($conn, $sql2);

foreach ($query2 as $row) {
  if ($row['USERMATRIX_STATUS'] == 0) {
    $sql = "DELETE FROM usermatrix WHERE USERMATRIX_CODE='$deleteID'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
      echo "<script>if(!alert('Capaian Pengguna Berjaya Dipadam')) document.location='../../admin/capaian_pengguna/capaian_pengguna.php';</script>";
    } else {
      echo "<script>if(!alert('Capaian Pengguna Tidak Berjaya Dipadam'))
      document.location='../../admin/capaian_pengguna/capaian_pengguna.php';</script>";
    }
  } else {
    echo "<script>!alert('Capaian Pengguna Sedang Aktif').location='../../admin/capaian_pengguna/capaian_pengguna.php';</script>";
  }
}
$conn->close();
