<?php
include 'includes/connection.php';
include 'includes/header.php';
$username = $_SESSION['user_profile'];
 ?>
<div class="video-upload">
<div class="row">
<div class="col-md-4">
  ...
</div>
<div class="col-md-4">
  <div class="upload">
  <?php
  if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $file  = $_FILES['file']['name'];
    $size  = $_FILES['file']['size'];
    $tmp   = $_FILES['file']['tmp_name'];
    $ext   = strrchr($file, '.');
    $dir   = "videos/". time().$ext;
    if (copy($tmp, $dir)) {
      echo "<h3>Video Uploaded Successfully!</h3>";
      echo "<a href='index.php'>Back</a>";
      echo "<br>";
     echo "<video src='{$dir}'height='400' width='350' border='0' autoplay></video>";
     $query = mysqli_query($con, "INSERT INTO video_upload(filename, filesize, title) VALUES('{$dir}, '{$size}', '$title' )");
    }
    else {
      echo "Error occured while uploading video, Please try again!";
    }
  }
  ?>
  </div>
<form action="" method='post' enctype="multipart/form-data">
<input type="text" class="form-control" style="background:transparent;border-radius:10px" required placeholder="Title of the Video" name="title"/><br>
<input type="file" name="file"/><br>
<b style="color:red">NOTE: </b>Maximum Video size is 100MB.
<input type="submit" class="btn-info" name="upload" value="Upload"/>
  </form>
</div>
<div class="col-md-4">
<?php echo "<h3 style='color:green'>Welcome, $username!</h3>"; ?>
</div>
</div>
</div>
<?php include 'includes/footer.php' ?>
