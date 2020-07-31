<?php
    require "header.php";
    require 'includes/dh_handler.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <style>
            body {
			    font-family: Calibri;
		    }
		    #l1 {
		    	color:#4AA268;
		    	background-color:white;
	    	}
		    #l2 {
    			color:#AB7E16;
    			background-color:white;
	    	}
		    #l3 {
			    color:#EA921A;
			    background-color:white;
		    }
		    #l4 {
			    color:#D55431;
			    background-color:white;
		    }
		    #l5 {
			    color:#B8311C;
			    background-color:white;
		    }
		        .suberror{
                    color: #D00C0C;
                }
                .subsuccess{
                    color: #2F940C;
                }
        </style>
    </head>
    <body>
        <?php
    if (isset($_SESSION['userId'])){
    echo '
        <main style="height:1050px;">
            <div class="class">
    			<h1>Classes of the week:</h1>
    			
    			<h3>Find a Sub-subject</h3>
    			<form action="includes/find_sub.php" method="post">
                    <input type="text" name="subject" placeholder="Subject" value="'.$_GET['subject'].'">
                    <button type="submit" name="find-sub">Find</button>
                </form>';
    			
    			if (isset($_GET['error'])){
                    if ($_GET['error'] == "emptyfields"){
                        echo '<p class="suberror">Please fill the field!</p>';
                    }
                    elseif ($_GET['error'] == "notfound"){
                        echo '<p class="suberror">Subject was not found!</p>';
                    }
                }
                elseif ($_GET['found'] == "success"){
                    echo '<p class="subsuccess">We teach this subject!</p>';
                }
    			else{
    			    echo '<br><br>';
    			}
    			echo '<br>';
    			
    			
    			$sql = "SELECT parent_sub FROM `subjects` GROUP BY parent_sub";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: index.php?error=sqlerror2&id=".$_SESSION['userId']);
                    exit();
                }
    			else{
    			    $sub_arr = array();
    			    $i = 1;
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($res)){
                        array_push($sub_arr,$row['parent_sub']);
                    }
                    
                    foreach ($sub_arr as $sub){
                        echo '<ul id="l'.$i.'"><b>'.$sub.':</b>';
                        $sql = "SELECT name FROM `subjects` WHERE parent_sub ='".$sub."'";
                        $stmt = mysqli_stmt_init($connection);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: index.php?error=sqlerror2&id=".$_SESSION['userId']);
                            exit();
                        }
            			else{
                            mysqli_stmt_execute($stmt);
                            $res = mysqli_stmt_get_result($stmt);
                            while($row = mysqli_fetch_assoc($res)){
                                echo '<li>'.$row['name'].'</li>';
                        }}
                        echo '</ul><br>';
                        $i ++;
                    }
                    echo '</div>';
    			}
    }
	else{
	    echo '<main style="height:600px;">';
	}
?>    	
        </main>
        <footer style="height:80px;background-image:url(img/books.jpg);">

    </body>
</html>
