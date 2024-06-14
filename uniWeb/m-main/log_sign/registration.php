
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css">
    <title>Sign in & Sign up Form</title>
  </head>
  <body>


    <!-- ``````````` -->
  
    
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
          <div class="container">
          <div class="box form-box">
               <header>
                  Sign Up
               </header>
                    <div class="field input">
                         <label for="fname"> First Name </label>
                         <input type="text" name="fname" id="fname" required>
                    </div>

                    <div class="field input">
                         <label for="lname"> Last Name </label>
                         <input type="text" name="lname" id="lname" >
                    </div>

                    <div class="field input">
                         <label for="username"> Username </label>
                         <input type="text" name="username" id="username" required>
                    </div>
                    <div class="field input">
                         <label for="start">Birthday</label>
                         <input type="date" id="start" name="bday" value="2020-01-01" max="2023-01-01"  />
                    </div>
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
                    <br>
                    <div class="links">
                         Already have an account?
                         <a href="login.php" >
                          Login
                         </a>
                    </div>
               </form>
          </div>
     </div>
  </body>
</html>