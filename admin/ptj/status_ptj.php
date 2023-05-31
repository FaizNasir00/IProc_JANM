<?php
include("../../database/config.php");
// sql to delete a record

$statusID = $_POST['cp_edit_id']; // get id through query string
$sql2 = "SELECT PTJ_STATUS FROM ptj WHERE PTJ_CODE='$statusID'";
$query2 = mysqli_query($conn, $sql2);
$status = $query2->fetch_row()[0] ?? false;

if($status == 0){
  $sql = "UPDATE ptj SET PTJ_STATUS=1 WHERE PTJ_CODE=$statusID";
  $query = mysqli_query($conn, $sql);
  if($query) echo 3; else echo 4;
}else{
  $sql = "UPDATE ptj SET PTJ_STATUS=0 WHERE PTJ_CODE=$statusID";
  $query = mysqli_query($conn, $sql);

  if($query) echo 3; else echo 4;
}

$conn->close();
?>