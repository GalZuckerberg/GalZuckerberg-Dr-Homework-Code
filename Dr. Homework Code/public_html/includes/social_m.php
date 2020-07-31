<?php
session_start();

if (isset($_GET['scl_m-trnsf'])){

    $social_m = $_GET['social_m'];
    
    if ($social_m == "0"){
        header("Location: ../about_us.php?error=emptyfields");
        exit(); 
    }
    else{
        header("Location: ".$social_m);
        exit(); 
    }
}
else{
    header("Location: ../about_us.php");
    exit(); 
}