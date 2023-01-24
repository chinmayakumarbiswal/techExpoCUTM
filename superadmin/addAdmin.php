<?php
require('../include/database.php');
require('../include/function.php');
if($_SESSION['userType']=="superAdmin")
{
  $userEmail=$_SESSION['email'];
  $name=$_SESSION['name'];
  $picture=$_SESSION['image'];
}
else {
  header('location:../include/logout.php');
}

if(isset($_POST['addAdmin'])){
  $emailAdd=mysqli_real_escape_string($db,$_POST['email']);
  $campus=mysqli_real_escape_string($db,$_POST['campus']);
  
  // echo $school."<br>";
  // echo $dept."<br>";

  $query="INSERT INTO admindata (email,campus) VALUES('$emailAdd','$campus')";
  $run=mysqli_query($db,$query) or die(mysqli_error($db));
  if ($run) {
    echo "<script>alert('Admin Added Successfully.');</script>";
  }else {
    echo "<script>alert('Sorry Somthing wrong.');</script>";
  }
}

$getDataForTable=getAllAdminDetailsByAdmin($db); 


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cutm Tech Expert</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../cutm.png" rel="icon">
  <link href="../cutm.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="admin.php" class="logo d-flex align-items-center">
        <img src="../icon.webp" alt="">
        <span class="d-none d-lg-block">TechExpert</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?=$picture?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$name?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?=$name?></h6>
              <span>Admin</span>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../include/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="./admin.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="./report.php">
        <i class="ri-bar-chart-box-line"></i>
        <span>Report</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="./addAdmin.php">
        <i class="bx bx-message-square-add"></i>
        <span>Add Admin</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="./addStudent.php">
        <i class="ri ri-user-add-line"></i>
        <span>Add Student</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="./addTech.php">
        <i class="bx bx-add-to-queue"></i>
        <span>Add Tech</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="./addSchool.php">
        <i class="bx bxs-buildings"></i>
        <span>Add School</span>
      </a>
    </li>


  </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Admin</h5>

              <!-- General Form Elements -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Campus</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="campus">
                      <option value="Bhubaneswar" selected>Bhubaneswar</option>
                      <option value="Balasore">Balasore</option>
                      <option value="Balangir">Balangir</option>
                      <option value="Paralakhemundi">Paralakhemundi</option>
                      <option value="Rayagada">Rayagada</option>
                      <option value="Chatrapur">Chatrapur</option>
                      <option value="Vizianagaram">Vizianagaram</option>
                    </select>
                  </div>
                </div>
                
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Add Admin</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="addAdmin">Add</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Admin List</h5>

                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Campus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php    
                        foreach($getDataForTable as $getDataForTables){
                      ?>
                      <tr class="table-primary">
                        <td><?=$getDataForTables['email']?></td>
                        <td><?=$getDataForTables['campus']?></td>
                      </tr>
                      <?php    
                        }
                      ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>

            
          </div>
        </div>

      </div>
    </section>

  </main>

  <?php
    include_once('../include/footer.php')
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>




</body>

</html>