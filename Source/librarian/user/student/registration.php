<?php
session_start();
include 'inc/connection.php';
include 'inc/function.php';
?>
<style>
    .error{
        color:red
    }
    </style>


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

      <title>Student Registration</title>
   </head>
   <body>
      <div class="login">
         <img src="inc/img/bg-login.png" alt="login image" class="login__img">
         

         <form action="" method="post" class="login__form">
            <h1 class="login__title">Student Registration</h1>
            <?php if($error_m): ?>
                <p class="error"><?php echo $error_m; ?></p>
            <?php endif; ?>
            <?php if($error_uname): ?>
                <p class="error"><?php echo $error_uname; ?></p>
            <?php endif; ?>
            <?php if($error_email): ?>
                <p class="error"><?php echo $error_email; ?></p>
            <?php endif; ?>
            <?php if($error_ua): ?>
                <p class="error"><?php echo $error_ua; ?></p>
            <?php endif; ?>
            <?php if($e_msg): ?>
                <p class="error"><?php echo $e_msg; ?></p>
            <?php endif; ?>
            <?php if($error_student): ?>
                <p class="error"><?php echo $error_student; ?></p>
            <?php endif; ?>
<br>
            <div class="login__content">

            <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="student_number">
                     <label for="login-name" class="login__label">Student No</label>
                  </div>
               </div>

                <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="first_name">
                     <label for="login-name" class="login__label">First Name</label>
                  </div>
               </div>

               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="last_name">
                     <label for="login-username" class="login__label">Last Name</label>
                  </div>
               </div>

               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="middle_name">
                     <label for="login-username" class="login__label">Middle Name</label>
                  </div>
               </div>

               <div class="login__box">
               <i class="fa-regular fa-envelope login__icon"></i>

                  <div class="login__box-input">
                     <input type="email" required class="login__input" id="login-email" placeholder="" name="email">
                     <label for="login-email" class="login__label">Email</label>
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

               <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>
                    <div class="login__box-input">
                        <select class="login__input" id="login-role" name="year" style="border:0;">
                            <option value="" selected></option>
                            <option value="1st year">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                            <option value="4th">4th</option>
                        </select>
                        <label for="login-role" class="login__label">Year</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>
                    <div class="login__box-input">
                        <select class="login__input" id="login-role" name="course" style="border:0;">
                            <option value="" selected></option>
                            <option value="BSCS">BSCS</option>
                            <option value="BSA">BSA</option>
                            <option value="BSAIS">BSAIS</option>
                            <option value="BSEntrep">BSEntrep</option>
                        </select>
                        <label for="login-role" class="login__label">Course</label>
                    </div>
                </div>

               

           
            </div>

            <div class="login__check">
              

              
            </div>

            <button type="submit" class="login__button" name="submit">Register</button>

            <p class="login__register">
                Already have an account?<a href="login.php" style="color:red"><span style="color:Red;">Login</span></a>
            </p>
         </form>
       
       
      </div>

      
   
      
      <!--=============== MAIN JS ===============-->
      <script src="inc/js/login.js"></script>
   </body>
</html>


