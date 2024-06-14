
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
            if (isset($_POST["register"])){
              $userName = $_POST["uname"];
              $email = $_POST["email"];
              $password = $_POST["passw"];

              $passwordHash= password_hash($password, PASSWORD_DEFAULT);

              $errors = array();

              if (empty($userName) OR empty($email) OR empty($password)){
                array_push($errors, "All fields are required");
              }

              if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is snot valid");
              }

              if (strlen($password)<8){
                array_push($errors, "Password must be atleast 8 characters long");
              }    

              require_once ("database.php");
              $sql = "SELECT * FROM users WHERE email = '$email'";
              $result = mysqli_query($conn, $sql);
              $rowCount = mysqli_num_rows($result);

              if ($rowCount>0){
                array_push($errors, "This email has been already used");
              }

              if (count($errors)>0) {
                foreach($errors as  $error) {
                echo "<div class= 'alert alert-danger'>$error</div>";
                }
              }else{
          
               $sql = "INSERT INTO users (userName, email,	password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $preparestmt = mysqli_stmt_prepare($stmt, $sql);

                if ($preparestmt) {
                  mysqli_stmt_bind_param($stmt, "sss", $userName, $email, $passwordHash );
                  mysqli_stmt_execute($stmt);
                  echo "<div classs = 'alert alert-success'>You are registered successfully!</div>";
                  header("Location: login.php");
                }else{
                        die("Something went wrong");
                      }
                      
               }
            }   
    
          ?>

          <form action="registration.php" method="post" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="uname" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="passw" placeholder="Password" />
            </div>
            <input type="submit" class="btn" name="register" value="Sign up" />
            <p class="social-text">Or Sign up with social platforms</p>
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