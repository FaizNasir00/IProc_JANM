<?php
include("../../database/config.php");
include("../../authentication/session.php");
include('../../error/error.php');
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<?php
$editID = $_GET['cp_edit_id']; //get data
$sql = "SELECT * FROM usermatrix where USERMATRIX_CODE='$editID'";
$query = mysqli_query($conn, $sql);

if ($query) {
  foreach ($query as $row) {
    if ($editID == $row['USERMATRIX_CODE']) {
      $tempUSC = $row['USERMATRIX_CODE'];
      $tempRC = $row['ROLE_CODE'];
      $tempMC = $row['MODULE_CODE'];
      $tempPS = $row['PROCESS_CODE'];
      $tempUSS = $row['USERMATRIX_STATUS'];
      $tempUSD = $row['USERMATRIX_DATE'];
    }
  }
} else {
  echo '<script>swal({
    title: "Ralat!",
    text: "' . $conn->error . '",
    type: "error",
    icon: "error",
  });
  </script>';
}
?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Kemas Kini Capaian Pengguna | Admin</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../../assets/img/icons/logo4.ico" />

  <!-- Fonts -->
  <link href="../../css/font.css" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />


  <!-- Helpers -->
  <script src="../../assets/vendor/js/helpers.js"></script>
  <script src="../../assets/js/config.js"></script>

  <!-- Sweet Alert -->
  <script src="../../js/sweetAlert.js"></script>
  <script>
    function logout() {
      swal({
          title: "Log Keluar",
          text: "Anda tidak boleh kembali",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.open('../../authentication/log_out.php', '_self');
          }
        });
    }
  </script>

  <script>
    function getPro(mPro) {
      $("#pros").show();
      $('#edUProses').html('<option>Loading..</option>');
      console.log(mPro);
      $.ajax({
          method: "POST",
          url: "getProcess.php",
          dataType: "html",
          data: {
            moduless: mPro
          }
        })
        .done(function(data) {
          $("#edUProses").html(data);
        });
    }
  </script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme"><br>
        <div class="app-brand demo">
          <a href="../../admin/dashboard_admin.php" class="app-brand-link">
            <img style="  display: block;
                        margin-left: 50px;
                        margin-right: 50px;
                        width: 98%;" src="../../assets/img/item/logo3.png" width="120" height="60">
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div><br>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="../../admin/dashboard_admin.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-home"></i>
              <div data-i18n="Analytics">Paparan Utama</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Modul & Proses</span>
          </li>
          <li class="menu-item">
            <a href="../../admin/modul/modul.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-book"></i>
              <div data-i18n="Basic">Senarai Modul</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../admin/proses/proses.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-detail"></i>
              <div data-i18n="Basic">Senarai Proses</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengguna</span>
          </li>
          </li>
          <li class="menu-item">
            <a href="../../admin/role/role.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-pin"></i>
              <div data-i18n="Basic">Senarai Peranan Pengguna</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../admin/ptj/ptj.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-buildings"></i>
              <div data-i18n="Basic">Senarai PTJ</div>
            </a>
          </li>
          <li class="menu-item active">
            <a href="../../admin/capaian_pengguna/capaian_pengguna.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-network-chart"></i>
              <div data-i18n="Basic">Senarai Capaian Pengguna</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../admin/pengurusan_pengguna/pengguna.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-account"></i>
              <div data-i18n="Basic">Senarai Pengguna</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->



      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <!-- <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
              </div>
            </div> -->
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->
              <!-- <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li> -->

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="../../assets/img/avatars/user1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">Administrator</span>
                          <small class="text-muted">All Privilege</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <!-- <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Profail Anda</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li> -->
                  <li>
                    <a class="dropdown-item" onclick="logout()">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Keluar</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->

            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col mb-4 order-0">
                <!-- Striped Rows -->

                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Capaian Pengguna /</span> Maklumat Capaian Pengguna</h4>

                <!-- Form controls -->

                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Ubah Maklumat Capaian Pengguna</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form method="POST" action="" name="editFormProses">
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Kod Capaian Pengguna</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-code"></i></span>
                            <input type="text" class="form-control" id="edPKod" name="edPKod" value="  <?php echo $tempUSC ?>" aria-label="" aria-describedby="basic-icon-default-fullname2" readonly />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Peranan</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-user-pin"></i></span>
                            <select id="edUPeranan" name="edUPeranan" class="form-select" required>
                              <?php
                              $sql = "SELECT * FROM roles";
                              $query = mysqli_query($conn, $sql);
                              if ($query) {
                                foreach ($query as $row) {
                                  if ($row['ROLE_STATUS'] == 1) {
                                    if ($row['ROLE_CODE'] == $tempRC)
                                      echo "<option selected value={$row['ROLE_CODE']}>{$row['ROLE_NAME']}</option>";
                                    else
                                      echo "<option value={$row['ROLE_CODE']}>{$row['ROLE_NAME']}</option>";
                                  }
                                }
                              } else {
                                echo '<script>swal({
                                  title: "Ralat!",
                                  text: "' . $conn->error . '",
                                  type: "error",
                                  icon: "error",
                                });
                                </script>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Modul</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-book"></i></span>
                            <select id="edUModul" name="edUModul" onChange="getPro(this.value)" class="form-select" required>
                              <?php
                              $sql = "SELECT * FROM modules";
                              $query = mysqli_query($conn, $sql);

                              if ($query) {
                                foreach ($query as $row) {
                                  if ($row['MODULE_STATUS'] == 1) {
                                    if ($row['MODULE_CODE'] == $tempMC)
                                      echo "<option selected value={$row['MODULE_CODE']}>{$row['MODULE_NAME']}</option>";
                                    else
                                      echo "<option value={$row['MODULE_CODE']}>{$row['MODULE_NAME']}</option>";
                                  }
                                }
                              } else {
                                echo '<script>swal({
                                title: "Ralat!",
                                text: "' . $conn->error . '",
                                type: "error",
                                icon: "error",
                              });
                              </script>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Proses</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-detail"></i></span>
                            <select id="edUProses" name="edUProses" class="form-select" required>
                              <?php
                              $sql = "SELECT * FROM processes";
                              $query = mysqli_query($conn, $sql);

                              if ($query) {
                                foreach ($query as $row) {
                                  if ($row['MODULE_CODE'] == $tempMC) {
                                    if ($row['PROCESS_STATUS'] == 1) {
                                      if ($row['PROCESS_CODE'] == $tempPC)
                                        echo "<option selected value={$row['PROCESS_CODE']}>{$row['PROCESS_NAME']}</option>";
                                      else
                                        echo "<option value={$row['PROCESS_CODE']}>{$row['PROCESS_NAME']}</option>";
                                    }
                                  }
                                }
                              } else {
                                echo '<script>swal({
                                title: "Ralat!",
                                text: "' . $conn->error . '",
                                type: "error",
                                icon: "error",
                              });
                              </script>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Status</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-quote-single-left"></i></span>
                            <select class="form-select" id="edUStatus" name="edUStatus" aria-label="Default select example">
                              <?php if ($tempUSS == 0) {
                                echo "<option selected value='0'>TIDAK AKTIF</option><option value='1'>AKTIF</option>";
                              } else {
                                echo "<option value='0'>TIDAK AKTIF</option><option selected value='1'>AKTIF</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <br><br>
                        <div align="right">

                          <button type="button" id="bProses" name="editProses" class="btn btn-outline-secondary" onclick="location.href='../../admin/capaian_pengguna/capaian_pengguna.php'">
                            <span class="tf-icons bx bx-save"></span>&nbsp; Batal
                          </button>
                          <button type="submit" id="editUM" name="editUM" class="btn btn-primary">
                            <span class="tf-icons bx bx-save"></span>&nbsp; Simpan
                          </button>
                        </div>
                      </form>
                      <?php
                      if (isset($_POST['editUM'])) {
                        date_default_timezone_set('Asia/Kuala_Lumpur');
                        $date = date('h:i  d-m-y');

                        $ed_UP = $_POST['edUPeranan'];
                        $ed_US = $_POST['edUStatus'];
                        $ed_UD = $date;
                        $ed_UM = $_POST['edUModul'];
                        $ed_UPr = $_POST['edUProses'];

                        $sqlUS = "SELECT * FROM usermatrix where USERMATRIX_CODE=$editID";
                        $queryUS = mysqli_query($conn, $sqlUS);
                        $isCPExist = false;
                        if ($queryUS) {
                          foreach ($queryUS as $row) {
                            if (($row['ROLE_CODE'] == $ed_UP && $row['MODULE_CODE'] == $ed_UM && $row['PROCESS_CODE'] == $ed_UPr) && $ed_US == $row['USERMATRIX_STATUS']) {
                              $isCPExist = true;
                              break;
                            }
                          }
                          if (!$isCPExist) {
                            $isProceed = false;
                            if ($ed_US == 0) {
                              $sqlUR = "SELECT * FROM userroles WHERE USERMATRIX_CODE=$editID";
                              $queryUR = mysqli_query($conn, $sqlUR);
                              $isUR = false;
                              if ($queryUR) {
                                foreach ($queryUR as $row) {
                                  if ($row['USERROLE_STATUS'] == 1) {
                                    $isUR = true;
                                    break;
                                  }
                                }
                                if ($isUR) {
                                  echo '<script>swal({
                                title: "Ralat!",
                                text: "Maklumat Capaian Pengguna masih digunakan dalam peranan capaian pengguna!",
                                icon: "error",
                                });
                                </script>';
                                } else {
                                  $isProceed = true;
                                }
                              } else {
                                echo '<script>swal({
                              title: "Ralat!",
                              text: "' . $conn->error . '",
                              icon: "error",
                              });
                              </script>';
                              }
                            }else{ $isProceed = true;}
                            if ($isProceed) {
                              $sql = "UPDATE usermatrix SET ROLE_CODE='$ed_UP',MODULE_CODE='$ed_UM',PROCESS_CODE='$ed_UPr',USERMATRIX_STATUS='$ed_US',USERMATRIX_DATE='$ed_UD' WHERE USERMATRIX_CODE='$editID'";

                              $query = mysqli_query($conn, $sql);

                              if ($query) {
                                echo '<script>swal({
                              title: "Berjaya!",
                              text: "Capaian pengguna berjaya dikemaskini!",
                              type: "success",
                              icon: "success",
                              }).then(function() {
                              document.location ="../../admin/capaian_pengguna/capaian_pengguna.php";
                              });
                              </script>';
                              } else {
                                echo '<script>swal({
                              title: "Ralat!",
                              text: "' . $conn->error . '",
                              type: "error",
                              icon: "error",
                              });
                              </script>';
                              }
                            } 
                          } else {
                            echo '<script>swal("Ralat!", "Capaian pengguna sudah wujud", "error");</script>';
                          }
                        }else {
                          echo '<script>swal({
                          title: "Ralat!",
                          text: "' . $conn->error . '",
                          type: "error",
                          icon: "error",
                          });
                          </script>';
                        }


                        //remove post data on refresh
                        echo "<script>
                          if (window.history.replaceState) {
                          window.history.replaceState(null, null, window.location.	href);
                          } </script>";
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="" target="_blank" class="footer-link fw-bolder">Jabatan Akauntan Negara Malaysia</a>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../../assets/vendor/libs/popper/popper.js"></script>
  <script src="../../assets/vendor/js/bootstrap.js"></script>
  <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="../../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../../assets/js/dashboards-analytics.js"></script>
</body>

</html>