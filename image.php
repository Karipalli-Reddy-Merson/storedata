<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .center {
            text-shadow: 2px 2px 4px rgba(19, 18, 18, 0.76);
        }
        .container {
            max-width: 700px;
        }
        .box:hover{
            box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.5);

        }
         
        @media (max-width: 767px) {
            .col-sm-6 {
                margin-left: 100px;
                margin-top: 20px;
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

if (!$conn) {
    echo "<script>alert('Server not connected');</script>";
}

$not_allow = "";

$select = "SELECT * FROM images where id='".$_SESSION['uid']."'";
$run = mysqli_query($conn, $select);
$num_rows = mysqli_num_rows($run);

$image_data = [];
while ($row = mysqli_fetch_assoc($run)) {
    $image_data[] = [
        's_no' => $row['s_no'],
        'id' =>$row['id'],
        'path' => "myimages/" . $row['image_name']
    ];
}

if (isset($_POST["submit"])) {
    $image_name = $_FILES["file"]["name"];
    $tmp_image = $_FILES["file"]["tmp_name"];
    $type = $_FILES["file"]["type"];

    $store_loc = "myimages/";
    $sql = "INSERT INTO images(s_no,id, image_name) VALUES (NULL,'".$_SESSION['uid']."','$image_name')";

    if ($type == "image/png" || $type == "image/PNG" || $type == "image/jpg" || $type == "image/JPG" || $type == "image/jpeg" || $type == "image/JPEG" || $type == "image/webp"  || $type == "image/WEBP" || $type == "image/jfif") {
        $run = mysqli_query($conn, $sql);

        if ($run) {
            move_uploaded_file($tmp_image, $store_loc . $image_name);
            echo "<script>window.location.href='image.php';</script>";
        } else {
            echo "<script>alert('Insert failed');</script>";
        }
    } else {
        $not_allow = "File type not allowed: " . $type;
    }
}



?>

<div class="container mt-5 pt-5">
    <div class="row justify-content-between">
        <h1 class="text-center center mb-4">ADD IMAGES</h1>

       
        <div class="col-sm-6 col-md-5 card p-5 bg-white box">
            <form method="POST" enctype="multipart/form-data">
                <label>Choose Image:</label>
                <input type="file" name="file" >
                <h6 class='text-danger mt-2'><?php echo $not_allow; ?></h6>

                <div class="mt-3">
                    <button type="submit" class="btn btn-secondary" name="submit">Submit</button>
                </div>
            </form>
        </div>

        
        <div class="col-sm-6 col-md-5 card p-5 bg-white box">
            <h4 class="text-center">Number Of Images</h4>
            <i class="fa-solid fa-images fs-2 text-center"></i>
            <h1 class="text-center"><?php echo $num_rows; ?></h1>
        </div>
    </div>

   
    <div class="row justify-content-center mt-5 ">
        <div class="col-md-10 col">
            <table class="table table-bordered box">
                    <tr>
                        <th>S.No</th>
                        <th>User ID</th>
                        <th>Image Path</th>
                        <th>Preview</th>
                        <th>Delete</th>
                    </tr>
                    <?php  $rollno = ''; foreach ($image_data as $image): $rollno++;?>
                    <tr>
                        <td><?php echo ($rollno++); ?></td>
                        <td><?php echo ($image['id']); ?></td>
                        <td><?php echo ($image['path']); ?></td>
                        <td><img src="<?php echo ($image['path']); ?>" alt="Image" width="100"></td>
                        <td><a href="image.php?delid=<?php echo $image['s_no']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>


<?php

 if(isset($_GET['delid'])) {

         $did = $_GET['delid'];


        $del_q = "DELETE FROM images WHERE s_no = '$did'";

        $del_run = mysqli_query($conn,$del_q);

        if($del_run) {
           if (file_exists($image['path'])) {
                unlink($image['path']);
            }
            
            echo '<script>window.location.href = "image.php";</script>';
        }else {
            echo '<script>alert("somting wrong");</script>';
        } 

    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
