<?php
include("../../../database/config.php");
include("../../../authentication/session.php");
include('../../../error/error.php');
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<?php //variable
$temp = $_SESSION['id'];
$roleName[] = '';

//database
$sqlUR = "SELECT * FROM userroles WHERE USER_CODE='$temp' AND USERROLE_STATUS=1";
$queryUR = mysqli_query($conn, $sqlUR);
if (!$queryUR) {
} else {
  foreach ($queryUR as $row) {
    $um = $row['USERMATRIX_CODE'];
    $sqlUM = "SELECT * FROM usermatrix WHERE USERMATRIX_CODE='$um'";
    $queryUM = mysqli_query($conn, $sqlUM);
    if (!$queryUM) {
    } else {
      foreach ($queryUM as $row2) {
        $u_r = $row2['ROLE_CODE'];
        $u_m = $row2['MODULE_CODE'];
        $u_p = $row2['PROCESS_CODE'];


        $sqlR = "SELECT * FROM roles WHERE ROLE_CODE='$u_r'";
        $queryR = mysqli_query($conn, $sqlR);
        if (!$queryR) {
        } else {
          foreach ($queryR as $row3) {
            $roleName[] = $row3['ROLE_NAME'];
          }
        }


        $sqlM = "SELECT * FROM modules WHERE MODULE_CODE='$u_r'";
        $queryM = mysqli_query($conn, $sqlM);
        if (!$queryM) {
        } else {
        }


        $sqlP = "SELECT * FROM processes WHERE PROCESS_CODE='$u_r'";
        $queryP = mysqli_query($conn, $sqlP);
        if (!$queryP) {
        } else {
        }
      }
    }
  }
}
?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Modul | PS</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../../../assets/img/icons/logo4.ico" />

  <!-- Fonts -->
  <link href="../../../css/font.css" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../../../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../../../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../../../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="../../../assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Datatable -->
  <link rel="stylesheet" type="text/css" href="../../../DataTables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css" />

  <!-- Helpers -->
  <script src="../../../assets/vendor/js/helpers.js"></script>
  <script src="../../../assets/js/config.js"></script>

  <!-- Sweet Alert -->
  <script src="../../../js/sweetAlert.js"></script>

  <!-- PDF Plugin-->
  <script src="../../../plugin/pdf/html2canvas.min.js"></script>
  <script src="../../../plugin/pdf/pdfmake.min.js"></script>

  <!-- function reset Form -->
  <script>
    function resetForm() {
      document.getElementById("formModul").reset();
    }
  </script>

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
            window.open('../../../authentication/log_out.php', '_self');
          }
        });
    }
  </script>

  <!-- AJAX Status Capaian Pengguna -->
  <script>
    function updateStatus(id) {
      console.log(id);
      $.ajax({
        method: "POST",
        url: "status_modul.php",
        data: {
          cp_edit_id: id
        },
        success: function(data) {
          if (data == 3) {
            swal({
              title: "Berjaya!",
              text: "Status berjaya ditukar!",
              type: "success",
              icon: "success",
            }).then(function() {
              window.location.reload();
            });
          } else {
            swal("Ralat!", "Status tidak berjaya ditukar!", "error");
          }
        }
      });
    }
  </script>

  <script>
    function toExcel() {
      $("#tableD").table2excel({
        exclude: ".excludeThisClass",
        name: "Worksheet Name",
        filename: "Senarai Modul.xls", // do include extension
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
          pdfMake.createPdf(docDefinition).download("Senarai Modul.pdf");
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
          <a href="../pentadbir_sistem/dashboard_ps.php" class="app-brand-link">
            <img style="  display: block;
                        margin-left: 50px;
                        margin-right: 50px;
                        width: 98%;" src="../../../assets/img/item/logo3.png" width="120" height="60">
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div><br>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="../../pentadbir_sistem/dashboard_ps.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-home"></i>
              <div data-i18n="Analytics">Paparan Utama</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Modul & Proses</span>
          </li>
          <li class="menu-item active">
            <a href="../../pentadbir_sistem/modul/modul.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-book"></i>
              <div data-i18n="Basic">Senarai Modul</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../pentadbir_sistem/proses/proses.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-detail"></i>
              <div data-i18n="Basic">Senarai Proses</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengguna</span>
          </li>
          <li class="menu-item">
            <a href="../../pentadbir_sistem/role/role.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-pin"></i>
              <div data-i18n="Basic">Senarai Peranan Pengguna</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../pentadbir_sistem/ptj/ptj.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-buildings"></i>
              <div data-i18n="Basic">Senarai PTJ</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../pentadbir_sistem/capaian_pengguna/capaian_pengguna.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-network-chart"></i>
              <div data-i18n="Basic">Senarai Capaian Pengguna</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="../../pentadbir_sistem/pengurusan_pengguna/pengguna.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-account"></i>
              <div data-i18n="Basic">Senarai Pengguna</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Tetapan</span>
          </li>
          <li class="menu-item">
            <a href="../../profail_user.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-detail"></i>
              <div data-i18n="Basic">Profail Pengguna</div>
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
            <div class="navbar-nav align-items-center">
              <!-- <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Carian"
                    aria-label="Carian"
                  />
                </div> -->
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->
              <li class="nav-item lh-1 me-3">
                <a class="github-button" href="#" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Pentadbir Sistem</a>
              </li>

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="../../../assets/img/avatars/user7.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="../../../assets/img/avatars/user7.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">Pentadbir Sistem</span>
                          <small class="text-muted">Capaian penuh</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <?php
                  $roleName2[] = '';
                  $i = 0;
                  foreach ($roleName as $temp) {
                    if ($temp == "PENTADBIR SISTEM") {
                      $roleName2[$i] = "PENTADBIR SISTEM";
                    }
                    if ($temp == "PENYEDIA") {
                      $roleName2[$i] = "PENYEDIA";
                    }
                    if ($temp == "PENYEMAK I" || $temp == "PENYEMAK II" || $temp == "PENYEMAK III") {
                      $roleName2[$i] = "PENYEMAK";
                    }
                    if ($temp == "NAZIRAN & AUDIT" || $temp == "PENONTON") {
                      $roleName2[$i] = "NAZIRAN & AUDIT";
                    }
                    if ($temp == "PELULUS I" || $temp == "PELULUS II" || $temp == "PELULUS III") {
                      $roleName2[$i] = "PELULUS";
                    }
                    $i++;
                  }
                  $roleName2 = array_unique($roleName2);

                  foreach ($roleName2 as $temp) {
                    if ($temp == "PENTADBIR SISTEM") {
                      echo "<li><a class='dropdown-item' href='../../pentadbir_sistem/dashboard_ps.php'><i class='bx bx-user me-2'></i>
                      <span class='align-middle'>Pentadbir Sistem</span></span></a></li>";
                    }
                    if ($temp == "PENYEDIA") {
                      echo "<li><a class='dropdown-item' href='../../penyedia/dashboard_penyedia.php'><i class='bx bx-user me-2'></i>
                      <span class='align-middle'>Penyedia</span></a></li>";
                    }
                    if ($temp == "PENYEMAK") {
                      echo "<li><a class='dropdown-item' href='../../penyemak/dashboard_penyemak.php'><i class='bx bx-user me-2'></i>
                      <span class='align-middle'>Penyemak</span></a></li>";
                    }
                    if ($temp == "NAZIRAN & AUDIT") {
                      echo "<li><a class='dropdown-item' href='../../penonton/dashboard_penonton.php'><i class='bx bx-user me-2'></i>
                      <span class='align-middle'>Naziran & Audit</span></a></li>";
                    }
                    if ($temp == "PELULUS") {
                      echo "<li><a class='dropdown-item' href='../../pelulus/dashboard_pelulus.php'><i class='bx bx-user me-2'></i>
                      <span class='align-middle'>Pelulus</span></a></li>";
                    }
                  } ?>
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

          <!-- Modal -->
          <div class="modal fade" id="addModulModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content" name="formModul" id="formModul" action="" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Modul</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inModulName" class="form-label">Nama</label>
                      <input style="text-transform:uppercase" type="text" id="inModulName" name="inModulName" class="form-control" placeholder="CONTOH : PERANCANGAN PEROLEHAN TAHUNAN" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inModulPrefix" class="form-label">Singkatan</label>
                      <input style="text-transform:uppercase" type="text" id="inModulPrefix" name="inModulPrefix" maxlength="3" class="form-control" placeholder="CONTOH : PPT" required />
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" onclick="resetForm()" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                  </button>
                  <button type="submit" class="btn btn-primary" name="addModul">Tambah</button>
                </div>
              </form>

              <?php
              if (isset($_POST['addModul'])) {
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $date = date('h:i  d-m-y');

                $modulN = strtoupper($_POST['inModulName']);
                $modulP = strtoupper($_POST['inModulPrefix']);
                $modulD = $date;

                $isModulExist = false;
                $sqlM = "SELECT * FROM modules";
                $queryM = mysqli_query($conn, $sqlM);
                if (!$queryM) {
                  echo '<script>swal({
                    title: "Ralat!",
                    text: "' . $conn->error . '",
                    type: "error",
                    icon: "error",
                  });
                  </script>';
                } else {
                  foreach ($queryM as $row) {
                    if ($row['MODULE_NAME'] == $modulN || $row['MODULE_PREFIX'] == $modulP) {
                      $isModulExist = true;
                      break;
                    }
                  }
                }

                if ($isModulExist) {
                  echo '<script>swal({
                    title: "Ralat!",
                    text: "Modul sudah wujud!",
                    type: "error",
                    icon: "error",
                  });
                  </script>';
                } else {

                  $sql = "INSERT INTO modules (MODULE_NAME,MODULE_PREFIX,MODULE_STATUS,MODULE_DATE) VALUES ('$modulN','$modulP',1,'$modulD')";
                  $query = mysqli_query($conn, $sql);

                  if ($query) {
                    echo '<script>swal({
                    title: "Berjaya!",
                    text: "Maklumat modul berjaya ditambah!",
                    type: "success",
                    icon: "success",
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
                //remove post data on refresh
                echo "<script>
                if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.	href);
                }
              </script>";
              }
              ?>
            </div>
          </div>
          <!--/ Bootstrap modals -->


          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col mb-4 order-0">
                <!-- Striped Rows -->
                <h4 class="fw-bold py-3 mb-4">Modul</h4>

                <div class="card">

                  <h5 class="card-header d-flex justify-content-between align-items-center">Senarai Modul
                    <div class="demo-inline-spacing">
                      <div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Muat Turun
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#" onClick="toExcel()"><span class='bx bxs-file'></span>&nbsp;&nbsp;Excel</a></li>
                          <li><a class="dropdown-item" href="#" onClick="toPDF()"><span class='bx bxs-file-pdf'></span>&nbsp;&nbsp;Pdf</a></li>
                        </ul>
                      </div>

                      <button data-bs-toggle="modal" data-bs-target="#addModulModal" type="button" class="btn btn-primary">
                        <span class='bx bxs-add-to-queue'></span>&nbsp; Tambah Modul
                      </button>
                    </div>
                  </h5>
                  <br>

                  <div class="card-datatable table-responsive pt-0" style="padding:30px">
                    <table class="datatables-basic table border-top" id="tableD" style="width:100%">
                      <thead>
                        <tr>
                          <th>Bil</th>
                          <th>Singkatan</th>
                          <th>Nama</th>
                          <th>Status</th>
                          <th>Tarikh Kemas Kini</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>

                      <tbody class="table-border-bottom-0">
                        <?php
                        function showData($conn)
                        {
                          $sql = "SELECT * FROM modules";
                          $query = mysqli_query($conn, $sql);
                          $i = 0;
                          if ($query) {
                            foreach ($query as $row) {
                              $i++;
                              $status = "";
                              if ($row['MODULE_STATUS'] == 0) {
                                $status = "<span class='badge bg-label-warning me-1'>TIDAK AKTIF</span>";

                                echo
                                "<tr>
																<td>$i</td>
                                <td><b>{$row['MODULE_PREFIX']}</b></td>
																<td>{$row['MODULE_NAME']}</td>
																<td>{$status}</td>
                                <td>{$row['MODULE_DATE']}</td>
                                <td>
                                  <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                      <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                      <a class='dropdown-item' href='editModul.php?modul_edit_id={$row['MODULE_CODE']}'><i class='bx bx-edit-alt me-1'></i> Ubah</a>

                                      <a class='dropdown-item' href='#' onclick='updateStatus({$row['MODULE_CODE']});'><i class='bx bx-check'></i>  Aktif</a>
                                    </div>
                                  </div>
                                </td>
																</tr>\n";
                              } else {
                                $status = "<span class='badge bg-label-success me-1'>AKTIF</span>";

                                echo
                                "<tr>
																<td>$i</td>
                                <td><b>{$row['MODULE_PREFIX']}</b></td>
																<td>{$row['MODULE_NAME']}</td>
																<td>{$status}</td>
                                <td>{$row['MODULE_DATE']}</td>
                                <td>
                                  <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                      <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                      <a class='dropdown-item' href='editModul.php?modul_edit_id={$row['MODULE_CODE']}'><i class='bx bx-edit-alt me-1'></i> Ubah</a>

                                      <a class='dropdown-item' href='#' onclick='updateStatus({$row['MODULE_CODE']});'><i class='bx bx-x'></i>  Tidak Aktif</a>
                                    </div>
                                  </div>
                                </td>
																</tr>\n";
                              }
                            }

                            // echo "
                            // <a onclick='return confirmDelete(this);' class='dropdown-item' href='deleteModul.php?modul_delete_id={$row['MODULE_CODE']}'><i class='bx bx-trash me-1'></i> Delete</a>";

                          } else {
                            echo '<script>swal({
                            title: "Ralat!",
                            text: "' . $conn->error . '",
                            type: "error",
                            icon: "error",
                            });
                            </script>';
                          }
                          if ($i == 0) {
                            echo "<tr><td style='text-align:center; vertical-align:middle' colspan='6'><br><h4>Tiada Maklumat<h4><br></td></tr>";
                          }
                        }
                        showData($conn);

                        echo "<script>
														if (window.history.replaceState) {
														window.history.replaceState(null, null, window.location.href); } </script>";
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!--/ Striped Rows -->
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
  <script src="../../../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../../../assets/vendor/libs/popper/popper.js"></script>
  <script src="../../../assets/vendor/js/bootstrap.js"></script>
  <script src="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../../../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Datatable JS -->
  <script src="../../../DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="../../../DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="../../../js/datatables.js"></script>

  <!-- Main JS -->
  <script src="../../../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../../../assets/js/dashboards-analytics.js"></script>

  <!-- Export Plugin -->
  <script src="../../../js/jquery.table2excel.js"></script>

</body>

</html>