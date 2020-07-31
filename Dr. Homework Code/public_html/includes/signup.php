<?php

if (isset($_POST['signup-submit'])){
    
    require 'dh_handler.php';
    
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    
    if (empty($name) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("Location: ../signup_page.php?sigerror=emptyfields&name=".$name."&mail=".$email);
        exit(); 
    }
    
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $name)){
        header("Location: ../signup_page.php?sigerror=invalidmailname");
        exit(); 
    }
    
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup_page.php?sigerror=invalidmail&name=".$name);
        exit(); 
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $name)){
        header("Location: ../signup_page.php?sigerror=invalidname&mail=".$email);
        exit(); 
     }
    
    elseif ($password != $passwordRepeat){
        header("Location: ../signup_page.php?sigerror=passwordcheck&name=".$name."&mail=".$email);
        exit(); 
    }
    
    else {
        $sql = "SELECT email FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup_page.php?sigerror=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resCheck = mysqli_stmt_num_rows($stmt);
            if ($resCheck > 0){
                header("Location: ../signup_page.php?sigerror=emailtaken&name=".$name);
                exit();
            }
            else{
                $sql = "INSERT INTO users (name, email, password) VALUES ('".$name."', '".$email."', '".$password."')";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup_page.php?sigerror=sqlerror2");
                    exit();
                }else{
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup_page.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
else{
    header("Location: ../signup_page.php");
    exit();
}





