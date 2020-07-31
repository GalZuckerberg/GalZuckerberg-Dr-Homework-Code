<?php
session_start();
require 'includes/dh_handler.php';
require "header.php";

    
echo '<style>
            body {
			    font-family: Calibri;
		    }
		    .tab-g{
		        border-collapse: collapse;
		    }
		    .th-g, .td-g{
		        padding: 15px;
		        border-bottom: 1px solid #D8CCCC;
		    }
		    .th-g{
		        background-color: #600D0D;
		        color: white;
		        
		    }
    </style>';
if (isset($_SESSION['userId'])){
    if ($_SESSION['is_admin'] == 1){ #Admin
        echo '<h1>Homework List</h1>';
        echo '<h2>Ungraded Homework:</h2>';
        $sql = "SELECT h.hw_id, h.subject, h.grade, h.comments, h.file_ext, u.name FROM hw AS h Join users AS u ON h.user_id = u.id WHERE h.grade IS NULL ORDER BY h.hw_id ASC";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: index.php?error=sqlerror1&id=".$_SESSION['userId']);
            exit();
        }
        else{
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resCheck = mysqli_stmt_num_rows($stmt);
            if ($resCheck > 0){
                echo '<table class="tab-g">
                <tr>
                    <th class="th-g">Serial Num</th>
                    <th class="th-g">Name</th>
                    <th class="th-g">Subject</th>
                    <th class="th-g">Grade</th>
                    <th class="th-g">Comments</th>
                    <th class="th-g">View File</th>
                </tr>';
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($res)){
                    echo '<tr>
                            <td class="td-g">'.$row['hw_id'].'</td>
                            <td class="td-g">'.$row['name'].'</td>
                            <td class="td-g">'.$row['subject'].'</td>
                            <td class="td-g" style="text-align:center">-</td>
                            <td class="td-g">'.$row['comments'].'</td>
                            <td class="td-g"><a href="http://shanybi.mtacloud.co.il/hw_files/'.$row['hw_id'].$row['file_ext'].'">View</a></td>
                        </tr>';
                }
                echo '</table>';    
                
            }
            else{
                echo 'No ungraded homework found.';
            }
        }
        echo '<h2>Graded Homework:</h2>';
        $sql = "SELECT h.hw_id, h.subject, h.grade, h.comments, u.name FROM hw AS h Join users AS u ON h.user_id = u.id WHERE h.grade IS NOT NULL ORDER BY h.hw_id ASC";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: index.php?error=sqlerror1&id=".$_SESSION['userId']);
            exit();
        }
        else{
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resCheck = mysqli_stmt_num_rows($stmt);
            if ($resCheck > 0){
                echo '<table class="tab-g">
                <tr>
                    <th class="th-g">Serial Num</th>
                    <th class="th-g">Name</th>
                    <th class="th-g">Subject</th>
                    <th class="th-g">Grade</th>
                    <th class="th-g">Comments</th>
                    <th class="th-g">View File</th>
                </tr>';
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($res)){
                    echo '<tr>
                            <td class="td-g">'.$row['hw_id'].'</td>
                            <td class="td-g">'.$row['name'].'</td>
                            <td class="td-g">'.$row['subject'].'</td>
                            <td class="td-g" style="text-align:center">'.$row['grade'].'</td>
                            <td class="td-g">'.$row['comments'].'</td>
                            <td class="td-g"><a href="http://shanybi.mtacloud.co.il/hw_files/'.$row['hw_id'].$row['file_ext'].'">View</a></td>
                        </tr>';
                }
                echo '</table>';
            }
            else{
                echo 'No graded homework found.';
            }
        }
        echo '<form method="post">
        <p><button style="font-size: 18px" type="submit" name="sub-grd">Submit Grade</button></p>
        </form>';
        
        if (isset($_POST['sub-grd'])){
            header("Location: ad_sub_grd_pg.php?id=".$_SESSION['userId']);
            exit();
    }
    }
    else{ #Not an Admin
        header("Location: index.php?id=".$_SESSION['userId']);
        exit();
    }
}
else{ #Not logged in
    header("Location: index.php");
    exit();
}
?>