
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        .btn-submit {
        width: 100%;
        padding: 10px;
        border-radius: 20px;
        font-weight: 500;
        background-color: #62bae2;
      }
      a{
        text-decoration:none;
      }
      .error-message {
        color: #dc3545;
        font-size: 15px;
      }
  </style>
  </head>
   <body class="bg-dark">
        <div class="container">
          <form method="POST" id="loginForm">
          <div class="row justify-content-center mt-5">
              <div class="col-sm-8 col-md-6 col-lg-5 card bg-white shadow-lg ">
                <div class="m-5">
                  <h1 class="pb-5">Login Form</h1>
                  <label >Email:</label>
                  <input type="email" name="email" id="email" placeholder="EnterEmail" class="form-control">
                  <div id="emailError" class="error-message"></div>
                  <label class="mt-4">Password</label>
                  <input type="password" name="password" id="password" placeholder="EnterPassword" class="form-control">
                  <div id="passwordError" class="error-message"></div>
                  <button type="submit" name="submit" class="btn-submit mt-4">Submit</button>
                  <p class="m-4">Don't have an account<a href="registration.php" class="ps-3">signup?</a></p>
                </div>
              </div>
          </div>
          </form>
        </div>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            
            emailError.textContent = '';
            passwordError.textContent = '';
            
          
            const email = emailInput.value.trim();
            if (email.length === 0) {
                emailError.textContent = "Please enter your email address";
                isValid = false;
            } else if (!/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email)) {
                emailError.textContent = "Please enter a valid email address";
                isValid = false;
            }
            
            
            const password = passwordInput.value.trim();
            if (password.length === 0) {
                passwordError.textContent = "Please enter your password";
                isValid = false;
            } else if (password.length < 6) {
                passwordError.textContent = "Password must be at least 6 characters";
                isValid = false;
            }
            
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    </script>

    <?php 
    if(isset($_POST["submit"])) {
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "merson";

        $conn = mysqli_connect($server, $username, $password, $dbname);

        if (!$conn) {
            die("<script>alert('Database connection failed');</script>");
        }

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM registration WHERE email = '$email' AND password = '$password' ORDER BY userid LIMIT 1";
        $run = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($run);
   
        $row = mysqli_fetch_array($run);
        $uid =   $row["userid"];

        session_start();
        
        if($num_rows > 0) {
    

          $_SESSION['uid'] = $uid;

             echo "<script>window.location.href = 'image.php';</script>";
            exit();
        } else {
            echo "<script>
                    alert('Email or password is incorrect');
            </script>";
        }
        
        mysqli_close($conn); 
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>