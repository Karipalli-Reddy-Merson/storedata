<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .center {
            text-shadow: 2px 2px 4px rgba(19, 18, 18, 0.76);
        }
        .container{
            max-width:700px;
        }
        td a{
            text-decoration:none;
            color:black;
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
     
    $not_allow = '';

    $select = "SELECT * FROM files where id='".$_SESSION['uid']."'";
    $run = mysqli_query($conn, $select);
    $num_rows = mysqli_num_rows($run);

  
    $file_data = [];
    while ($row = mysqli_fetch_assoc($run)) {
    $file_data[] = [
        's_no' => $row['s_no'],
        'id' =>$row['id'],
        'path' => "myfiles/" . $row['file_name']
    ];
}
    if(isset($_POST["submit"])) {
        $file_name = $_FILES["file"]["name"];
        $file = $_FILES["file"]["tmp_name"];
        $type = $_FILES["file"]["type"];

        $store_loc = "myfiles/";

        $sql = "INSERT INTO files(s_no, id,file_name) VALUES (null,'".$_SESSION['uid']."','$file_name')";

        if($type == "application/pdf") {
            $run = mysqli_query($conn, $sql);

            if($run) {
                move_uploaded_file($file, $store_loc.$file_name);
                echo "<script>window.location.href='file.php';</script>";
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
            <h1 class="text-center center mb-4">ADD FILES</h1>
            <div class="col-sm-8 col-md-5 card p-5 bg-white box mb-4">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Choose PDF File:</label>
                        <input  type="file" name="file" >
                        <?php echo "<div class='text-danger mt-2'>".$not_allow."</div>" ?>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-secondary" name="submit">Upload File</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-8 col-md-5 card p-5  bg-white box">
                <h4 class="text-center">Number Of  Files</h4>
                <i class="fa-solid fa-file fs-2 text-center"></i>
                <?php echo "<h1 class='text-center'>".$num_rows."</h1>" ?>
            </div>
        </div>

        <div class="row justify-content-center mt-5 ">
        <div class="col-md-10 col">
            <table class="table table-bordered box">
                    <tr>
                        <th>S.No</th>
                        <th>ID</th>
                        <th>Files Path</th>
                        <th>Preview</th>
                        <th>Delete</th>
                    </tr>
                    <?php $rollno = ''; foreach ($file_data as $file): $rollno++;?>
                    <tr>
                        <td><?php echo ($rollno++); ?></td>
                        <td><?php echo ($file['id']); ?></td>
                        <td><?php echo ($file['path']); ?></td>
                        <td><a href="<?php echo $file['path']; ?>" target="_blank">View File</a></td>
                        <td><a href="file.php?delid=<?php echo $file['s_no']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
    </div>
   
    <?php
        if(isset($_GET['delid'])) {

         $did = $_GET['delid'];


        $del_q = "DELETE FROM files WHERE s_no = '$did'";

        $del_run = mysqli_query($conn,$del_q);

        if($del_run) {
           if (file_exists($file['path'])) {
                unlink($file['path']);
            }
            
            echo '<script>window.location.href = "file.php";</script>';
        }else {
            echo '<script>alert("somting wrong");</script>';
        } 

    }

    ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>