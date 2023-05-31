<?php include("../database/config.php"); ?>


<script>
  // query php to js array

var array = [
  <?php
      $query = mysqli_query($conn,"SELECT * FROM modules");
      while ($module = mysqli_fetch_assoc($query)) {
          $module_name = $module["MODULE_NAME"];
          echo "'$module_name',";
      }
  ?>
];

console.log(array);

</script>