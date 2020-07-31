<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
			    font-family: Calibri;
		    }
		    .tns-b{
                background-color:#D4ECC2;
                font-size: 18px;
		        }
            .trnserror{
                color: #D00C0C;
            }
        </style>
    </head>
    
    <body>
        <main>
<?php
session_start();
    if (isset($_SESSION['userId'])){
        include "header.php";
        echo '<h1>About Us</h1>';
    }
    else{ #logged out
        echo '<br><br><hr>  
                <h2>About Us</h2>';
    }
?>                
                <p>Since 2019, our only focus has been on making it simple and easy for students & their schools to adopt digital planning skills.<br>
                We know that in today's learning environment, the right approach to organization and time management (OTM), will raise the level of performance for any student.<br>
                And this is how we get in the picture...<br><br>
                With our website the students can upload this homework and the teacher can check them and give each student a grad.<br>
                On the website the student needs to login with his mail and password (listed in the users table).<br>
                After login the student can see all his grades on the homework that he upload and can update by the calsses of the week. <br>
                The teacher, or admin, can login and see all the students details and homeworks and can grade them. Also the admin can give another users admin privilages or revike them.<br>
                
                The website is an easy solution for any class this days.<br><br>
                <img style="width:8%;" src="https://cdn.clipart.email/acdcc2514a211974449331584e1d67d9_christmas-gif-images-clipart-9to5animations-com-home-clip-art-gif-_379-320.gif">
                </p>
<?php
session_start();
    if (isset($_SESSION['userId'])){
        echo '<h2>Find Us on Social Media</h2>';
        if (isset($_GET['error'])){
            if ($_GET['error'] == "emptyfields"){
                echo '<p class="trnserror">Please choose a platform to transfer to!</p>';
            }
        }
        echo '<form action="includes/social_m.php" method="get">
        <p><label>Social Media: 
        <select name="social_m" size="1">
            <option value="0">--Select--</option>
            <option value="https://www.facebook.com/">Facebook</option>
            <option value="https://www.instagram.com/">Instagram</option>
            <option value="https://www.twitter.com/">Twitter</option></select></label></p>
            
        <p><button class="tns-b" type="submit" name="scl_m-trnsf">Transfer</button></p>
    </form>';
    }
?>                

</main>
</body>
</html>