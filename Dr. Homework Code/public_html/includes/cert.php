<?php
session_start();

if (isset($_GET['crt_ch'])){

    $signed_by = $_GET['signed_by'];
    
    if ($signed_by == "0"){
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