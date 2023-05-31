<?php
include("../../database/config.php");
include("../../authentication/session.php");
include('../../error/error.php');
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>PTJ | Admin</title>

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

  <!-- Datatable -->
  <link rel="stylesheet" type="text/css" href="../../DataTables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css" />

  <!-- Helpers -->
  <script src="../../assets/vendor/js/helpers.js"></script>
  <script src="../../assets/js/config.js"></script>

  <!-- Sweet Alert -->
  <script src="../../js/sweetAlert.js"></script>

  <!-- PDF Plugin-->
  <script src="../../plugin/pdf/html2canvas.min.js"></script>
  <script src="../../plugin/pdf/pdfmake.min.js"></script>

  <!-- function reset Form -->
  <script>
    function resetForm() {
      document.getElementById("formPTJ").reset();
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
            window.open('../../authentication/log_out.php', '_self');
          }
        });
    }
  </script>
  <script>
    function confirmDelete(link) {
      if (confirm("Adakah anda pasti?")) {
        doAjax(link.href, "POST"); // doAjax needs to send the "confirm" field
      }
      return false;
    }
  </script>

  <!-- AJAX Status Capaian Pengguna -->
  <script>
    function updateStatus(id) {
      console.log(id);
      $.ajax({
        method: "POST",
        url: "status_ptj.php",
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
        filename: "Senarai PTJ.xls", // do include extension
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
          pdfMake.createPdf(docDefinition).download("Senarai PTJ.pdf");
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
              <div data-i18n="Basic">Senarai Peranan Pengguna</div>
            </a>
          </li>
          <li class="menu-item active">
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
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">Profail Anda</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../index.php">
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
          <div class="modal fade" id="addPTJModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content" name="formPTJ" id="formPTJ" action="" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah PTJ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inPTJName" class="form-label">Nama</label>
                      <input style="text-transform:uppercase" type="text" id="inPTJName" name="inPTJName" class="form-control" placeholder="CONTOH : BAHAGIAN PEMBANGUNAN PERAKAUNAN PERKHIDMATAN" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inPTJPrefix" class="form-label">Singkatan</label>
                      <input style="text-transform:uppercase" maxlength="14" type="text" id="inPTJPrefix" name="inPTJPrefix" class="form-control" placeholder="CONTOH : BPPP" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inPTJAddr" class="form-label">Alamat</label>
                      <input style="text-transform:uppercase" type="text" id="inPTJAddr" name="inPTJAddr" class="form-control" placeholder="CONTOH : LOT 2956, JALAN IKM..." required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inPTJNum" class="form-label">No Telefon</label>
                      <input type="tel" maxlength="11" id="inPTJNum" name="inPTJNum" class="form-control" placeholder="CONTOH : 096908712" required />
                    </div>
                  </div>
                </div>


                <div class="modal-footer">
                  <button type="button" onclick="resetForm()" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                  </button>
                  <button type="submit" class="btn btn-primary" name="addPTJ">Tambah</button>
                </div>
              </form>

              <?php
              if (isset($_POST['addPTJ'])) {
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $date = date('h:i  d-m-y');

                $ptjN = strtoupper($_POST['inPTJName']);
                $ptjA = strtoupper($_POST['inPTJAddr']);
                $ptjP = strtoupper($_POST['inPTJPrefix']);
                $ptjNo = $_POST['inPTJNum'];
                $ptjD = $date;

                $sqlPTJ = "SELECT * FROM ptj";
                $queryPTJ = mysqli_query($conn, $sqlPTJ);
                $isPTJExist = false;
                if ($queryPTJ) {
                  foreach ($queryPTJ as $row) {
                    if ($row['PTJ_NAME'] == $ptjN || $row['PTJ_PREFIX'] == $ptjP) {
                      $isPTJExist = true;
                      break;
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
                if ($isPTJExist) {
                  echo '<script>swal({
                    title: "Ralat!",
                    text: "PTJ sudah wujud!",
                    type: "error",
                    icon: "error",
                  });
                  </script>';
                } else {

                  $sql = "INSERT INTO ptj (PTJ_NAME,PTJ_ADDRESS,PTJ_PHONE,PTJ_STATUS,PTJ_DATE,PTJ_PREFIX) VALUES ('$ptjN','$ptjA','$ptjNo',1,'$ptjD','$ptjP')";

                  $query = mysqli_query($conn, $sql);

                  if ($query) {
                    echo '<script>swal({
                    title: "Berjaya!",
                    text: "Maklumat PTJ berjaya ditambah",
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
                <h4 class="fw-bold py-3 mb-4">PTJ</h4>

                <div class="card">

                  <h5 class="card-header d-flex justify-content-between align-items-center">Senarai PTJ
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
                      <button data-bs-toggle="modal" data-bs-target="#addPTJModal" type="button" class="btn btn-primary">
                        <span class='bx bxs-add-to-queue'></span>&nbsp; Tambah PTJ
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
                          <th>Alamat</th>
                          <th>No. Telefon</th>
                          <th>Status</th>
                          <th>Tarikh Kemas Kini</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <?php ?>
                      <tbody class="table-border-bottom-0">
                        <?php
                        function showData($conn)
                        {
                          $sql = "SELECT * FROM ptj";
                          $query = mysqli_query($conn, $sql);
                          $i = 0;
                          foreach ($query as $row) {
                            $i++;
                            $status = "";
                            if ($row['PTJ_STATUS'] == 0) {
                              $status = "<span class='badge bg-label-warning me-1'>TIDAK AKTIF</span>";

                              echo
                              "<tr>
																<td>$i</td>
                                <td><b>{$row['PTJ_PREFIX']}</b></td>
																<td>{$row['PTJ_NAME']}</td>
                                <td>{$row['PTJ_ADDRESS']}</td>
                                <td>{$row['PTJ_PHONE']}</td>
																<td>{$status}</td>
                                <td>{$row['PTJ_DATE']}</td>
                                <td>
                                  <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                      <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                      <a class='dropdown-item' href='editPtj.php?ptj_edit_id={$row['PTJ_CODE']}'><i class='bx bx-edit-alt me-1'></i> Ubah</a>

                                      <a class='dropdown-item' href='#' onclick='updateStatus({$row['PTJ_CODE']});'><i class='bx bx-check'></i>  Aktif</a>
                                  </div>
                                </td>
																</tr>\n";
                            } else {
                              $status = "<span class='badge bg-label-success me-1'>AKTIF</span>";

                              echo
                              "<tr>
																<td>$i</td>
                                <td><b>{$row['PTJ_PREFIX']}</b></td>
																<td>{$row['PTJ_NAME']}</td>
                                <td>{$row['PTJ_ADDRESS']}</td>
                                <td>{$row['PTJ_PHONE']}</td>
																<td>{$status}</td>
                                <td>{$row['PTJ_DATE']}</td>
                                <td>
                                  <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                      <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                      <a class='dropdown-item' href='editPtj.php?ptj_edit_id={$row['PTJ_CODE']}'><i class='bx bx-edit-alt me-1'></i> Ubah</a>

                                      <a class='dropdown-item' href='#' onclick='updateStatus({$row['PTJ_CODE']});'><i class='bx bx-x'></i>  Tidak Aktif</a>
                                  </div>
                                </td>
																</tr>\n";
                            }



                            // echo "                                      <a onclick='return confirmDelete(this);' class='dropdown-item' href='deletePtj.php?ptj_delete_id={$row['PTJ_CODE']}'><i class='bx bx-trash me-1'></i> Delete</a>
                            // </div>";
                          }
                          if ($i == 0) {
                            echo "<tr><td style='text-align:center; vertical-align:middle' colspan='7'><br><h4>No Data<h4><br></td></tr>";
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
  <script src="../../assets/js/dashboards-analytics.js"></script>

  <!-- Export Plugin -->
  <script src="../../js/jquery.table2excel.js"></script>

</body>

</html>