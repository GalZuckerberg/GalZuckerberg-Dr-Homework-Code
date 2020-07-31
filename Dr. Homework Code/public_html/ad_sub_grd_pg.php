<?php
    session_start();
    require "grades_ad.php";
?>
<style>
    body {
	    font-family: Calibri;
    }
    button{
        cursor: pointer;
    }
    .sub-b{
        background-color:#D4ECC2;
        font-size: 18px;
        
    }
    .suberror{
        color: #D00C0C;
    }
    .subsuccess{
        color: #2F940C;
    }
</style>
<?php 
if (isset($_SESSION['userId']) && $_SESSION['is_admin'] == 1){
    echo'
<main>
    <h1>Submit Grade to Homework</h1>';
        if (isset($_GET['error'])){
            if ($_GET['error'] == "emptyfields"){
                echo '<p class="suberror">Please fill in all fields!</p>';
            }
            elseif ($_GET['error'] == "invalidsnumgrd"){
                echo '<p class="suberror">Invalid serial number and grade!</p>';
            }
            elseif ($_GET['error'] == "invalidgrd"){
                echo '<p class="suberror">Invalid grade!</p>';
            }
            elseif ($_GET['error'] == "invalidsnum"){
                echo '<p class="suberror">Invalid serial number!</p>';
            }
            elseif ($_GET['error'] == "snumnotexist"){
                echo '<p class="suberror">Serial number doesn\'t exist!</p>';
            }
        }
        elseif ($_GET['submit'] == "success"){
            echo '<p class="subsuccess">Grade successfully submitted!</p>';
        }
        
    echo' <form action="includes/sub_grd.php" method="post">
        <input type="text" name="hw_id" placeholder="Serial Number" value="'.$_GET['snum'].'">
        <input type="text" name="grade" placeholder="Grade" value="'.$_GET['grd'].'">
        
        <p><button class="sub-b" type="submit" name="grade-submit">Submit</button></p>
    </form>';
    
    echo '<form method="post">
    <button style="background-color:#ECC2C2" type="submit" name="sub-grd-cancel">Cancel</button>
    </form>';
    
    if (isset($_POST['sub-grd-cancel'])){
        header("Location: grades_ad.php?id=".$_SESSION['userId']);
        exit();
    }
}
    ?>
</main>