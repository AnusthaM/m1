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
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>


    <!-- ``````````` -->
    <div class="box">
      <p class="box-p1"><a href="home.html">HOME</a><a href="registration.php">/ REGISTER</a></p>
    </div>
  
    <div class="container">
      
      <div class="forms-container">
        <div class="signin-signup">
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
             <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name= "uname" placeholder="Username" />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="passw" placeholder="Password" />
                </div>
                <input type="submit" name="login" value="Login" class="btn solid" />
                <p class="social-text">Or Sign in with social platforms</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                     <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                     <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                         <i class="fab fa-linkedin-in"></i>
                    </a>
             </div>
          </form>  
          </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <button class="btn transparent" id="sign-up-btn">
             <a href="registration.php"> Sign up</a>
            </button>
            
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
       
      </div>
    </div>
    <div class="panel right-panel">
          <div class="content">
            <h3>Already have an account ?</h3>
        
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div> 


    <script src="app.js"></script>
  </body>
</html>