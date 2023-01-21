<?php
    session_start();
    if(isset($_SESSION['email'])){
        $token=$_SESSION['token'];
        echo $token;
        require_once '../vendor/autoload.php';
        $client = new Google_Client();
        $client->revokeToken($token); 
        session_destroy();
        header('location:../index.php');
    }
    else {
        header('location:../index.php');
    }
    
?>