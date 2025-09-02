<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .center {
            text-shadow: 2px 2px 4px rgba(19, 18, 18, 0.76);
        }
        .container{
            max-width:700px;
        }
        .box:hover{
            box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.5);

        }

        @media (max-width:767px){
            .col-sm-8{
                margin-left:100px;
                margin-top:20px;
            }
            .col{
                margin-left: 100px;
            }
        }
        

    </style>
</head>
<body>
    
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

    <?php 
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "merson";
    
    $conn = mysqli_connect($server, $username, $password, $dbname);

    if(!$conn){
        echo "<script>alert('server not connect');</script>";
    }
     
    $select = "SELECT * FROM videos where id='".$_SESSION['uid']."'";
    $run = mysqli_query($conn, $select);
    $num_rows = mysqli_num_rows($run);

    $video_data = [];
    while ($row = mysqli_fetch_assoc($run)) {
    $video_data[] = [
        's_no' => $row['s_no'],
        'id' =>$row['id'],
        'path' => "myvideos/" . $row['video_name']
    ];
}

    $not_allow = '';

    if(isset($_POST["submit"])) {
        $video_name = $_FILES["video"]["name"];
        $video = $_FILES["video"]["tmp_name"];
        $type = $_FILES["video"]["type"];

        $store_loc = "myvideos/";

        $sql = "INSERT INTO videos(s_no,id, video_name) VALUES (null,'".$_SESSION['uid']."','$video_name')";
        if($type == "video/mp4") {
            $run = mysqli_query($conn, $sql);

            if($run) {
                move_uploaded_file($video, $store_loc.$video_name);
                echo "<script>window.location.href='video.php';</script>";
            } else {
                echo "<script>alert('insert failed');</script>";
            }
        } else {
            $not_allow = "Not allowed this ".$type;
        }
    }
    ?>

    
    <div class="container mt-5 pt-5">
        <div class="row  justify-content-between">
            <h1 class="text-center center mb-4">ADD VIDEOS</h1>
            <div class="col-sm-8 col-md-5 card p-5 bg-white box mb-4">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Choose video:</label>
                        <input  type="file" name="video" >
                        <?php echo "<div class='text-danger mt-2'>".$not_allow."</div>" ?>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-secondary" name="submit">Upload video</button>
                    </div>
                </form>
            </div>
           <div class="col-sm-8 col-md-5 card p-5  bg-white box">
                <h4 class="text-center">Number Of Videos</h4>
                <i class="fa-solid fa-video fs-2 text-center"></i>
                <?php echo "<h1 class='text-center'>".$num_rows."</h1>" ?>
            </div>
        </div>
        <div class="row justify-content-center mt-5 ">
        <div class="col-md-10 col ">
            <table class="table table-bordered box">
                    <tr>
                        <th>S.No</th>
                        <th>ID</th>
                        <th>Files Path</th>
                        <th>Preview</th>
                        <th>Delete</th>
                    </tr>
                    <?php $rollno = ''; foreach ($video_data as $video): $rollno++;?>
                    <tr>
                        <td><?php echo ($rollno++); ?></td>
                        <td><?php echo $video['id']; ?></td>
                        <td><?php echo $video['path']; ?></td>
                        <td>
                          <video width="300" height="200" controls>
                          <source src="<?php echo $video['path']; ?>" type="video/mp4">
                             Your browser does not support the video tag.
                           </video>
                        </td>
                        <td><a href="video.php?delid=<?php echo $video['s_no']; ?>"><button class="btn btn-danger">Delete</button></a></td>

                    </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
    </div>
   
    <?php
      if(isset($_GET['delid'])) {

         $did = $_GET['delid'];


        $del_q = "DELETE FROM videos WHERE s_no = '$did'";

        $del_run = mysqli_query($conn,$del_q);

        if($del_run) {
           if (file_exists($video['path'])) {
                unlink($video['path']);
            }
            
            echo '<script>window.location.href = "video.php";</script>';
        }else {
            echo '<script>alert("somting wrong");</script>';
        } 

    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>