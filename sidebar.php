<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dash1</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
   .sidebar {
    display: flex;
    flex-direction: column;
    width: 60px;
    min-height: calc(100vh + 60px);
    background-color: rgb(51, 75, 97);
    transition: linear 0.5s;
    overflow: hidden;
    position: fixed;
    top: 60px;
    left: 0;
    z-index: 90;
}

.sidebar li {
    display: flex;
    list-style: none;
    padding: 10px 0 15px 30px;
    font-size: 20px;
    color: white;
}

.sidebar li p {
    padding-left: 13px;
}
.sidebar li p a{
    text-decoration:none;
    color:white;
}

.sidebar li:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.update {
    width: 180px;
}
</style>
</head>
<body>
    <div class="sidebar" id="mainbar">
            <li><i class="fas fa-image"></i><p><a href="image.php">Images</a></p></li>
            <li><i class="fas fa-file"></i><p><a href="file.php"> Files</a></p></li>
            <li><i class="fas fa-video"></i><p><a href="video.php"> Videos</a></p></li>
            <li><i class="fas fa-music"></i><p><a href="audio.php"> Audio Files</a></p></li>
    </div>

</body>
</html>
