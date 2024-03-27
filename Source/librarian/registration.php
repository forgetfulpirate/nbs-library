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
            <h1 class="login__title">Admin Login</h1>
            <?php 
                if (isset($_POST["submit"])) {
                    $photo = "upload/avatar.jpg";
                    mysqli_query($link, "insert into lib_registration values('','$_POST[name]','$_POST[username]','$_POST[password]','$_POST[email]','','$_POST[phone]','$photo','')");
                    ?>
                        <div class="alert alert-success col-lg-6" style="color:green">
                            Registration successfully
                        </div>
                    <?php
                }
             ?>

<br>
            <div class="login__content">
                <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="name">
                     <label for="login-name" class="login__label">Name</label>
                  </div>
               </div>

               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="username">
                     <label for="login-username" class="login__label">Username</label>
                  </div>
               </div>

               <div class="login__box">
               <i class="fa-regular fa-envelope login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="email">
                     <label for="login-email" class="login__label">Email</label>
                  </div>
               </div>

               <div class="login__box">
               <i class="fa-solid fa-mobile-screen login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="phone">
                     <label for="login-phone" class="login__label">Phone No</label>
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
              

              
            </div>

            <button type="submit" class="login__button" name="submit">Login</button>

            <p class="login__register">
               Don't have an account? <a href="login.php" style="color:red"><span style="color:Red;">Login</span></a>
            </p>

          
           
               
         </form>
       
       
      </div>
   
      
      <!--=============== MAIN JS ===============-->
      <script src="inc/js/login.js"></script>
   </body>
</html>