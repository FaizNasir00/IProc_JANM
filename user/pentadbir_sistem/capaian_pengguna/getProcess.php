<?php
if(!empty($_POST['moduless'])){
  require('../../database/config.php');
  $module = $_POST['moduless'];

  $sql = "SELECT * FROM processes WHERE MODULE_CODE='$module'";
  $query = mysqli_query($conn, $sql);
  foreach ($query as $row) {
    echo "<option value={$row['PROCESS_CODE']}>{$row['PROCESS_NAME']}</option>";
  }
}
?>
