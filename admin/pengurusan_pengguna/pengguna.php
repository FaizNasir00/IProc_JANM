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

  <title>Pengurusan Pengguna | Admin</title>

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

  <!-- PDF Plugin-->
  <script src="../../plugin/pdf/html2canvas.min.js"></script>
  <script src="../../plugin/pdf/pdfmake.min.js"></script>

  <!-- function reset Form -->
  <script>
    function resetForm() {
      document.getElementById("formPengguna").reset();
    }
  </script>

  <script>
    function showA(id) {
      output = "";
      $.ajax({
        method: "POST",
        url: "getCapaian.php",
        data: {
          ids: id
        },
        dataType: "JSON",
        success: function(data) {

          

          if (data) {
            x = data;
          } else {
            x = "";
          }

          document.getElementById("asd").innerHTML = "NAMA : " + x[0].name;

          for (i = 0; i < x.length; i++) {
            output +=
              "<tr><td>" +
              (i + 1) +
              "</td><td>" +
              x[i].role +
              "</td><td>" +
              x[i].module +
              "</td><td>" +
              x[i].process +
              "</td></tr>";
          }
          $("#tbodyS").html(output);
        },
      });
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

  <!-- AJAX Status Pengguna -->
  <script>
    function updateStatus(id) {
      console.log(id);
      $.ajax({
        method: "POST",
        url: "status_pengguna.php",
        data: {
          cp_edit_id: id
        },
        success: function(data) {
          if (data == 3) {
            swal({
              title: "Berjaya!",
              text: "Status pengguna berjaya ditukar!",
              type: "success",
              icon: "success",
            }).then(function() {
              window.location.reload();
            });
          } else if(data == 4){
            swal("Ralat!", "Status pengguna tidak berjaya ditukar!", "error");
          }else if(data == 5){
            swal("Ralat!", "Maklumat Pengguna masih digunakan dalam peranan capaian pengguna!", "error");
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

          <!-- Modal -->
          <div class="modal fade" id="addPenggunaModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <form class="modal-content" name="formPengguna" id="formPengguna" action="" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Pengguna</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inUIc" class="form-label">IC</label>
                      <input type="text" pattern="[0-9]+" maxlength="12" id="inUIc" name="inUIc" class="form-control" placeholder="CONTOH : 990917xxxxxx" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inUName" class="form-label">Nama</label>
                      <input style="text-transform:uppercase" type="text" id="inUName" name="inUName" class="form-control" placeholder="CONTOH : ALI BIN ABU" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inUPos" class="form-label">Jawatan</label>
                      <input style="text-transform:uppercase" type="text" id="inUPos" name="inUPos" class="form-control" placeholder="CONTOH : PEN EKSEKUTIF PERKHIDMATAN" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inUG" class="form-label">Gred</label>
                      <input style="text-transform:uppercase" type="text" id="inUG" name="inUG" class="form-control" placeholder="CONTOH : FA29" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inUE" class="form-label">Email</label>
                      <input type="email" id="inUE" name="inUE" class="form-control" placeholder="CONTOH : fixx@anm.gov.my" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inUNum" class="form-label">No Telefon</label>
                      <input type="tel" pattern="[0-9]+" maxlength="11" id="inUNum" name="inUNum" class="form-control" placeholder="CONTOH : 0196908712" required />
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3 form-password-toggle">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Kata Laluan</label>
                        <!-- <a href="forgot_pass.php">
                          <small>Forgot Password?</small>
                        </a> -->
                      </div>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="UPass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 12 or more characters" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                      <label for="inPTJKod" class="form-label">PTJ</label>
                      <select id="inPTJKod" name="inPTJKod" class="form-select" required>
                        <option selected disabled value="">Pilih Satu</option>
                        <?php
                        $sql = "SELECT * FROM ptj";
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
                          foreach ($query as $row) {
                            if ($row['PTJ_STATUS'] == 1) {
                              echo "<option value={$row['PTJ_CODE']}>{$row['PTJ_NAME']}</option>";
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <hr class="m-5" />
                  <div class="row">
                    <div class="col mb-3">
                      <div class="card" style="padding-top:15px">
                        <h5 class="card-header">Senarai peranan dan capaian pengguna</h5>
                        <br>
                        <div class="card-datatable table-responsive pt-0" style="padding:30px">
                          <div class="table-responsive text-nowrap">
                            <table class="datatables-basic table border-top" id="tableF" style="width:100%">
                              <thead class="table-light">
                                <tr>
                                  <th style="width:2%">Tanda</th>
                                  <th>Peranan</th>
                                  <th>Modul</th>
                                  <th>Proses</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                <?php
                                $sqlMatrix = "SELECT * FROM usermatrix";
                                $queryMatrix = mysqli_query($conn, $sqlMatrix);

                                $tempUser = '<script></script>';
                                //echo '<script>console.log("'.$tempUser.'")</script>';


                                if (!$queryMatrix) {
                                  echo '<script>swal({
                                  title: "Ralat!",
                                  text: "' . $conn->error . '",
                                  type: "error",
                                  icon: "error",
                                  });
                                  </script>';
                                } else {
                                  foreach ($queryMatrix as $row) {
                                    if ($row['USERMATRIX_STATUS'] == 1) {

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
                                      $valueProses = $queryProses->fetch_row()[0] ?? false;
                                ?>
                                      <tr>
                                        <td style="width:2%">
                                          <div class="form-check mt-3">
                                            <input class="form-check-input" name="in_UMCode[]" type="checkbox" value="<?= $row['USERMATRIX_CODE']; ?>" id="defaultCheck1"/>
                                          </div>
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
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" onclick="resetForm()" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                  </button>
                  <button type="submit" class="btn btn-primary" name="addU">Tambah</button>
                </div>
              </form>
            </div>
          </div>
          <!--/ Bootstrap modals -->

          <!-- Modal -->
          <div class="modal fade" id="infoP" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <form class="modal-content" name="formShow" id="formShow" action="" method="POST">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3">
                      <div class="card" style="padding-top:15px">
                        <h5 class="card-header">Senarai peranan dan capaian pengguna</h5>
                        <h6 class="card-header" id="asd">
                          </h6>

                            <div class="card-datatable table-responsive pt-0" style="padding:30px">
                              <div class="table-responsive text-nowrap">
                                <table class="datatables-basic table border-top" style="width:100%">
                                  <thead class="table-light">
                                    <tr>
                                      <th style="width:2%">Bil</th>
                                      <th>Peranan</th>
                                      <th>Modul</th>
                                      <th>Proses</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0" id="tbodyS">
                                  </tbody>
                                </table>
                              </div>
                            </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Keluar
                  </button>
                </div>
              </form>
            </div>
          </div>
          <!--/ Bootstrap modals -->

          <?php
          if (isset($_POST['addU'])) {
            $sameIC = false;

            $tempUser = '';
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $date = date('h:i  d-m-y');

            $u_IC = $_POST['inUIc'];
            $u_Name = strtoupper($_POST['inUName']);
            $u_Position = strtoupper($_POST['inUPos']);
            $u_Grade = strtoupper($_POST['inUG']);
            $u_Email = $_POST['inUE'];
            $u_Phone = $_POST['inUNum'];
            $u_Pass = $_POST['UPass'];
            $u_PTJ = $_POST['inPTJKod'];
            $u_Date = $date;

            $sqlSameUser = "SELECT USER_NRIC FROM user";
            $querySameUser = mysqli_query($conn, $sqlSameUser);
            if (!$querySameUser) {
              echo '<script>swal({
                title: "Ralat!",
                text: "' . $conn->error . '",
                type: "error",
                icon: "error",
              });
              </scrip>';
            } else {
              foreach ($querySameUser as $rowF) {
                if ($row == $u_IC) {
                  $sameIC = true;
                  break;
                }
              }
            }

            if (!$sameIC) {
              $sqlUser = "INSERT INTO user (USER_NRIC,USER_NAME,USER_POSITION,USER_EMAIL,USER_GRADE,USER_PHONE,PTJ_CODE,USER_STATUS,USER_DATE,USER_PASS) VALUES ('$u_IC','$u_Name','$u_Position','$u_Email','$u_Grade','$u_Phone','$u_PTJ',1,'$u_Date','$u_Pass')";

              $queryUser = mysqli_query($conn, $sqlUser);

              if ($queryUser) {
                echo '<script>swal({
                      title: "Berjaya!",
                      text: "Maklumat pengguna berjaya ditambah",
                      type: "success",
                      icon: "success",
                    });
                    </script>';

                $sqlTemp = "SELECT USER_CODE FROM user WHERE USER_NRIC=$u_IC";
                $queryTemp = mysqli_query($conn, $sqlTemp);
                $tempUser = $queryTemp->fetch_row()[0] ?? false;
              } else {
                echo '<script>swal({
                  title: "Ralat!",
                  text: "' . $conn->error . '",
                  type: "error",
                  icon: "error",
                });
                </script>';
              }


              if (!empty($_POST['in_UMCode'])) {
                foreach ($_POST['in_UMCode'] as $capaian) {
                  $sqlUR = "INSERT INTO userroles (USERMATRIX_CODE,USER_CODE,USERROLE_STATUS,USERROLE_DATE) VALUES ('$capaian','$tempUser',1,'$u_Date')";
                  $queryUR = mysqli_query($conn, $sqlUR);

                  if ($queryUR) {
                    echo '<script>swal({
                      title: "Berjaya!",
                      text: "Maklumat Peranan Pengguna berjaya ditambah",
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
              } else {
                echo '<script>swal({
                title: "Amaran!",
                text: "Tiada Capaian yang didaftarkan",
                type: "warning",
                icon: "warning",
              });
              </script>';
              }
            } else {
              echo '<script>swal({
              title: "Ralat!",
              text: "IC sudah digunakan",
              type: "error",
              icon: "error",
              });
              </script>';
            }
            //remove post data on refresh
            echo "<script>if (window.history.replaceState) { window.history.replaceState(null, null, window.location.	href); } </script>";
          }
          ?>


          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col mb-4 order-0">
                <!-- Striped Rows -->
                <h4 class="fw-bold py-3 mb-4">Pengguna</h4>

                <div class="card">

                  <h5 class="card-header d-flex justify-content-between align-items-center">Senarai Pengguna
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
                      <button data-bs-toggle="modal" data-bs-target="#addPenggunaModal" type="button" class="btn btn-primary">
                        <span class='bx bxs-add-to-queue'></span>&nbsp; Tambah Pengguna
                      </button>
                    </div>
                  </h5>
                  <br>

                  <div class="card-datatable table-responsive pt-0" style="padding:30px">
                    <form action="" method="POST">
                      <table class="datatables-basic table border-top" id="tableE" style="width:100%">
                        <thead>
                          <tr>
                            <th>Bil</th>
                            <th>IC</th>
                            <th>Nama</th>
                            <th>Jawatan</th>
                            <th>Gred</th>
                            <th>Email</th>
                            <th>No. Telefon</th>
                            <th>PTJ</th>
                            <th>Status</th>
                            <th>Tarikh Kemas Kini</th>
                            <th>Capaian</th>

                            <!-- <th>Peranan</th>
                          <th>Modul</th>
                          <th>Proses</th>-->

                            <th>Tindakan</th>
                          </tr>
                        </thead>
                        <?php ?>
                        <tbody class="table-border-bottom-0">
                          <?php
                          function showData($conn)
                          {
                            $sql = "SELECT * FROM user";
                            $query = mysqli_query($conn, $sql);
                            $i = 0;
                            if (!$query) {
                              echo '<script>swal({
                              title: "Ralat!",
                              text: "' . $conn->error . '",
                              type: "error",
                              icon: "error",
                              });
                              </script>';
                            } else {
                              foreach ($query as $valueU) {
                                $i++;
                                $status = "";

                                //get PTJ NAME
                                $tempPTJ = $valueU['PTJ_CODE'];
                                $sqlPTJ = "SELECT PTJ_NAME FROM ptj WHERE PTJ_CODE='$tempPTJ'";
                                $queryPTJ = mysqli_query($conn, $sqlPTJ);
                                if (!$queryPTJ) {
                                  echo '<script>swal({
                              title: "Ralat!",
                              text: "' . $conn->error . '",
                              type: "error",
                              icon: "error",
                              });
                              </script>';
                                } else {
                                  $valuePTJ = $queryPTJ->fetch_row()[0] ?? false;
                                }

                                if ($valueU['USER_STATUS'] == 0) {
                                  $status = "<span class='badge bg-label-warning me-1'>TIDAK AKTIF</span>";

                                  echo
                                  "<tr>
																<td>$i</td>
                                <td><b>{$valueU['USER_NRIC']}</b></td>
																<td><b>{$valueU['USER_NAME']}</b></td>
                                <td>{$valueU['USER_POSITION']}</td>
                                <td>{$valueU['USER_GRADE']}</td>
                                <td>{$valueU['USER_EMAIL']}</td>
                                <td>{$valueU['USER_PHONE']}</td>
                                <td>{$valuePTJ}</td>
																<td>{$status}</td>
                                <td>{$valueU['USER_DATE']}</td>
                                <td><button type='button' data-bs-toggle='modal' data-bs-target='#infoP' onclick='showA({$valueU['USER_CODE']})' value='{$valueU['USER_NAME']}' class='btn btn-info' name='btnV' id='btnV' >
                                Terperinci
                              </button></td>                      
                                <td>
                                  <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                      <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                      <a class='dropdown-item' href='editPengguna.php?user_edit_id={$valueU['USER_CODE']}'><i class='bx bx-edit-alt me-1'></i> Ubah</a>

                                      <a class='dropdown-item' href='#' onclick='updateStatus({$valueU['USER_CODE']});'><i class='bx bx-check'></i>  Aktif</a>
                                    </div>
                                  </div>
                                </td>
																</tr>\n";
                                } else {
                                  $status = "<span class='badge bg-label-success me-1'>AKTIF</span>";

                                  echo
                                  "<tr>
																<td>$i</td>
                                <td><b>{$valueU['USER_NRIC']}</b></td>
																<td><b>{$valueU['USER_NAME']}</b></td>
                                <td>{$valueU['USER_POSITION']}</td>
                                <td>{$valueU['USER_GRADE']}</td>
                                <td>{$valueU['USER_EMAIL']}</td>
                                <td>{$valueU['USER_PHONE']}</td>
                                <td>{$valuePTJ}</td>
																<td>{$status}</td>
                                <td>{$valueU['USER_DATE']}</td>
                                <td><button type='button' data-bs-toggle='modal' data-bs-target='#infoP' onclick='showA({$valueU['USER_CODE']})' value='{$valueU['USER_NAME']}' class='btn btn-info' name='btnV' id='btnV' >Terperinci
                                </button></td>                      
                                <td>
                                  <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                      <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                      <a class='dropdown-item' href='editPengguna.php?user_edit_id={$valueU['USER_CODE']}'><i class='bx bx-edit-alt me-1'></i> Ubah</a>

                                      <a class='dropdown-item' href='#' onclick='updateStatus({$valueU['USER_CODE']});'><i class='bx bx-x'></i>  Tidak Aktif</a>
                                    </div>
                                  </div>
                                </td>
																</tr>\n";
                                }

                                // echo "                                      <a onclick='return confirmDelete(this);' class='dropdown-item' href='deletePengguna.php?user_delete_id={$row['USER_CODE']}'><i class='bx bx-trash me-1'></i> Delete</a>";
                              }
                            }
                            if ($i == 0) {
                              echo "<tr><td style='text-align:center; vertical-align:middle' colspan='14'><br><h4>Tiada Maklumat<h4><br></td></tr>";
                            }
                          }
                          showData($conn);

                          echo "<script>
														if (window.history.replaceState) {
														window.history.replaceState(null, null, window.location.href); } </script>";
                          ?>
                        </tbody>
                      </table>
                    </form>
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