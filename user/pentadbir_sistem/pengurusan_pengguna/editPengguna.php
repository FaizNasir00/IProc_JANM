<?php
include("../../../database/config.php");
include("../../../authentication/session.php");
include('../../../error/error.php');
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<?php
$editID = $_GET['user_edit_id'];
echo '<script>console.log("' . $editID . '");</script>';
$sqlU = "SELECT * FROM user WHERE USER_CODE='$editID'";
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
    if ($editID == $valueU['USER_CODE']) {
      $valueKOD = $valueU['USER_CODE'];
      $valueIC = $valueU['USER_NRIC'];
      $valueNAME = $valueU['USER_NAME'];
      $valueGRADE = $valueU['USER_GRADE'];
      $valuePOS = $valueU['USER_POSITION'];
      $valueEMAIL = $valueU['USER_EMAIL'];
      $valuePASS = $valueU['USER_PASS'];
      $valueNO = $valueU['USER_PHONE'];
    }
  }
}

//variable
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

  <title>Kemas Kini Maklumat Pengguna | PS</title>

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

  <!-- Helpers -->
  <script src="../../../assets/vendor/js/helpers.js"></script>
  <script src="../../../assets/js/config.js"></script>

  <!-- Sweet Alert -->
  <script src="../../../js/sweetAlert.js"></script>

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
          <li class="menu-item active">
            <a href="../../pentadbir_sistem/dashboard_ps.php" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-home"></i>
              <div data-i18n="Analytics">Paparan Utama</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Modul & Proses</span>
          </li>
          <li class="menu-item">
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
          <li class="menu-item active">
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
                  $i=0;
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

          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengguna /</span>Maklumat Pengguna</h4>

            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Pengguna</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href='editPerananPengguna.php?user_edit_id=<?= $editID ?>'><i class="bx bxs-network-chart"></i> Peranan & Capaian</a>
                  </li>
                </ul>
                <div class="card mb-4">
                  <h5 class="card-header">Ubah Maklumat Pengguna</h5>
                  <!-- Account -->
                  <!-- <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <img src="../../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                      <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                          <span class="d-none d-sm-block">Upload new photo</span>
                          <i class="bx bx-upload d-block d-sm-none"></i>
                          <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                          <i class="bx bx-reset d-block d-sm-none"></i>
                          <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                      </div>
                    </div>
                  </div> -->
                  <hr class="my-0" />
                  <div class="card-body">
                    <form method="POST" action="" name="editFormUser"><br>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="edPKod" class="form-label">Kod</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-code"></i></span>
                            <input type="text" class="form-control" id="edPKod" name="edPKod" value="  <?php echo $valueKOD ?>" aria-label="" aria-describedby="basic-icon-default-fullname2" readonly />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="edPIc" class="form-label">No IC</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-id-card"></i></span>
                            <input type="text" pattern="\d*" maxlength="12" class="form-control" id="edPIc" name="edPIc" placeholder="CONTOH : 990917xxxxxx" value="<?= $valueIC ?>" required />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="edPName" class="form-label">Nama</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                            <input style="text-transform:uppercase" type="text" class="form-control" id="edPName" name="edPName" placeholder="CONTOH : ALI BIN ABU" value="<?= $valueNAME ?>" required />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="edPPos" class="form-label">Jawatan</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-hand"></i></span>
                            <input style="text-transform:uppercase" type="text" id="edPPos" name="edPPos" class="form-control" placeholder="CONTOH : PEN PEGAWAI KESIHATAN" value="<?= $valuePOS ?>" required />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="edPGrade" class="form-label">Gred</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-receipt"></i></span>
                            <input style="text-transform:uppercase" type="text" id="edPGrade" name="edPGrade" class="form-control" placeholder="CONTOH : FA29" aria-label="FA29" value="<?= $valueGRADE ?>" required />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="edPEmail" class="form-label">Email</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-envelope"></i></span>
                            <input type="email" id="edPEmail" name="edPEmail" class="form-control" placeholder="CONTOH : fixx@xx.com" aria-label="fixx@xx.com" value="<?= $valueEMAIL ?>" required />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="edPPhone" class="form-label">No Telefon</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-phone-call"></i></span>
                            <input type="tel" id="edPPhone" name="edPPhone" class="form-control" placeholder="CONTOH : 0179xxxxxxx" maxlength="11" aria-label="PPT" value="<?= $valueNO ?>" required />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6 form-password-toggle">
                          <label for="edPPass" class="form-label">Kata Laluan</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-key"></i></span>
                            <input type="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}" class="form-control" name="edPPass" value="<?= $valuePASS ?>" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 12 or more characters" aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="edPPTJ">PTJ</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-buildings"></i></span>
                            <select id="edPPTJ" name="edPPTJ" class="form-select" required>
                              <?php
                              $sql = "SELECT * FROM ptj";
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
                                foreach ($query as $row) {
                                  if ($row['PTJ_STATUS'] == 1) {
                                    if ($row['PTJ_CODE'] == $valueU['PTJ_CODE'])
                                      echo "<option selected value={$row['PTJ_CODE']}>{$row['PTJ_PREFIX']}</option>";
                                    else
                                      echo "<option value={$row['PTJ_CODE']}>{$row['PTJ_PREFIX']}</option>";
                                  }
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="edPStatus">Status</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxs-quote-single-left"></i></span>
                            <select class="form-select" id="edPStatus" name="edPStatus" aria-label="Default select example" required>
                              <?php if ($valueU['USER_STATUS'] == 1) {
                                echo "<option selected value='1'>AKTIF</option><option value='0'>TIDAK AKTIF</option>";
                              } else {
                                echo "<option value='1'>AKTIF</option><option selected value='0'>TIDAK AKTIF</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <br><br>
                      <div class="mt-2">
                        <div align="right">
                          <button type="button" class="btn btn-outline-secondary" onclick="location.href='../../pentadbir_sistem/pengurusan_pengguna/pengguna.php'"><span class="tf-icons bx bx-x"></span>&nbsp;Batal</button>
                          <button type="submit" id="editUser" name="editUser" class="btn btn-primary me-2"><span class="tf-icons bx bx-save"></span>&nbsp;Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /Account -->
                </div>
                <!-- <div class="card">
                  <h5 class="card-header">Delete Account</h5>
                  <div class="card-body">
                    <div class="mb-3 col-12 mb-0">
                      <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                        <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                      </div>
                    </div>
                    <form id="formAccountDeactivation" onsubmit="return false">
                      <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                        <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                      </div>
                      <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                    </form>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <!-- / Content -->

          <?php
          if (isset($_POST['editUser'])) {

            date_default_timezone_set('Asia/Kuala_Lumpur');
            $date = date('h:i  d-m-y');

            $ed_KOD = $_POST['edPKod'];
            $ed_UIc = $_POST['edPIc'];
            $ed_UN = strtoupper($_POST['edPName']);
            $ed_UPos = strtoupper($_POST['edPPos']);
            $ed_UG = strtoupper($_POST['edPGrade']);
            $ed_UE = $_POST['edPEmail'];
            $ed_UPh = $_POST['edPPhone'];
            $ed_UPass = $_POST['edPPass'];
            $ed_UPP = $_POST['edPPTJ'];
            $ed_US = $_POST['edPStatus'];
            $ed_UD = $date;

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
                if ($row == $ed_UIC) {
                  $sameIC = true;
                  break;
                }
              }
            }

            if (!$sameIC) {

              $sql = "UPDATE user SET USER_NRIC='$ed_UIc',USER_NAME='$ed_UN',USER_POSITION='$ed_UPos',USER_GRADE='$ed_UG',USER_EMAIL='$ed_UE',USER_PHONE='$ed_UPh',PTJ_CODE='$ed_UPP',USER_STATUS='$ed_US',USER_DATE='$ed_UD',USER_PASS='$ed_UPass' WHERE USER_CODE='$ed_KOD'";

              $query = mysqli_query($conn, $sql);

              if ($query) {
                echo '<script>swal({
                          title: "Berjaya!",
                          text: "Maklumat pengguna berjaya dikemaskini!",
                          type: "success",
                          icon: "success",
                        }).then(function() {
                          document.location ="../../pentadbir_sistem/pengurusan_pengguna/pengguna.php";
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
  <script src="../../../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../../../assets/vendor/libs/popper/popper.js"></script>
  <script src="../../../assets/vendor/js/bootstrap.js"></script>
  <script src="../../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../../../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="../../../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../../../assets/js/pages-account-settings-account.js"></script>


</body>

</html>