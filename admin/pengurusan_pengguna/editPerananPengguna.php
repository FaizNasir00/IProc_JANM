<?php
include("../../database/config.php");
include("../../authentication/session.php");
include('../../error/error.php');
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<?php
$editID = $_GET['user_edit_id'];
echo '<script>console.log("' . $editID . '")</script>';

//get Table UR
$valueUR = "";
$sql = "SELECT * FROM userroles WHERE USER_CODE='$editID'";
$query = mysqli_query($conn, $sql);
if (!$query) {
  echo '<script>swal({
  title: "Ralat!",
  text: "' . $conn->error . '",
  type: "error",
  icon: "error",
  });
  </script>';
} else {
  foreach ($query as $rowJ) {
    $valueUR = $rowJ;
    //get Table UM
    $tempUUM = $valueUR['USERMATRIX_CODE'];
    $sqlUMM = "SELECT * FROM usermatrix WHERE USERMATRIX_CODE=$tempUUM";
    $queryUMM = mysqli_query($conn, $sqlUMM);
    if (!$queryUMM) {
      echo '<script>swal({
      title: "Ralat!",
      text: "' . $conn->error . '",
      type: "error",
      icon: "error",
      });
      </script>';
    } else {
      foreach ($queryUMM as $rowJ) {
        $valueUMM = $rowJ;

        // get PTJ CODE
        $tempU = $editID;
        $sqlU = "SELECT * FROM user WHERE USER_CODE='$tempU'";
        $queryU = mysqli_query($conn, $sqlU);
        if (!$queryU) {
          echo '<script>swal({
          title: "Ralat!",
          text: "' . $conn->error . '",
          type: "error",
          icon: "error",
          });
          </script>';
        } else {
          foreach ($queryU as $rowJ) {
            $valueU = $rowJ;

            // get ROLE NAME
            $tempPeranan = "";
            $tempPeranan = $valueUMM['ROLE_CODE'];
            $sqlPeranan = "SELECT ROLE_NAME FROM roles WHERE ROLE_CODE='$tempPeranan'";
            $queryPeranan = mysqli_query($conn, $sqlPeranan);
            if (!$queryPeranan) {
              echo '<script>swal({
              title: "Ralat!",
              text: "' . $conn->error . '",
              type: "error",
              icon: "error",
              });
              </script>';
            } else {
              $valuePeranan = $queryPeranan->fetch_row()[0] ?? false;
            }


            //get MODULE NAME
            $tempModul = "";
            $tempModul = $valueUMM['MODULE_CODE'];
            $sqlModul = "SELECT MODULE_NAME FROM modules WHERE MODULE_CODE='$tempModul'";
            $queryModul = mysqli_query($conn, $sqlModul);
            if (!$queryModul) {
              echo '<script>swal({
              title: "Ralat!",
              text: "' . $conn->error . '",
              type: "error",
              icon: "error",
              });
              </script>';
            } else {
              $valueModul = $queryModul->fetch_row()[0] ?? false;
            }

            //get PROCESS NAME
            $tempProses = "";
            $tempProses = $valueUMM['PROCESS_CODE'];
            $sqlProses = "SELECT PROCESS_NAME FROM processes WHERE PROCESS_CODE='$tempProses'";
            $queryProses = mysqli_query($conn, $sqlProses);
            if (!$queryProses) {
              echo '<script>swal({
              title: "Ralat!",
              text: "' . $conn->error . '",
              type: "error",
              icon: "error",
              });
              </script>';
            } else {
              $valueProses = $queryProses->fetch_row()[0] ?? false;
            }
          }
        }
      }
    }
  }
}

?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Kemas Kini Maklumat Pengguna | Admin</title>

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

  <!-- Datatable -->
  <link rel="stylesheet" type="text/css" href="../../DataTables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css" />

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
    function toExcel() {
      $("#tableD").table2excel({
        exclude: ".excludeThisClass",
        name: "Worksheet Name",
        filename: "Senarai Pengguna.xls", // do include extension
        preserveColors: false // set to true if you want background colors and font colors preserved
      });
    }

    function toPDF() {
      html2canvas($('#tableD')[0], {
        onrendered: function(canvas) {
          var data = canvas.toDataURL();
          var docDefinition = {
            content: [{
              image: data,
              width: 500
            }]
          };
          pdfMake.createPdf(docDefinition).download("Senarai Pengguna.pdf");
        }
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
              <div data-i18n="Basic">Senarai Peranan</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../admin/ptj/ptj.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-buildings"></i>
              <div data-i18n="Basic">Senarai PTJ</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../admin/capaian_pengguna/capaian_pengguna.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-network-chart"></i>
              <div data-i18n="Basic">Senarai Capaian Pengguna</div>
            </a>
          </li>
          <li class="menu-item active">
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

            <ul class="navbar-nav flex-row align-items-center ms-auto">
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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Pengguna /</span>Maklumat Peranan Pengguna</h4>

            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item">
                    <a class="nav-link" href="editPengguna.php?user_edit_id=<?= $editID ?>"><i class="bx bx-user me-1"></i> Pengguna</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bxs-network-chart"></i> Peranan & Capaian</a>
                  </li>
                </ul>
                <div class="card mb-4">
                  <h5 class="card-header">Ubah Maklumat Peranan Pengguna</h5>
                  <hr class="my-0" />
                  <div class="card-body">
                    <form action="" name="editURForm" method="POST">
                      <div class="card-datatable table-responsive pt-0" style="padding:30px">
                        <table class="datatables-basic table border-top" id="tableE" style="width:100%">
                          <thead>
                            <tr>
                              <th>Bil</th>
                              <th>Tindakan</th>
                              <th>Peranan</th>
                              <th>Modul</th>
                              <th>Proses</th>

                            </tr>
                          </thead>
                          <?php ?>
                          <tbody class="table-border-bottom-0">
                            <?php
                            $sqlMatrix = "SELECT * FROM usermatrix";
                            $queryMatrix = mysqli_query($conn, $sqlMatrix);

                            if (!$queryMatrix) {
                              echo '<script>swal({
                                  title: "Ralat!",
                                  text: "' . $conn->error . '",
                                  type: "error",
                                  icon: "error",
                                  });
                                  </script>';
                            } else {
                              $i = 0;

                              foreach ($queryMatrix as $row) {
                                if ($row['USERMATRIX_STATUS'] == 1) {
                                  $isSame = false;
                                  $i++;

                                  // get ROLE NAME
                                  $tempPeranan = $row['ROLE_CODE'];
                                  $sqlPeranan = "SELECT ROLE_NAME FROM roles WHERE ROLE_CODE='$tempPeranan'";
                                  $queryPeranan = mysqli_query($conn, $sqlPeranan);
                                  $valuePeranan = $queryPeranan->fetch_row()[0] ?? false;


                                  //get MODULE NAME
                                  $tempModul = $row['MODULE_CODE'];
                                  $sqlModul = "SELECT MODULE_NAME FROM modules WHERE MODULE_CODE='$tempModul'";
                                  $queryModul = mysqli_query($conn, $sqlModul);
                                  $valueModul = $queryModul->fetch_row()[0] ?? false;

                                  //get PROCESS NAME
                                  $tempProses = $row['PROCESS_CODE'];
                                  $sqlProses = "SELECT PROCESS_NAME FROM processes WHERE PROCESS_CODE='$tempProses'";
                                  $queryProses = mysqli_query($conn, $sqlProses);
                                  $valueProses = $queryProses->fetch_row()[0] ?? false; ?>
                                  <tr>
                                    <td style="width:2%"><?= $i ?></td>
                                    <td>
                                      <?php

                                      $sqlS = "SELECT * FROM userroles WHERE USER_CODE='$editID' AND USERROLE_STATUS=1";
                                      $queryS = mysqli_query($conn, $sqlS);
                                      if (!$queryS) {
                                        echo '<script>swal({
                                      title: "Ralat!",
                                      text: "' . $conn->error . '",
                                      type: "error",
                                      icon: "error",
                                      });
                                      </script>';
                                      } else {
                                        foreach ($queryS as $rowS)
                                          if ($rowS['USERMATRIX_CODE'] == $row['USERMATRIX_CODE']) {
                                            $isSame = true;
                                          }
                                      }

                                      if ($isSame) {
                                        echo "<input class='form-check-input' name='in_UMCode[]' type='checkbox' value='{$row['USERMATRIX_CODE']}' id='isUM' checked/>";
                                      } else {
                                        echo "<input class='form-check-input' name='in_UMCode[]' type='checkbox' value='{$row['USERMATRIX_CODE']}' id='isUM' />";
                                      }
                                      ?>

                                    </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $valuePeranan ?></strong></td>
                                    <td><?= $valueModul ?></td>
                                    <td><?= $valueProses ?></td>
                                  </tr>
                            <?php }
                              }
                            } ?>
                          </tbody>
                        </table>
                      </div>
                      <br><br>
                      <div class="mt-2">
                        <div align="right">
                          <button type="button" class="btn btn-outline-secondary" onclick="location.href='../../admin/pengurusan_pengguna/pengguna.php'"><span class="tf-icons bx bxs-x"></span>&nbsp;Batal</button>
                          <button type="submit" id="editUserRole" name="editUserRole" class="btn btn-primary me-2"><span class="tf-icons bx bx-save"></span>&nbsp;Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /Account -->
                </div>
              </div>
            </div>
          </div>
          <!-- / Content -->

          <?php
          if (isset($_POST['editUserRole'])) {
            $isSuccess = false;

            date_default_timezone_set('Asia/Kuala_Lumpur');
            $date = date('h:i  d-m-y');
            $ed_URD = $date;

            $sqlUR1 = "SELECT * FROM userroles WHERE USER_CODE='$editID'";
            $queryUR1 = mysqli_query($conn, $sqlUR1);
            if (!$queryUR1) {
              echo '<script>swal({
                title: "Ralat!",
                text: "' . $conn->error . '",
                icon: "error",
                });
                </script>';
            }

            foreach ($_POST['in_UMCode'] as $capaian) {
              // $str_arr = explode(",", $capaian);
              // $id = $str_arr[0];
              // $stat = $str_arr[1];
              $isSameID = false;
              $arrNotCheck[] = '';
              foreach ($queryUR1 as $temp) {
                if ($capaian == $temp['USERMATRIX_CODE']) {
                  $isSameID = true;
                }
              }
              if (!$isSameID) {
                $sqlN = "INSERT INTO userroles (USERMATRIX_CODE,USER_CODE,USERROLE_STATUS,USERROLE_DATE) VALUES ('$capaian','$editID',1,'$ed_URD')";
                $queryN = mysqli_query($conn, $sqlN);
              } else { // prompt same id
                $sqlN = "UPDATE userroles SET USERROLE_STATUS=1,USERROLE_DATE='$ed_URD' WHERE USER_CODE='$editID' AND USERMATRIX_CODE='$capaian'";
                $queryN = mysqli_query($conn, $sqlN);
              }
            }

            $sqlUR1 = "SELECT * FROM userroles WHERE USER_CODE='$editID'";
            $queryUR1 = mysqli_query($conn, $sqlUR1);
            if (!$queryUR1) {
              echo '<script>swal({
                title: "Ralat!",
                text: "' . $conn->error . '",
                icon: "error",
                });
                </script>';
            }


            foreach ($queryUR1 as $row) {
              $temp = $row['USERMATRIX_CODE'];
              $isNCheck = false;
              foreach ($_POST['in_UMCode'] as $arrCheck) {
                if ($arrCheck == $temp) {
                  $isNCheck = true;
                }
              }
              if (!$isNCheck) {
                $sqlN = "UPDATE userroles SET USERROLE_STATUS=0,USERROLE_DATE='$ed_URD' WHERE USER_CODE='$editID' AND USERMATRIX_CODE='$temp'";
                $queryN = mysqli_query($conn, $sqlN);
              }
            }


            echo '<script>swal({
                  title: "Berjaya!",
                  text: "Maklumat peranan pengguna berjaya dikemaskini!",
                  type: "success",
                  icon: "success",
                }).then(function() {
                  document.location ="../../admin/pengurusan_pengguna/pengguna.php"; }); </script>';

            // remove post data on refresh
            echo "<script> if (window.history.replaceState) { window.history.replaceState(null, null, window.location.	href); }</script>";
          }
          ?>

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

  <!-- Datatable JS -->
  <script src="../../DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="../../DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="../../js/datatables.js"></script>

  <!-- Main JS -->
  <script src="../../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../../assets/js/pages-account-settings-account.js"></script>


</body>

</html>