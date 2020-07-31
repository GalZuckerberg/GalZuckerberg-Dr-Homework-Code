<?php
session_start();

if (isset($_POST['rvk-adm'])){
    
    require 'dh_handler.php';
    
    $uid = $_POST['uid'];
    
    if (empty($uid)){
        header("Location: ../ad_rvk_ad_pg.php?error=emptyfields");
        exit(); 
    }
    elseif ((!preg_match("/^[0-9]*$/", $uid))){
        header("Location: ../ad_rvk_ad_pg.php?error=invaliduid");
        exit(); 
    }
    $sql = "SELECT * FROM users WHERE id= ".$uid;
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../ad_rvk_ad_pg.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resCheck = mysqli_stmt_num_rows($stmt);
        if ($resCheck > 0){
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($res);
            if ($row['is_admin'] == 1){ #USER IS ADMIN
                $sql = "UPDATE users SET is_admin = 0 WHERE id= ".$uid;
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../ad_rvk_ad_pg.php?error=sqlerror2");
                    exit();
                }
                else{
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    header("Location: ../ad_rvk_ad_pg.php?revoked=success");
                    exit();
                }
            }
            else { #USER ALREADY NOT ADMIN
                header("Location: ../ad_rvk_ad_pg.php?error=alreadynotadm");
                exit();
            }
        }
        else { #NO SUCH USER
            header("Location: ../ad_rvk_ad_pg.php?error=uidnotexist");
            exit();
        }
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
    }
}
else{
    header("Location: ../index.php?id=".$_SESSION['userId']);
    exit();
}