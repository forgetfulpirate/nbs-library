<?php
    session_start();
    include 'inc/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="inc/css/pro1.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    <style>
        .login{
            background-image: url(inc/img/bg-login.png) ;
            background-repeat: no-repeat;
            background-size: cover; /* Adjust the width and keep the height auto */
            margin-bottom: 30px;
            padding: 50px;
            padding-bottom: 70px;
            width: auto;
            height: 700px;
            
            background-color: rgba(255, 255, 255, 0.5);
            
            

        }
      
        .reg-header h2{
            color: blue;
            z-index: 999999;
            margin-top: 100px;
            
            

            
        }
        .login-body h4{
            margin-bottom: 20px;
            
        }
        .login-content {
            border-radius: 5px;
            width: 638px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Center horizontally */
            text-align: center;
            justify-content: center; /* Center vertically */
            margin: auto; /* Center horizontally */
            background-color: rgba(255, 255, 255, 0.5); /* Adjust opacity if necessary */
        }
        
       
    </style>
</head>
<body>
    <div class="login registration">
        <div class="wrapper">
            <div class="reg-header text-center">
                <h2>ADMIN</h2>
                <div class="gap-30"></div>
                <div class="gap-30"></div>
            </div>
            <div class="gap-30"></div>
            <div class="login-content">
                <div class="login-body">
                    <h4>Librarian Login </h4>
                    <form action="" method="post">
                        <div class="mb-20">
                            <input type="text" name="username" class="form-control" placeholder="Username" required=""/>
                        </div>
                        <div class="mb-20">
                            <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
                        </div>
                        <div class="mb-20">
                         
                        </div>
                       
                        <div  class="mb-20">
                        <input class="btn btn-info submit" type="submit" name="login" value="Login">
                        <a href="registration.php">Create an Account</a>
                        </div>
                     
                       
                    </form>
                </div>
                <?php
                if (isset($_POST["login"])) {
                    $count=0;
                    $res= mysqli_query($link, "select * from lib_registration where username='$_POST[username]' && password= '$_POST[password]' ");
                    $count = mysqli_num_rows($res);
                    if ($count==0) {
                        ?>
                        <div class="alert alert-warning">
                            <strong style="color:#333">Invalid!</strong> <span style="color: red;font-weight: bold; ">Username Or Password.</span>
                        </div>
                    <?php
                    }
                    else{
                    $_SESSION["username"] = $_POST["username"];
                    ?>
                        <script type="text/javascript">
                            window.location="dashboard.php";
                        </script>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="footer text-center">
        <p>&copy; All rights reserved NBS College</p>
    </div>

<script src="inc/js/jquery-2.2.4.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/custom.js"></script>
</body>
</html>