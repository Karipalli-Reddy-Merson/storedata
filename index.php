<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SecureData</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            background-color: rgb(38, 38, 80);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar{
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);
            padding: 10px 0;
        }
        .bg{
            background-color: rgb(85, 85, 87);
        }
        .btn-white {
            width: 100%;
            padding: 10px;
            border-radius: 30px;
            font-weight: 500;
            border:none;
            background-color: #fbfeff;
            transition: all 0.3s ease;
        }
        .btn-white:hover{
            background-color: #fbfeff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        a{
            text-decoration: none;
            color:black;
        }
        .container{
            margin-top: 150px;
            padding-bottom: 50px;
        }
        .features-list {
            list-style-type: none;
            padding: 0;
            margin-top: 30px;
        }
        .features-list li {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .features-list li:hover {
            background-color: rgba(206, 165, 165, 0.72);
            transform: translateY(5px);
        }
        .features-list li i {
            margin-right: 15px;
            font-size: 1.2rem;
            color: #4fc3f7;
        }
        .main-heading {
            font-weight: 700;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(243, 236, 236, 0.76);
        }
        
        .footer {
            border-top: 1px solid rgba(250, 249, 249, 0.86);
            text-align: center;
            color: rgba(253, 242, 242, 0.849);
        }
        
    </style>
  </head>
  <body>
    <nav class="navbar bg fixed-top">
      <div class="container-fluid">
        <div class="d-flex align-items-center fs-5 text-white">
         <i class="fas fa-shield-alt me-2"></i><span>SecureData</span>
        </div> 
        <div class="me-4">
            <button class="btn-white px-4"><a href="login.php"><i class="fa-solid fa-user me-2"></i>Login</a></button>
        </div>
     </div>
   </nav>

   <div class="container">
        <h1 class="main-heading text-center text-white">We keep your data secure on our protected servers</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="features-list">
                    <li>
                        <i class="fas fa-image"></i>
                        <div>
                            <h5 class="mb-1">Images</h5>
                            <p class="mb-0 small">Store and organize your photos with automatic tagging and advanced search capabilities</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-file"></i>
                        <div>
                            <h5 class="mb-1">Files</h5>
                            <p class="mb-0 small">Secure document storage with version history and collaborative editing features</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-video"></i>
                        <div>
                            <h5 class="mb-1">Videos</h5>
                            <p class="mb-0 small">High-quality video storage with adaptive streaming and backup options</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-music"></i>
                        <div>
                            <h5 class="mb-1">Audio Files</h5>
                            <p class="mb-0 small">Store and stream your music collection or podcast episodes securely</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
   </div>
   
   <footer>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                <div class="footer">
                   <p>&copy; 2025 KRMerson Solutions. All rights reserved. | <a href="#" style="color: rgba(255, 255, 255, 0.6);">Privacy Policy</a> | <a href="#" style="color: rgba(255, 255, 255, 0.6);">Terms of Service</a></p>
                </div>
               </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>