<?php
include("../../database/config.php");
// sql to delete a record

$statusID = $_POST['cp_edit_id']; // get id through query string
$sql2 = "SELECT MODULE_STATUS FROM modules WHERE MODULE_CODE=$statusID";
$query2 = mysqli_query($conn, $sql2);
if(!$query2) echo 4;
$status = $query2->fetch_row()[0] ?? false;

if ($status == 0) {
  $sql = "UPDATE modules SET MODULE_STATUS=1 WHERE MODULE_CODE=$statusID";
  $query = mysqli_query($conn, $sql);
  if ($query) echo 3;
  else echo 4;
} else {
  $sqlUR = "SELECT * FROM usermatrix WHERE MODULE_CODE=$statusID";
  $queryUR = mysqli_query($conn, $sqlUR);
  $isM = false;
  if ($queryUR) {
    foreach ($queryUR as $row) {
      if ($row['USERMATRIX_STATUS'] == 1) {
        $isM = true;
        break;
      }
    }
    if (!$isM) {
      $sql = "UPDATE modules SET MODULE_STATUS=0 WHERE MODULE_CODE=$statusID";
      $query = mysqli_query($conn, $sql);
      echo 3;
    } else {
      echo 5;
    }
  } else {
    echo 4;
  }
}


$conn->close();
