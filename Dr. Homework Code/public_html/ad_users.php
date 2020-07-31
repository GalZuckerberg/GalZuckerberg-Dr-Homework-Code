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
        echo '<h1>All Users:</h1>';
        
        $sql = "SELECT * FROM users";
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
                    <th class="th-g">User ID</th>
                    <th class="th-g">Name</th>
                    <th class="th-g">E-mail</th>
                    <th class="th-g">Password</th>
                    <th class="th-g">Roll</th>
                </tr>';
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($res)){
                    echo '<tr>
                            <td class="td-g">'.$row['id'].'</td>
                            <td class="td-g">'.$row['name'].'</td>
                            <td class="td-g">'.$row['email'].'</td>
                            <td class="td-g">'.$row['password'].'</td>';
                            
                            if ($row['is_admin'] == 1){
                                echo '<td class="td-g">Admin</td>';
                            }
                            else{
                                echo '<td class="td-g">None</td>';
                            }
                        echo '</tr>';
                }
                echo '</table>';    
            }
            else{
                echo 'No users found.';
            }
        }
        #ADMIN PRVLG BTTN
        echo '<form method="post">
        <p><button style="font-size: 18px" type="submit" name="grnt-adm">Grant Admin Privilege</button></p>
        </form>';
        
        if (isset($_POST['grnt-adm'])){
            header("Location: ad_grnt_ad_pg.php");
            exit();
        }
        #RVK ADMN PRVLG
        echo '<form method="post">
        <p><button style="font-size: 18px" type="submit" name="rvk-adm">Revoke Admin Privilege</button></p>
        </form>';
        
        if (isset($_POST['rvk-adm'])){
            header("Location: ad_rvk_ad_pg.php");
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