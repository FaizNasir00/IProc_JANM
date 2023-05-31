<?php
include("../../../database/config.php");
// sql to delete a record

$statusID = $_POST['cp_edit_id']; // get id through query string
$sql2 = "SELECT ROLE_STATUS FROM roles WHERE ROLE_CODE='$statusID'";
$query2 = mysqli_query($conn, $sql2);
$status = $query2->fetch_row()[0] ?? false;

if($status == 0){
  $sql = "UPDATE roles SET ROLE_STATUS=1 WHERE ROLE_CODE=$statusID";
  $query = mysqli_query($conn, $sql);
  if($query) echo 3; else echo 4;
}else{
  $sql = "UPDATE roles SET ROLE_STATUS=0 WHERE ROLE_CODE=$statusID";
  $query = mysqli_query($conn, $sql);

  if($query) echo 3; else echo 4;
}

$conn->close();
?>