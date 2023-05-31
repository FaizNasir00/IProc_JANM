<?php
include("../../database/config.php");
// sql to delete a record

$statusID = $_POST['cp_edit_id']; // get id through query string
$sql2 = "SELECT USER_STATUS FROM user WHERE USER_CODE='$statusID'";
$query2 = mysqli_query($conn, $sql2);
$status = $query2->fetch_row()[0] ?? false;

if ($status == 0) {
  $sql = "UPDATE user SET USER_STATUS=1 WHERE USER_CODE=$statusID";
  $query = mysqli_query($conn, $sql);
  if ($query) echo 3;
  else echo 4;
} else {
  $sqlUR = "SELECT * FROM userroles WHERE USER_CODE=$statusID";
  $queryUR = mysqli_query($conn, $sqlUR);
  $isUR = false;
  if ($queryUR) {
    foreach ($queryUR as $row) {
      if ($row['USERROLE_STATUS'] == 1) {
        $isUR = true;
        break;
      }
    }
    if (!$isUR) {
      $sql = "UPDATE user SET USER_STATUS=0 WHERE USER_CODE=$statusID";
      $query = mysqli_query($conn, $sql);
      if($query)
      echo 3;
      else echo 4;
    } else echo 5;
  }
}

$conn->close();
