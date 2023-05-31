<?php
include("../../../database/config.php");
// sql to delete a record

$statusID = $_POST['cp_edit_id']; // get id through query string
$sql2 = "SELECT USERMATRIX_STATUS FROM usermatrix WHERE USERMATRIX_CODE='$statusID'";
$query2 = mysqli_query($conn, $sql2);
$status = $query2->fetch_row()[0] ?? false;

if($status == 0){
  $sql = "UPDATE usermatrix SET USERMATRIX_STATUS=1 WHERE USERMATRIX_CODE=$statusID";
  $query = mysqli_query($conn, $sql);
  if($query) echo 3; else echo 4;
}else{
  $sql = "UPDATE usermatrix SET USERMATRIX_STATUS=0 WHERE USERMATRIX_CODE=$statusID";
  $query = mysqli_query($conn, $sql);

  if($query) echo 3; else echo 4;
}

$conn->close();
?>