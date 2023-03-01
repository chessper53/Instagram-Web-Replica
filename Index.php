<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niggagram</title>
</head>
<style>
      .uploadedimages:hover {
        opacity: 0.7;
        cursor: pointer;
      }
      html {
        scroll-behavior: smooth;
      }
      .uploadedimages{
        margin-left: 15px;
        margin-right: 15px;
        margin-bottom: 2%;
        margin-top: 1%;
        box-shadow: 6px 6px 6px gray;
      }
      form{
        margin-bottom: 1%;
      }
      button{
        float: right;
      }
      div{
        border-top: 3px;
        border-bottom: 3px;
        border-left: 0px;
        border-right: 0px;
        border-style: solid;
        border-color: black;
        text-align: center;
        margin: auto;
      }
      #ni{
        float: right;
      }
      #Login{
        float: right;
        text-decoration: none;
      }
      #linkeroo{
        text-decoration: none;
      }
      #Logo{
        position: absolute;
        margin-left: 19%;
      }
      #Allowed{
        position: absolute;
        margin-left: 42%;
        font-size: small;
      }
</style>
<body id="top">
      <form method="post" action="" enctype='multipart/form-data'>
        <input type='file' name='file' /> <img src="https://cdn.discordapp.com/attachments/1014970261239505037/1040183125470351360/image.png" id="Logo">
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