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
    .grnt-b{
        background-color:#D4ECC2;
        font-size: 18px;
        
    }
    .grnterror{
        color: #D00C0C;
    }
    .grntsuccess{
        color: #2F940C;
    }
</style>
<?php 
if (isset($_SESSION['userId']) && $_SESSION['is_admin'] == 1){
    echo'
<main>
    <h1>Grant Admin Privilege</h1>';
        if (isset($_GET['error'])){
            if ($_GET['error'] == "emptyfields"){
                echo '<p class="grnterror">Please fill the field!</p>';
            }
            elseif ($_GET['error'] == "invaliduid"){
                echo '<p class="grnterror">Invalid user ID!</p>';
            }
            elseif ($_GET['error'] == "uidnotexist"){
                echo '<p class="grnterror">User ID doesn\'t exist!</p>';
            }
            elseif ($_GET['error'] == "alreadyadm"){
                echo '<p class="grnterror">User is already an admin!</p>';
            }
        }
        elseif ($_GET['granted'] == "success"){
            echo '<p class="grntsuccess">Admin privilege successfully granted!</p>';
        }
        
    echo' <form action="includes/grnt_ad.php" method="post">
        <input type="text" name="uid" placeholder="User ID">

        <p><button class="grnt-b" type="submit" name="grnt-adm">Submit</button></p>
    </form>';
    
    echo '<form method="post">
    <button style="background-color:#ECC2C2" type="submit" name="grnt-adm-cancel">Cancel</button>
    </form>';
    
    if (isset($_POST['grnt-adm-cancel'])){
        header("Location: ad_users.php");
        exit();
    }
}
    ?>
</main>