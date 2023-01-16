<?php
    require_once './vendor/autoload.php';
    require('./include/database.php');
    require('./include/function.php');
    require('./include/googleKey.php');
    $redirectURL='http://localhost/cutmCCCDC/adminLogin.php';


    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectURL);
    $client->addScope('profile');
    $client->addScope('email');

    if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    }

    if (isset($_GET['code'])) {
        $token=$client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);
        
        $gAuth=new Google_Service_Oauth2($client);
        
        $getInfoFromGoogle=$gAuth->userinfo->get();

        $email=$getInfoFromGoogle['email'];
        $name=$getInfoFromGoogle['name'];
        $picture=$getInfoFromGoogle['picture'];
        

        $query="SELECT * FROM admindata WHERE email='$email'";
        $runQuery=mysqli_query($db,$query);
        $totalRows=mysqli_num_rows($runQuery);
        if($totalRows >=1){
            $_SESSION['email']=$email;
            $_SESSION['name']=$name;
            $_SESSION['image']=$picture;
            $_SESSION['token']=$token;
            if ($email == 'situ@chinmayakumarbiswal.in') {
                $_SESSION['userType']="superAdmin";
                header('location:./superadmin/admin.php');
            }else {
                $_SESSION['userType']="admin";
                header('location:./admin/admin.php');
            }
            
        }else {
            echo "<script>alert('You are not a valid user.');</script>";
        }
    }else {
        
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="CUTM"/>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="./assets/css/styleLogin.css">
        <title>CCCDC Login</title>
    </head>
    <body>
        <section class="login-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="md-float-material form-material" action="#" method="POST">
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="text-center heading">CUTM CCCDC Admin Login</h3>

                                        </div>
                                    </div>

                                  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-lg btn-google btn-block text-uppercase btn-outline" href="<?=$client->createAuthUrl()?>"><img src="https://img.icons8.com/color/16/000000/google-logo.png">
                                                Login Using Google</a>

                                        </div>
                                    </div>
                                    <br>

                                    <p class="text-inverse text-center">Student Login
                                        <a href="./index.php" data-abc="true">Login</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>