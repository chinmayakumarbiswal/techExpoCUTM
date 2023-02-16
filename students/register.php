<?php
require('../include/database.php');
require('../include/function.php');
if($_SESSION['email'])
{
  $userEmail=$_SESSION['email'];
  $name=$_SESSION['name'];
  $picture=$_SESSION['image'];

  $userdata=getUserDetails($db,$userEmail);
}
else {
  header('location:../include/logout.php');
}

if(isset($_POST['register'])){
  $name=mysqli_real_escape_string($db,$_POST['name']);
  $regdno=mysqli_real_escape_string($db,$_POST['regdno']);
  $email=mysqli_real_escape_string($db,$_POST['email']);
  $number=mysqli_real_escape_string($db,$_POST['number']);
  $campus=mysqli_real_escape_string($db,$_POST['campus']);
  $school=mysqli_real_escape_string($db,$_POST['school']);
  $dept=mysqli_real_escape_string($db,$_POST['dept']);
  $expertIn=mysqli_real_escape_string($db,$_POST['expertIn']);
  $tech=mysqli_real_escape_string($db,$_POST['tech']);
  $details=mysqli_real_escape_string($db,$_POST['details']);
  $workFileName=$_FILES['work']['name'];
  $workFileTemp=$_FILES['work']['tmp_name'];


  // echo $name."<br>";
  // echo $regdno."<br>";
  // echo $email."<br>";
  // echo $number."<br>";
  // echo $campus."<br>";
  // echo $school."<br>";
  // echo $dept."<br>";
  // echo $expertIn."<br>";
  // echo $details."<br>";
  // echo $workFileName."<br>";
  // echo $workFileTemp."<br>";

  $workFileName=date('d-m-Y-H-i').$workFileName;

  $query="SELECT * FROM registerdata WHERE email='$email' AND tech='$tech'";
  $runQuery=mysqli_query($db,$query);
  $totalRows=mysqli_num_rows($runQuery);
  if($totalRows >=1){
    echo "<script>alert('Sorry you already register for ".$tech.".');</script>";
  }else {
    if (!$workFileTemp) {
      $query="INSERT INTO registerdata (name,regd,email,no,campus,school,dept,expertIn,tech,details,workUpload) VALUES('$name','$regdno','$email','$number','$campus','$school','$dept','$expertIn','$tech','$details','notfound')";
      $run=mysqli_query($db,$query) or die(mysqli_error($db));
      if ($run) {
        echo "<script>alert('You Successfully submit your expert details.');</script>";
      }else {
        echo "<script>alert('Sorry Somthing wrong.');</script>";
      }
    }else {
      if(move_uploaded_file($workFileTemp,"../workfile/$workFileName")){
        $query="INSERT INTO registerdata (name,regd,email,no,campus,school,dept,expertIn,tech,details,workUpload) VALUES('$name','$regdno','$email','$number','$campus','$school','$dept','$expertIn','$tech','$details','$workFileName')";
        $run=mysqli_query($db,$query) or die(mysqli_error($db));
        if ($run) {
          echo "<script>alert('You Successfully submit your expert details.');</script>";
        }else {
          echo "<script>alert('Sorry Somthing wrong.');</script>";
        }
      }
    }
  }

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
  <link href="../icon.webp" rel="apple-touch-icon">

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
      <a href="student.php" class="logo d-flex align-items-center">
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
              <span>Student</span>
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
        <a class="nav-link collapsed" href="./student.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="./register.php">
          <i class="bi bi-file-earmark"></i>
          <span>Register</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="student.php">Home</a></li>
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
                  <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?=$userdata['name']?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Registration number</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="regdno" value="<?=$userdata['regd']?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" value="<?=$userEmail?>" name="email" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Contact number</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="number" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Campus</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="campus" value="<?=$userdata['campus']?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">School</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="school" value="<?=$userdata['school']?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Department</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="dept" value="<?=$userdata['dept']?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Area of Technology</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="expertIn" id="heading" onChange="getTechExpert()" required>
                      
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Technology (Tech expert in)</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="tech" id="techIn" required>
                      <option selected>Open this select menu</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Details</label>
                  <div class="col-sm-10">
                    <textarea class="tinymce-editor" name="details" required>
                    </textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Upload Your Work</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="work"> 
                  </div>
                </div>


                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Submit Data</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="register">Submit</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- ======= Footer ======= -->
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
  </script>

</body>

</html>