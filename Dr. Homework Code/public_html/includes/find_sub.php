<?php
if (isset($_POST['find-sub'])){
    
    require 'dh_handler.php';
    
    $subject = $_POST['subject'];
    
    if (empty($subject)){
        header("Location: ../hw_sub.php?error=emptyfields");
        exit(); 
    }
    
    $sql = "SELECT * FROM subjects WHERE name= '".$subject."'";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        
        echo'<form action="../hw_sub.php" method="post">
            <input type="hidden" name="err-msg" value="'.mysqli_error($connection).'"/>
        </form>
        <script>
            document.forms[0].submit();
        </script>';
//        header("Location: ../hw_sub.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resCheck = mysqli_stmt_num_rows($stmt);
        if ($resCheck > 0){
            header("Location: ../hw_sub.php?found=success&subject=".$subject);
            exit();
        }
        else { #NO SUCH SUBJECT
            header("Location: ../hw_sub.php?error=notfound&subject=".$subject);
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