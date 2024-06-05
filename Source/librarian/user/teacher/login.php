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

      <title>Faculty Login</title>
   </head>
   <style>
        .alert-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }
        .alert {
            padding: 20px;
            background-color: #f9edbe;
            border: 1px solid #f0c36d;
            border-radius: 4px;
        }
        .alert strong {
            color: #333;
        }
        .alert span {
            color: red;
            font-weight: bold;
        }
                /* Style for the button */
        .btn-back-home {
            width: 100%;
  padding: 1rem;
  border-radius: 0.5rem;
  background-color: #d52033;
  font-weight: var(--font-medium);
  cursor: pointer;
  color: White;
  margin-bottom: 2rem;
            
        }

    </style>
   <body>
      <div class="login">
         <img src="inc/img/bg-login.png" alt="login image" class="login__img">
         
         
         <form action="" method="post" class="login__form">
         <div style="display: flex; justify-content: center;">
            <img src="inc/img/nbs-logo.jpeg" style="width:150px; height:150px;">
         </div>
            <h1 class="login__title">Faculty Login</h1>
   

            <div class="login__content">
               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" id="login-email" placeholder=" " name="id_number">
                     <label for="login-email" class="login__label">ID Number</label>
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
            

            <!-- <div class="login__check">
              

               <a href="#" class="login__forgot">Forgot Password?</a>
            </div> -->
  
            <button type="submit" class="login__button" name="login">Login</button>
            <div style="text-align: center;">
            <button type="submit" class="btn-back-home" name="back_to_home" onclick="window.location.href='http://localhost/nbs-library/nbs-library/Source/librarian/user/'">
        Back to Home
    </button>
        </div>

            <p class="login__register">
               Don't have an account? <a href="registration.php" style="color:red"><span style="color:Red;">Register</span></a>
            </p>


                             <!-- Back to Home Button -->

          
           <br>
           <?php 
                    if (isset($_POST["login"])) {
                        $count=0;
                        $res1= mysqli_query($link, "select * from teacher where id_number='$_POST[id_number]' && password= '$_POST[password]' && status='yes' && verified='yes'");
                       

                        $count1 = mysqli_num_rows($res1);
                        if ($count1==0) {
                            ?>
                                <div class="alert alert-warning">
                                <strong style="color:#333">Invalid!</strong> <span style="color: red;font-weight: bold; ">ID Number Or Password.</span>
                                </div>
                            <?php
                        }
                        else{
                            $_SESSION["teacher"] = $_POST["id_number"];
                    
                       
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




