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
if (isset($_GET['id']) && !empty($_GET['id'])){
    $sql = "SELECT * FROM users WHERE id= ".$_GET['id'];
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: index.php?id=".$_SESSION['userId']);
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resCheck = mysqli_stmt_num_rows($stmt);
        if ($resCheck > 0){
            $uid = $_GET['id'];
        }
        else{ //NO USER ON DB
            $uid = $_SESSION['userId'];
            header("Location: index.php?id=".$_SESSION['userId']);
        }
    }
}
else{
    $uid = $_SESSION['userId'];
}
$sql = "SELECT name FROM users WHERE id=".$uid;
$stmt = mysqli_stmt_init($connection);
if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: index.php?error=sqlerror2&id=".$_SESSION['userId']);
    exit();
}
else{
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    echo '<h1>'.$row['name'].'\'s Homework List:</h1>';
}

$sql = "SELECT h.hw_id, h.subject, h.grade, h.comments, h.file_ext, u.name FROM hw AS h Join users AS u ON h.user_id = u.id WHERE u.id=".$uid;
$stmt = mysqli_stmt_init($connection);
if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: index.php?error=sqlerror2&id=".$_SESSION['userId']);
    exit();
}
else{
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resCheck = mysqli_stmt_num_rows($stmt);
    if ($resCheck > 0){
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        
        echo '<table class="tab-g">
            <tr>
                <th class="th-g">Serial Num</th>
                <th class="th-g">Subject</th>
                <th class="th-g">Grade</th>
                <th class="th-g">Comments</th>
                <th class="th-g">View File</th>
            </tr>';
        while($row = mysqli_fetch_assoc($res)){
            echo '<tr>
                    <td class="td-g">'.$row['hw_id'].'</td>
                    <td class="td-g">'.$row['subject'].'</td>';
                    if (is_null($row['grade'])){
                        echo '<td class="td-g" style="text-align:center">-</td>';
                    }else{
                        echo '<td class="td-g" style="text-align:center">'.$row['grade'].'</td>';
                    }
                    echo '<td class="td-g">'.$row['comments'].'</td>
                    <td class="td-g"><a href="http://shanybi.mtacloud.co.il/hw_files/'.$row['hw_id'].$row['file_ext'].'">View</a></td>
                </tr>';
        }
        echo '</table>';
    }
    else{
        echo 'No homework found.';
    }
    
}
}
?>