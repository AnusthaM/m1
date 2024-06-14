<?php
session_start();
if(isset($_SESSION["user"])){
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet"  href="style.css">
    <title>Sign in & Sign up Form</title>
  </head>
  <body>


  
        <?php
            if (isset($_POST["login"])){
              $userName = $_POST["uname"];
              $password = $_POST["passw"];
               require_once "database.php";
               $sql = "SELECT * FROM users WHERE userName = '$userName'";
               $result = mysqli_query($conn, $sql);
               $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

               if ($user){
                 if (password_verify($password, $user["password"])){
                    if (password_verify($password, $user["password"])){
                        session_start();
                        $_SESSION["user"] = "yes";
                        header("Location: index.php");
                    }
                        die();
                    }else{
                        echo "<div class = 'alert alert-danger'> Password does not match</div>";
                    }
                
                }else{
                echo "<div class = 'alert alert-danger'> The email does not match</div>";

               }
            }

        ?>    


         <form action="login.php" method="post" class="sign-in-form">
         <div class="container">
          <div class="box form-box">
               <header>
                    Login
               </header>
               <form action="" method="post">
                    <div class="field input">
                         <label for="email"> Email </label>
                         <input type="email" name="email" id="email" required>
                    </div>

                    <div class="field input">
                         <label for="password"> Password </label>
                         <input type="password" name="password" id="password" required>
                    </div>

                    <div class="btn">
                         <button name="submit" >Login</button>
                    </div>
                    <div class="links">
        <br>
                         Don't have an account?
                         <a href="registration.php" >
                              Sign-up
                         </a>
                    </div>
               </form>
          </div>
     </div>
  </body>
</html>