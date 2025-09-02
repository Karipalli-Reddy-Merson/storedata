<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .btn-submit {
      width: 100%;
      padding: 10px;
      border-radius: 20px;
      font-weight: 500;
      background-color: #62bae2;
    }
    .error-message {
      color: #dc3545;
      font-size: 15px;
    }
  </style>
</head>
<body class="bg-dark">
  <div class="container">
    <form method="POST" id="registrationForm">
      <div class="row justify-content-center mt-5">
        <div class="col-sm-8 col-md-6 col-lg-5 card bg-white shadow-lg">
          <div class="m-5">
            <h1 class="pb-5">Registration Form</h1>

            <label>UserID:</label>
            <input type="text" name="userid" id="userid" placeholder="Enter UserID" class="form-control">
            <div class="error-message" id="usererror"></div>
            
            <label>FirstName:</label>
            <input type="text" name="firstname" id="firstname" placeholder="Enter FirstName" class="form-control">
            <div class="error-message" id="firsterror"></div>
            
            <label class="mt-2">LastName:</label>
            <input type="text" name="lastname" id="lastname" placeholder="Enter LastName" class="form-control">
            <div class="error-message" id="lasterror"></div>
            
            <label class="mt-2">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control">
            <div class="error-message" id="emailerror"></div>
            
            <label class="mt-2">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
            <div class="error-message" id="passworderror"></div>
            
            <label class="mt-2">Re-Type Password:</label>
            <input type="password" name="repassword" id="repassword" placeholder="Re-Type Password" class="form-control">
            <div class="error-message" id="repassworderror"></div>
            
            <label class="mt-2">Contact:</label>
            <input type="text" name="contact" id="contact" placeholder="Enter Contact Number" class="form-control">
            <div class="error-message" id="contacterror"></div>
            
            <button type="submit" name="submit" class="btn-submit mt-4">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const registrationForm = document.getElementById('registrationForm');
      const userError = document.getElementById('usererror');
      const firstError = document.getElementById('firsterror');
      const lastError = document.getElementById('lasterror');
      const emailError = document.getElementById('emailerror');
      const passwordError = document.getElementById('passworderror');
      const repasswordError = document.getElementById('repassworderror');
      const contactError = document.getElementById('contacterror');

      registrationForm.addEventListener('submit', function(e) {
        let isValid = true;

        // Reset error messages
        [userError,firstError, lastError, emailError, passwordError, repasswordError, contactError].forEach(el => el.textContent = '');

         const user = document.getElementById('userid').value.trim();
        if (!user) {
          userError.textContent = 'Please enter userid';
          isValid = false;
        }


        const first = document.getElementById('firstname').value.trim();
        if (!first) {
          firstError.textContent = 'Please enter firstname';
          isValid = false;
        }

        const last = document.getElementById('lastname').value.trim();
        if (!last) {
          lastError.textContent = 'Please enter lastname';
          isValid = false;
        }

        const email = document.getElementById('email').value.trim();
        if (!email) {
          emailError.textContent = 'Please enter your email address';
          isValid = false;
        } else if (!/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email)) {
          emailError.textContent = 'Please enter a valid email address';
          isValid = false;
        }

        const password = document.getElementById('password').value.trim();
        if (!password) {
          passwordError.textContent = 'Please enter your password';
          isValid = false;
        } else if (password.length < 6) {
          passwordError.textContent = 'Password must be at least 6 characters';
          isValid = false;
        }

        const repassword = document.getElementById('repassword').value.trim();
        if (!repassword) {
          repasswordError.textContent = 'Please re-type your password';
          isValid = false;
        } else if (repassword !== password) {
          repasswordError.textContent = 'Passwords do not match';
          isValid = false;
        }

        const contact = document.getElementById('contact').value.trim();
        if (!contact) {
          contactError.textContent = 'Please enter your number';
          isValid = false;
        } else if (!/^\d{10}$/.test(contact)) {
          contactError.textContent = 'Please enter a valid 10-digit number';
          isValid = false;
        }

        if (!isValid) {
          e.preventDefault();
        }
      });
    });
  </script>

<?php
if (isset($_POST["submit"])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "merson";

    $conn = mysqli_connect($server, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user = mysqli_real_escape_string($conn, $_POST['userid']);
    $first = mysqli_real_escape_string($conn, $_POST['firstname']);
    $last = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $repassword = mysqli_real_escape_string($conn, $_POST['repassword']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    $sql = "INSERT INTO registration (userid,firstname, lastname, email, password, repassword, contact)
            VALUES ('$user','$first', '$last', '$email', '$password', '$repassword', '$contact')";

    $run= mysqli_query($conn, $sql);

    if ($run) {
      
       echo "<script>window.location.href = 'login.php';</script>";

        exit(); 
    } else {
        echo "<script>alert('Insert failed');</script>";
    }

    mysqli_close($conn);
}
?>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>