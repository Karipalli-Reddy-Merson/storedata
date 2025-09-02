<?php
session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "merson";

    $conn = mysqli_connect($server, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

     if($_SESSION['uid']) {

       $user = $_SESSION['uid'];

       $sql="select * from registration where userid='$user'";
        $run= mysqli_query($conn, $sql);

        $row = mysqli_fetch_array($run);

         $first=$row["firstname"];
         $last=$row["lastname"];
         $email=$row["email"];

    }else {
      echo '<script>window.location.href = "login.php";</script>';
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            padding-top: 60px; 
        }

        header {
            width: 100%;
            height: 60px;
            background-color: rgb(51, 75, 97);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 0 20px;
        }

        .header-right{
            position:relative;
        }

        .font {
            font-size: 22px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .font:hover {
            color: #64b5f6;
            transform: scale(1.1);
        }

        .profiledrop {
            position: absolute;
            top: 40px;
            right: 0;
            width: 200px;
            height:200px;
            background-color: white;
            border: 1px solid #000000ff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
            border-radius: 5px;
            z-index: 99;
        }

        .profiledrop.active {
            visibility: visible;
            opacity: 1;
        }
        a{
            text-decoration:none;
            color:white;
        }
       
        
    </style>
</head>
<body>



    <header>
        <div class="header-left">
            <i class="fa-solid fa-bars font" id="sidebar"></i>
        </div>
        <div class="header-right">
            <i class="fa-solid fa-user font" id="profile-icon"></i>
            <div class="profiledrop" id="profiledrop">

           <?php
        
           echo "<p class='text-center'>id: $user</p>";
           echo "<p class='text-center'>$first $last</p>";
           echo "<p class='text-center'>$email</p>";
            ?>
           <button class="btn btn-secondary ms-5"><a href="loginout.php">signout</a><button>
            
          </div>
    </header>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const icon = document.getElementById('profile-icon');
            const dropdown = document.getElementById('profiledrop');
            const sidebar = document.getElementById('sidebar');
            const mainbar=document.getElementById("mainbar");

            icon.addEventListener('click', () => {
                dropdown.classList.toggle('active');
            });


            sidebar.addEventListener('click', (e) => {
                e.stopPropagation();
                mainbar.classList.toggle('update');
            });

            
        });
    </script>

</body>
</html>
