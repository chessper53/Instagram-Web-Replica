<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Instagram</title>
</head>

<body id="top">
      <form method="post" action="" enctype='multipart/form-data'>
        <input type='submit' value='Publish Image' name='but_upload' id="ni"> <br>  <br>
        <a href="#Footer">Go to Bottom of Page</a> <a id="Login" href="Login.php">Clear Canvas</a>
      </form>
      <div>
          <?php
              require "./config.php";

              if(isset($_POST['but_upload'])){
                  $name = $_FILES['file']['name'];
                  $target_dir = "upload/";
                  $target_file = $target_dir . basename($_FILES["file"]["name"]);
                
                  // Select file type
                  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                  // Valid file extensions
                  $extensions_arr = array("jpg","jpeg","png","gif");
                
                  // Check extension
                  if( in_array($imageFileType,$extensions_arr) ){
                    // Upload file
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
                        // Insert record
                        $query = "insert into images(name) values('".$name."')";
                        mysqli_query($con,$query);
                    }
                  }
                }
                ?>
                <?php
                  $amountofImages = 0;
                  //Get Number of Row in Table
                  $sql = "SELECT * from images";
                  if ($result = mysqli_query($con, $sql)) {
                      // Return the number of rows in result set
                      $rowcount = mysqli_num_rows( $result );
                  }

                  $id = $rowcount;
                  do {
                      $sql = "select name from images  where Id = $id";
                      $result = mysqli_query($con,$sql);
                      $row = mysqli_fetch_array($result);
                      
                      $image = $row['name'];
                      $image_src = "upload/".$image;

                      if (file_exists($image_src)) {
                        echo "<a href=\"http://172.16.18.125/projekt/"."$image_src\" target=\"_blank\" id=\"linkeroo\"> <img src=\"$image_src\"  width=\"200px\" height=\"200px\" class=\"uploadedimages\"></a>";
                        $amountofImages++;
                      } else {
                        
                      }
                      
                      $id--;
                  }while ($id > 0);
                ?>
          </div>
</body>
<footer id="Footer">
        <?php
          echo "Total Amount Of Images: $amountofImages";        
        ?>
        <br>
        <a href="#top">Go to Top of Page</a>
    </footer>
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href);
    }

  </script>
</html>