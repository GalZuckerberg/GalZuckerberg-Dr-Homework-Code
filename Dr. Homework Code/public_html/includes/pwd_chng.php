<?php
session_start();


    
    require 'dh_handler.php';
    
    $uid = $_POST['uid'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    
    if (empty($password) || empty($passwordRepeat)){
        header("Location: ../pwd_chng_page.php?pwdcherror=emptyfields&id=".$uid);
        exit(); 
    }
    elseif ($password != $passwordRepeat){
        header("Location: ../pwd_chng_page.php?pwdcherror=passwordcheck&id=".$uid);
        exit(); 
    }
    
    else {
        if (empty($uid)){
            $uid = $_SESSION['userId'];
        }
        $sql = "UPDATE users SET password = '".$password."' WHERE id= ".$uid;
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pwd_chng_page.php?pwdcherror=sqlerror&id=".$uid);
            exit();
        }
        else{
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            header("Location: ../index.php?pwdch=success&id=".$uid);
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);





