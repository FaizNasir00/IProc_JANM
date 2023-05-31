<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["role"]);
include('../database/config.php');
include('../error/error.php');
?>

<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Log Masuk | iProc</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/icons/logo4.ico" />

  <!-- Fonts -->
  <link rel="stylesheet" href="../css/font.css" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>

  <!--sweetAlert JS-->
  <script src="../js/sweetAlert.js"></script>

</head>

<body>
  <!-- Content -->
  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="../index.php" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img style="  display: block;
                    margin-left: auto;
                    margin-right: auto;
                    width: 98%;" src="../assets/img/item/logo3.png" width="180" height="110">
                </span>
                <span class="app-brand-text demo text-body fw-bolder"></span>
              </a>
            </div>
            <!-- /Logo -->
            <h3 class="mb-3" style="text-align:center">Log Masuk</h3>
            <p class="mb-0" style="text-align:center">Unit Perolehan</p>
            <p class="mb-0" style="text-align:center">Bahagian Pembangunan Perakaunan Pengurusan</p>
            <p class="mb-4" style="text-align:center">Jabatan Akauntan Negara Malaysia</p>

            <form id="formAuthentication" class="mb-3" action="login.php" method="POST">
              <div class="mb-3">
                <label for="id" class="form-label">IC Pengguna</label>
                <input type="text" pattern="\d*" maxlength="12" class="form-control" id="id" name="id" placeholder="Contoh : 99091714xxxx" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Kata Laluan</label>
                  <a href="forgot_pass.php">
                    <small>Forgot Password?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 12 or more characters" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <!-- <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div> -->
              </div>
              <br>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="submitLogin">Log Masuk</button>
              </div>
            </form>

            <?php
            if (isset($_POST['submitLogin'])) {

              $username = $_POST['id'];
              $password = $_POST['pass'];

              $sql = "SELECT * FROM admin";
              $sql2 = "SELECT * FROM user";

              $query = mysqli_query($conn, $sql);
              $query2 = mysqli_query($conn, $sql2);

              $isLogin = false;
              $validStatus = false;
              $isAdmin = false;
              $isUser = false;

              if ($query) {
                foreach ($query as $rowA) {
                  if ($username == $rowA['ADMIN_NRIC'] && $password == $rowA['ADMIN_PASS']) {

                    $_SESSION["id"] = $rowA['ADMIN_CODE'];
                    $_SESSION["name"] = $rowA['ADMIN_NRIC'];
                    $_SESSION["role"][0] = 'ADMIN';

                    $isLogin = true;
                    $validStatus = true;
                    $isAdmin = true;
                  }
                }
              } else {
                echo '<script>swal({
                  title: "Ralat!",
                  text: "Masalah Database",
                  icon: "error",
                }).then(function() {
                  document.getElementById("formAuthentication").reset();
                });</script>';
              }


              if (!$isAdmin) {
                foreach ($query2 as $rowU) {
                  if ($username == $rowU['USER_NRIC'] && $password == $rowU['USER_PASS']) {
                    $isLogin = true;
                    $isUser = true;
                    if ($rowU['USER_STATUS'] == 1) {
                      $_SESSION["id"] = $rowU['USER_CODE'];
                      $_SESSION["name"] = $rowU['USER_NAME'];

                      $tempUser = $rowU['USER_CODE'];
                      $sqlUR = "SELECT * FROM userroles WHERE USER_CODE='$tempUser'";
                      $queryUR = mysqli_query($conn, $sqlUR);

                      if (!$queryUR) {
                      } else {
                        $i = 0;
                        foreach ($queryUR as $row) {
                          if ($row['USERROLE_STATUS'] == 1) {
                            $_SESSION['UM'][$i] = $row['USERMATRIX_CODE'];
                            $i++;
                          }
                        }
                      }

                      if ($i != 0) {
                        $tempUM = $_SESSION['UM'][0];
                        $sqlUM = "SELECT ROLE_CODE FROM usermatrix WHERE USERMATRIX_CODE='$tempUM'";
                        $queryUM = mysqli_query($conn, $sqlUM);
                        $valueUM = $queryUM->fetch_row()[0] ?? false;

                        $sqlR = "SELECT ROLE_NAME FROM roles WHERE ROLE_CODE='$valueUM'";
                        $queryR = mysqli_query($conn, $sqlR);
                        $valueR = $queryR->fetch_row()[0] ?? false;
                        $_SESSION["login_role"] = $valueR;
                      }
                      $validStatus = true;
                    }
                  }
                }
              } else {
                echo '<script>swal({
                    title: "Ralat!",
                    text: "Masalah Database",
                    icon: "error",
                  }).then(function() {
                    document.getElementById("formAuthentication").reset();
                  });</script>';
              }

              if (!$isLogin) {
                echo '<script>swal({
                    title: "Ralat!",
                    text: "No IC atau Kata Laluan salah!",
                    icon: "error",
                  }).then(function() {
                    document.getElementById("formAuthentication").reset();
                  });</script>';
              } else {
                if (!$isUser) {
                  echo '<script>swal({
                      title: "Berjaya!",
                      text: "Log masuk sebagai Admin!",
                      icon: "success",
                    }).then(function() {
                      window.location.href =  "../admin/dashboard_admin.php";
                    });</script>';
                } else {
                  if (!$validStatus) {
                    echo '<script>swal({
                        title: "Ralat!",
                        text: "Pengguna tidak aktif!",
                        icon: "error",
                      }).then(function() {
                        document.getElementById("formAuthentication").reset();
                      });</script>';
                  } else {
                    if ($i == 0) {
                      echo '<script>swal({
                        title: "Ralat!",
                        text: "Peranan Pengguna tidak aktif!",
                        icon: "error",
                      }).then(function() {
                        document.getElementById("formAuthentication").reset();
                      });</script>';
                    } else {

                      if ($_SESSION["login_role"] == "PENTADBIR SISTEM") {
                        echo '<script>swal({
                        title: "Berjaya!",
                        text: "Log masuk sebagai Pentadbir Sistem!",
                        icon: "success",
                      }).then(function() {
                        window.location.href =  "../user/pentadbir_sistem/dashboard_ps.php";
                      });</script>';
                      }
                      if ($_SESSION["login_role"] == "PENYEDIA") {
                        echo '<script>swal({
                        title: "Berjaya!",
                        text: "Log masuk sebagai Penyedia!",
                        icon: "success",
                      }).then(function() {
                        window.location.href =  "../user/penyedia/dashboard_penyedia.php";
                      });</script>';
                      }
                      if ($_SESSION["login_role"] == "PENYEMAK I" || $_SESSION["login_role"] == "PENYEMAK II" || $_SESSION["login_role"] == "PENYEMAK III") {
                        echo '<script>swal({
                        title: "Berjaya!",
                        text: "Log masuk sebagai Penyemak!",
                        icon: "success",
                      }).then(function() {
                        window.location.href =  "../user/penyemak/dashboard_penyemak.php";
                      });</script>';
                      }
                      if ($_SESSION["login_role"] == "NAZIRAN & AUDIT" || $_SESSION["login_role"] == "PENONTON") {
                        echo '<script>swal({
                        title: "Berjaya!",
                        text: "Log masuk sebagai Naziran & Audit!",
                        icon: "success",
                      }).then(function() {
                        window.location.href =  "../user/penonton/dashboard_penonton.php";
                      });</script>';
                      }
                      if ($_SESSION["login_role"] == "PELULUS I" || $_SESSION["login_role"] == "PELULUS II" || $_SESSION["login_role"] == "PELULUS III") {
                        echo '<script>swal({
                        title: "Berjaya!",
                        text: "Log masuk sebagai Pelulus!",
                        icon: "success",
                      }).then(function() {
                        window.location.href =  "../user/pelulus/dashboard_pelulus.php";
                      });</script>';
                      }
                    }
                  }
                }
              }


              echo '<script>if (window.history.replaceState) { window.history.replaceState(null,null, window.location.href); } </script>';
            }
            ?>

            <!-- <p class="text-center">
                <span>New on our platform?</span>
                <a href="auth-register-basic.html">
                  <span>Create an account</span>
                </a>
              </p> -->
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>


</body>