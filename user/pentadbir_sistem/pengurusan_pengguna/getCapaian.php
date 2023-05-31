<?php
include('../../../database/config.php');

$temp = $_POST['ids'];
$sql = "SELECT USERMATRIX_CODE FROM userroles WHERE USER_CODE='$temp' AND USERROLE_STATUS=1";
$query = mysqli_query($conn, $sql);

$sqlUser = "SELECT USER_NAME FROM user WHERE USER_CODE='$temp'";
$queryUser = mysqli_query($conn, $sqlUser);
$valueUser = $queryUser->fetch_row()[0] ?? false;

if (!$query) {
} else {
  foreach ($query as $row) {
    $tempUM = $row['USERMATRIX_CODE'];
    $sqlUM = "SELECT * FROM usermatrix WHERE USERMATRIX_CODE='$tempUM'";
    $queryUM = mysqli_query($conn, $sqlUM);
    if (!$query) {
    } else {
      foreach ($queryUM as $rowUM) {
        // get role
        $tempRole = $rowUM['ROLE_CODE'];
        $sqlRole = "SELECT ROLE_NAME FROM roles WHERE ROLE_CODE='$tempRole'";
        $queryRole = mysqli_query($conn, $sqlRole);
        $valueRole = $queryRole->fetch_row()[0] ?? false;

        // get module
        $tempModule = $rowUM['MODULE_CODE'];
        $sqlModule = "SELECT MODULE_NAME FROM modules WHERE MODULE_CODE='$tempModule'";
        $queryModule = mysqli_query($conn, $sqlModule);
        $valueModule = $queryModule->fetch_row()[0] ?? false;

        // get process
        $tempPro = $rowUM['PROCESS_CODE'];
        $sqlPro = "SELECT PROCESS_NAME FROM processes WHERE PROCESS_CODE='$tempPro'";
        $queryPro = mysqli_query($conn, $sqlPro);
        $valuePro = $queryPro->fetch_row()[0] ?? false;

        $data[] = array('name' => $valueUser, 'role' => $valueRole, 'module' =>  $valueModule, 'process' =>  $valuePro);
      }
    }
  }
}
//return json format data as response to Ajax Call
echo json_encode($data);
