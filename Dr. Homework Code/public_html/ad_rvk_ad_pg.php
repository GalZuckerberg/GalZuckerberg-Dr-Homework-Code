<?php
    session_start();
    require "ad_users.php";
?>
<style>
    body {
	    font-family: Calibri;
    }
    button{
        cursor: pointer;
    }
    .rvk-b{
        background-color:#D4ECC2;
        font-size: 18px;
        
    }
    .rvkerror{
        color: #D00C0C;
    }
    .rvksuccess{
        color: #2F940C;
    }
</style>
<?php 
if (isset($_SESSION['userId']) && $_SESSION['is_admin'] == 1){
    echo'
<main>
    <h1>Revoke Admin Privilege</h1>';
        if (isset($_GET['error'])){
            if ($_GET['error'] == "emptyfields"){
                echo '<p class="rvkerror">Please fill the field!</p>';
            }
            elseif ($_GET['error'] == "invaliduid"){
                echo '<p class="rvkerror">Invalid user ID!</p>';
            }
            elseif ($_GET['error'] == "uidnotexist"){
                echo '<p class="rvkerror">User ID doesn\'t exist!</p>';
            }
            elseif ($_GET['error'] == "alreadynotadm"){
                echo '<p class="rvkerror">User is already not an admin!</p>';
            }
        }
        elseif ($_GET['revoked'] == "success"){
            echo '<p class="rvksuccess">Admin privilege successfully revoked!</p>';
        }
        
    echo' <form action="includes/rvk_ad.php" method="post">
        <input type="text" name="uid" placeholder="User ID">
        <p><button class="rvk-b" type="submit" name="rvk-adm">Submit</button></p>
    </form>';
    
    echo '<form method="post">
    <button style="background-color:#ECC2C2" type="submit" name="rvk-adm-cancel">Cancel</button>
    </form>';
    
    if (isset($_POST['rvk-adm-cancel'])){
        header("Location: ad_users.php");
        exit();
    }
}
    ?>
</main>