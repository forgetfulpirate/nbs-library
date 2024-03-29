<?php
    session_start();
    include 'inc/connection.php';
?>
<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
      <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="inc/css/login.css">

      <title>Animated login form - Bedimcode</title>
   </head>
   <body>
      <div class="login">
         <img src="inc/img/bg-login.png" alt="login image" class="login__img">
         
         
         <form action="" method="post" class="login__form">
         <div style="display: flex; justify-content: center;">
            <img src="inc/img/nbs-logo.jpeg" style="width:150px; height:150px;">
         </div>
            <h1 class="login__title">Admin Login</h1>
   

            <div class="login__content">
               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="username">
                     <label for="login-email" class="login__label">Username</label>
                  </div>
               </div>

               <div class="login__box">
                  <i class="ri-lock-2-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="password" required class="login__input" id="login-pass" placeholder=" " name="password" >
                     <label for="login-pass" class="login__label">Password</label>
                     <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                  </div>
               </div>
            </div>
            

            <div class="login__check">
              

               <a href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <button type="submit" class="login__button" name="login">Login</button>

            <p class="login__register">
               Don't have an account? <a href="registration.php" style="color:red"><span style="color:Red;">Register</span></a>
            </p>

          
           <br>
            <?php
                if (isset($_POST["login"])) {
                    $count=0;
                    $res= mysqli_query($link, "select * from lib_registration where username='$_POST[username]' && password= '$_POST[password]' ");
                    $count = mysqli_num_rows($res);
                    if ($count==0) {
                        ?>
                        <p>
                        <div class="alert alert-warning" style="text-align: center">
                    
                        <strong style="color:#333">Invalid</strong> <span style="color: red;font-weight: bold; ">Username Or Password.</span>
                        </div>
                        </p>
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
         </form>
         
       
       
      </div>
   
      
      <!--=============== MAIN JS ===============-->
      <script src="inc/js/login.js"></script>
   </body>
</html>