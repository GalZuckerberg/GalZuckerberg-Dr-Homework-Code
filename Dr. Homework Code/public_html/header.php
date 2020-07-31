<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title>Dr. Homework</title>
        <style>
            #logo {
                margin:auto;
            }
            #Signup {
		        text-decoration:none;
		        color:#B22222;
		        font-weight:bold;
		        font-size:107%;
		        height:20px;
            }
		    ul {
                list-style-type: none;
                width:98%;
                margin: 0;
                overflow: hidden;
                background-color:#A51818;
		    }
		    li a {
		        float: left;
		        display:block;
		        text-decoration:none;
		        color:white;
                background-color:#A51818;
                width:130px;
                padding:14PX 16PX;
                margin:0;
                text-align:center;
	        }
	        .lgt_b{
	            padding:14PX 16PX;
	            float: right;
	        }
	        .loginerror{
	            color: #D00C0C;
	        }
        </style>
        </style>
    </head>
    
    <body>
        <header>
            <nav>
                <a href="index.php"><img id="logo" src="img/Logo.jpg" alt="logo"></a>
                <br><br><br>
                <div>
                    <?php
                        if (isset($_SESSION['userId'])){
                            echo '';
                        }else{
                            if (isset($_GET['error'])){
                                if ($_GET['error'] == "emptyfields"){
                                    echo '<p class="loginerror">Please fill in all fields!</p>';
                                } elseif ($_GET['error'] == "wrongpassword"){
                                    echo '<p class="loginerror">Wrong password!</p>';
                                }elseif ($_GET['error'] == "nouser"){
                                    echo '<p class="loginerror">User doesn\'t exist!</p>';
                                }
                            }
                            
                            echo '<form action="includes/login.php" method="post">
                                <input type="text" name="mail" placeholder="Email" value="'.$_GET['mail'].'">
                                <input type="password" name="pwd" placeholder="Password">
                                <button type="submit" name="login-submit">Login</button>
                            </form>
                            <br>
                            <a id="Signup" href="signup_page.php">Signup</a>';
                        }
                    ?>
                </div>
                <?php
                if (isset($_SESSION['userId'])){
                    echo '<ul >
                        <li><a href="index.php?id='.$_SESSION['userId'].'">Home</a></li>';
                        if ($_SESSION['is_admin'] == 0){ #not admin
                            if (isset($_GET['id']) && !empty($_GET['id'])){
                                echo '<li><a href="grades_us.php?id='.$_GET['id'].'">Your Homework</a></li>';
                            }else{
                                echo '<li><a href="grades_us.php">Your Homework</a></li>';
                            }
                        }
                        if ($_SESSION['is_admin'] == 1){ #admin
                            echo '<li><a href="grades_ad.php">Manage Homework</a></li>';
                            echo '<li><a href="ad_users.php">Manage Users</a></li>';
                            echo '<li><a href="srvr_mng.php">Manage Server</a></li>';
                        }
                        
                        echo '<li><a href="hw_sub.php">Subjects List</a></li>';
                        echo '<li><a href="about_us.php">About Us</a></li>';
                        
                        
                        
                        echo '
                        <form class="lgt_b" action="includes/logout.php" method="post">
                            <button type="submit" name="logout-submit">Logout</button>
                        </form>
                    </ul>';
                }
                ?>
            </nav>
        </header>
    </body>
</html>