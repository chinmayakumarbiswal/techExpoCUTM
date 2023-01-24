<?php
require('../include/database.php');
require('../include/function.php');
if($_SESSION['userType']=="superAdmin")
{
  $userEmail=$_SESSION['email'];
  $name=$_SESSION['name'];
  $picture=$_SESSION['image'];

  // find all added studend 
  $totalStudentAdded=getAllStudentByAdmin($db);
  // find all registered student 
  $totalRegisterStudent=getAllRegisterStudentByAdmin($db);

  // find data campus wise for bar chart 
  $totalInBbsr=getAllRegisterStudentByAdminCampusWise($db,'BBSR');
  $totalInBls=getAllRegisterStudentByAdminCampusWise($db,'Balasore');
  $totalInBal=getAllRegisterStudentByAdminCampusWise($db,'Balangir');
  $totalInPkd=getAllRegisterStudentByAdminCampusWise($db,'Paralakhemundi');
  $totalInRgd=getAllRegisterStudentByAdminCampusWise($db,'Rayagada');
  $totalInChaterpur=getAllRegisterStudentByAdminCampusWise($db,'Chhatrapur');
  $totalInVizianagaram=getAllRegisterStudentByAdminCampusWise($db,'Vizianagaram');

  

  // find data tech wise for pie chat 
  $totalfood=getAllRegisterStudentByAdminExpertIn($db,'Food Processing');
  $totalAg=getAllRegisterStudentByAdminExpertIn($db,'Agricultural');
  $totalManage=getAllRegisterStudentByAdminExpertIn($db,'Management');
  $totalIt=getAllRegisterStudentByAdminExpertIn($db,'IT / Communication Engineering');
  $totalOt=getAllRegisterStudentByAdminExpertIn($db,'Others');

  // 
  //  $totalManage;



  $totalStudentInTech="";
  $totalTech="";
  if(isset($_GET['expertIn'])){
    $getExpertIn=$_GET['expertIn'];
    $graphData=getAlldataForGrapthBarByAdmin($db,$getExpertIn);
    $getDataForTable=getAllDetailsByAdminTech($db,$getExpertIn);
  }else if(isset($_GET['campusIs'])){
    $getCampus=$_GET['campusIs'];
    $getDataForTable=getAllDetailsByAdminCampus($db,$getCampus);
    $graphData=getAlldataForGrapthBarByAdmin($db,'IT / Communication Engineering');
  }else {
    $graphData=getAlldataForGrapthBarByAdmin($db,'IT / Communication Engineering');
    $getDataForTable=getAllDetailsByAdmin($db); 
  }
  
  foreach ($graphData as $graphDatas) {
    $totalStudentInTech=$graphDatas['totalTech'].",".$totalStudentInTech;
    $totalTech="'".$graphDatas['tech']."',".$totalTech;
    
  }

  // echo $totalTech;
  // echo $totalStudentInTech;

  
  
}
else {
  header('location:../include/logout.php');
}

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
        <span class="d-none d-lg-block">Tech Expert</span>
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
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total No of Students</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$totalStudentAdded?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Total Student Registered</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-checklist"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$totalRegisterStudent?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <!-- <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Application Verified</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-award"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1244</h6>
                    </div>
                  </div>

                </div>
              </div>

            </div> -->

            
          
          </div>
        </div><!-- End Left side columns -->

       
      </div>
    </section>

    <section class="section">
      <div class="row">


      <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">No of Students in Area</h5>

              <!-- Pie Chart -->
              <canvas id="pieChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#pieChart'), {
                    type: 'pie',
                    data: {
                      labels: ['Food Processing','Agricultural','IT / Communication Engineering','Management','Others'],
                      datasets: [{
                        label: 'My First Dataset',
                        data: [<?=$totalfood?>, <?=$totalAg?>, <?=$totalIt?>, <?=$totalManage?>, <?=$totalOt?>],
                        backgroundColor: [
                          'rgb(55, 199, 22)',
                          'rgb(54, 162, 235)',
                          'rgb(255, 99, 132)',
                          'rgb(55, 12, 135)',
                          'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
              <!-- End Pie CHart -->

            </div>
          </div>
        </div>


        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Student Expert In</h5>
            	<a href="./admin.php?expertIn=IT / Communication Engineering" class="btn btn-dark">
                 IT / Communication Engineering
                </a>
                <a href="./admin.php?expertIn=Food Processing" class="btn btn-dark">
                  Food Processing
                </a>
                <a href="./admin.php?expertIn=Agricultural" class="btn btn-dark">
                  Agricultural
                </a>
                <a href="./admin.php?expertIn=Management" class="btn btn-dark">
                  Management
                </a>
                <a href="./admin.php?expertIn=Other" class="btn btn-dark">
                  Other
                </a>
              <!-- Bar Chart -->
              <canvas id="techSelect" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#techSelect'), {
                    type: 'bar',
                    data: {
                      labels: [<?=$totalTech?>],
                      datasets: [{
                        label: 'Bar Chart',
                        data: [<?=$totalStudentInTech?>],
                        backgroundColor: [
                          'rgba(55, 199, 22, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(55, 12, 135, 0.2)',
                          'rgba(255, 205, 86, 0.2)'
                        ],
                        borderColor: [
                          'rgb(55, 199, 22)',
                          'rgb(54, 162, 235)',
                          'rgb(255, 99, 132)',
                          'rgb(55, 12, 135)',
                          'rgb(255, 205, 86)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bar CHart -->

            </div>
          </div>
        </div>



        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Student Campus Wise</h5>
              <a href="./admin.php?campusIs=Paralakhemundi" class="btn btn-dark">Paralakhemundi</a>
              <a href="./admin.php?campusIs=BBSR" class="btn btn-dark">BBSR</a>
              <a href="./admin.php?campusIs=Bolangir" class="btn btn-dark">Bolangir</a>
              <a href="./admin.php?campusIs=Rayagada" class="btn btn-dark">Rayagada</a>
              <a href="./admin.php?campusIs=Balasore" class="btn btn-dark">Balasore</a>
            <a href="./admin.php?campusIs=Chhatrapur" class="btn btn-dark">Chhatrapur</a>
              <a href="./admin.php?campusIs=Vizianagaram" class="btn btn-dark">Vizianagaram</a>
              <!-- Bar Chart -->
              <canvas id="campusSelect" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#campusSelect'), {
                    type: 'bar',
                    data: {
                      labels: ['Bhubaneswar', 'Balasore', 'Balangir', 'Paralakhemundi', 'Rayagada', 'Chatrapur', 'Vizianagaram'],
                      datasets: [{
                        label: 'Bar Chart',
                        data: [<?=$totalInBbsr?>, <?=$totalInBls?>, <?=$totalInBal?>, <?=$totalInPkd?>, <?=$totalInRgd?>,<?=$totalInChaterpur?>, <?=$totalInVizianagaram?>],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bar CHart -->

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
                  <h5 class="card-title">Applied Student</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Registration No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Campus</th>
                        <th scope="col">School</th>
                        <th scope="col">Department</th>
                        <th scope="col">ExpertIn</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                                 
                        foreach($getDataForTable as $getDataForTables){
                      ?>
                      <tr>
                        <td><?=$getDataForTables['name']?></td>
                        <td><?=$getDataForTables['regd']?></td>
                        <td><?=$getDataForTables['email']?></td>
                        <td><?=$getDataForTables['no']?></td>
                        <td><?=$getDataForTables['campus']?></td>
                        <td><?=$getDataForTables['school']?></td>
                        <td><?=$getDataForTables['dept']?></td>
                        <td><?=$getDataForTables['expertIn']?></td>
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