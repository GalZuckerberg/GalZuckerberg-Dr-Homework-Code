<?php

if (isset($_POST['login-submit'])){
    require 'dh_handler.php';
    
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    
    if (empty($email) || empty($password)){
        header("Location: ../index.php?error=emptyfields&mail=".$email);
        exit();
    } else{
        $sql = "SELECT * FROM users WHERE email='".$email."'";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($res)){
                if($password != $row['password']){
                    header("Location: ../index.php?error=wrongpassword&mail=".$email);
                    exit();
                }
                elseif ($password == $row['password']){
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userName'] = $row['name'];
                    $_SESSION['is_admin'] = $row['is_admin'];
                    
                    header("Location: ../index.php?id=".$row['id']);
                    exit();
                }else{
                    header("Location: ../index.php?error=wrongpassword&mail=".$email);
                    exit();
                }
            } 
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
} 
else{
    header("Location: ../index.php");
    exit();
    
}