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
	        body {
			    font-family: Calibri;
		    }
		    .oh_no{
		        
		    }
        </style>
        </style>
    </head>
    
    <body>
        <header>
            <nav>
                <a href="login.php"><img id="logo" src="http://shanybi.mtacloud.co.il/img/Logo.jpg" alt="logo"></a>
                <div>
                    <p class="oh_no"><b>Ho no! Looks like something went wrong :(</b><br>
                    Please fill your details again in order to complete the task</p>
                    <form action="inc/login.php" method="post">
                        <input type="text" name="mail" placeholder="Email">
                        <input type="password" name="pwd" placeholder="Password">
                        
                        <p><button type="submit" name="psh-login">Login</button></p>
                        
                    </form><br>
                    <a id="Signup" href="#">Signup</a> 
                </div>
            </nav>
        </header>
        <main style="height:600px;">
        <br><br><hr>
        <h2>About Us</h2>
        
        <p>Since 2019, our only focus has been on making it simple and easy for students & their schools to adopt digital planning skills.<br>
                We know that in today's learning environment, the right approach to organization and time management (OTM), will raise the level of performance for any student.<br>
                And this is how we get in the picture...<br><br>
                With our website the students can upload this homework and the teacher can chesk them and give each student a grad.<br>
                On the website the student needs to login with his mail and password (listed in the users table).<br>
                After login the student can see all his grades on the homework that he upload and can update by the calsses of the week. <br>
                The teacher, or admin, can login and see all the students details and homeworks and can grade them. Also the admin can give another users admin privilages or revike them.<br>
                
                The website is an easy solution for any class this days.<br><br>
                <img style="width:8%;" src="https://cdn.clipart.email/acdcc2514a211974449331584e1d67d9_christmas-gif-images-clipart-9to5animations-com-home-clip-art-gif-_379-320.gif">
                </p>
        <h2>You are logged out, Come and join in @Dr.Homework!</h2>
        </main>
        <footer style="height:80px;background-image:url(http://shanybi.mtacloud.co.il/img/books.jpg);">
    </body>
</html>