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

if(isset($_POST['find'])){
  $expertIn=mysqli_real_escape_string($db,$_POST['expertIn']);
  $tech=mysqli_real_escape_string($db,$_POST['tech']);
  $campus=mysqli_real_escape_string($db,$_POST['campus']);
  $school=mysqli_real_escape_string($db,$_POST['school']);
  $dept=mysqli_real_escape_string($db,$_POST['dept']);

echo $expertIn;
echo $tech;
echo $campus;
echo $school;
echo $dept;

  if($campus == "All" && $school == "All" && $dept == "All"){
   $getDataForTable=getAllDetailsByAdminWithFilterAllCampus($db,$expertIn,$tech); 
  }else if($school == "All" && $dept == "All"){
  	$getDataForTable=getAllDetailsByAdminWithFilterAllSchool($db,$expertIn,$tech,$campus); 
  }else if($dept == "All"){
  	$getDataForTable=getAllDetailsByAdminWithFilterAllDept($db,$expertIn,$tech,$campus,$school); 
  }else{
  	$getDataForTable=getAllDetailsByAdminWithFilter($db,$expertIn,$tech,$campus,$school,$dept); 
  }
  
}
else {
  $getDataForTable=getAllDetailsByAdmin($db); 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cutm TechExpert</title>
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

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tech Expert Registration</h5>

              <!-- General Form Elements -->
              <form action="" method="post" enctype="multipart/form-data">
                
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Area of Technology</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="expertIn" id="heading" onChange="getTechExpert()">
                      
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Technology (Tech expert in)</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="tech" id="techIn">
                      <option selected>Select Area of Tech</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Campus</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="campus">
                      <option value="All" selected>All</option>
                      <option value="BBSR">Bhubaneswar</option>
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
                  <label class="col-sm-2 col-form-label">School</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="school" id="school" onChange="getDept()">
                    
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Department</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="dept" id="dept">
                    <option value="All" selected>All</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Find Student List</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="find">Submit</button>
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
                        <th scope="col">Categoty</th>
                        <th scope="col">ExpertIn</th>
                        <th scope="col">Details</th>
                        <th scope="col">Upload File</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php    
                        foreach($getDataForTable as $getDataForTables){
                      ?>
                      <div class="modal fade" id="idIs<?=$getDataForTables['regd']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle"><?=$getDataForTables['details']?> </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <tr>
                        <td><?=$getDataForTables['name']?></td>
                        <td><?=$getDataForTables['regd']?></td>
                        <td><?=$getDataForTables['email']?></td>
                        <td><?=$getDataForTables['no']?></td>
                        <td><?=$getDataForTables['campus']?></td>
                        <td><?=$getDataForTables['school']?></td>
                        <td><?=$getDataForTables['dept']?></td>
                        <td><?=$getDataForTables['expertIn']?></td>
                        <td><?=$getDataForTables['tech']?></td>
                        <td>
                          <button type="button" class="btn btn-outline-warning btn-icon-text" data-toggle="modal" data-target="#idIs<?=$getDataForTables['regd']?>">
                            Details
                          </button>
                        </td>
                        <td>
                          <button type="button" class="btn btn-outline-warning btn-icon-text" onclick="window.open('../workfile/<?=$getDataForTables['workUpload']?>', '_blank');">
                            Open File
                          </button> 
                        </td>
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

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    

  <script>
    function getheading() {
      document.getElementById('heading').disabled = true
      axios.get("../include/getheading.php").then((response) => {
        console.log(response);
        let options = '<option value="">Select one option</option>';
        for (let each of response.data.data) {
          options += `<option value="${each}">${each}</option>`;
        }
        document.getElementById('heading').innerHTML = options;
        document.getElementById('heading').disabled = false;
      })
    }

    function getTechExpert() {
      let selection = document.getElementById('heading').value;
      if (!selection) return;
      document.getElementById('techIn').disabled = true
      document.getElementById('techIn').innerHTML = '<option value="">Loading</option>';
      axios.get("../include/gettech.php?heading=" + selection).then((response) => {
        console.log(response);
        let options = '';
        for (let each of response.data.data) {
            options += `<option value="${each}">${each}</option>`;
        }
        document.getElementById('techIn').innerHTML = options;
        document.getElementById('techIn').disabled = false;
      })
    }
    getheading();

    function getSchool() {
      document.getElementById('school').disabled = true
      axios.get("../include/getSchool.php").then((response) => {
        console.log(response);
        let options = '<option value="All">All</option>';
        for (let each of response.data.data) {
          options += `<option value="${each}">${each}</option>`;
        }
        document.getElementById('school').innerHTML = options;
        document.getElementById('school').disabled = false;
      })
    }

    function getDept() {
      let selection = document.getElementById('school').value;
      if (!selection) return;
      document.getElementById('dept').disabled = true
      document.getElementById('dept').innerHTML = '<option value="">Loading</option>';
      axios.get("../include/getDept.php?school=" + selection).then((response) => {
        console.log(response);
        let options = '<option value="All">All</option>';
        for (let each of response.data.data) {
            options += `<option value="${each}">${each}</option>`;
        }
        document.getElementById('dept').innerHTML = options;
        document.getElementById('dept').disabled = false;
      })
    }
    getSchool()
  </script>

</body>

</html>