<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Login</title>
</head>

<body>
     <form action="" method="get">
        <input type="text" placeholder="Username" name="username"> <br><br>
        <input type="password" placeholder="Password" name="password"> <br><br>
        <a href="" onclick="test()">Forgot Password</a> <br><br>
        
        <input type="submit" name="submit" value="Log In">
     </form>

<?php
    require "./config.php";
    $pdo;
    $sql = "SELECT * FROM admin";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ActualUsername = $row['Username'];
        $ActualPassword = $row['Password'];
    }

    if( isset($_GET['submit']) )
    {

    $username = htmlentities($_GET['username']);
    $password = htmlentities($_GET['password']);

    $result = myFunction($username, $password,$ActualUsername,$ActualPassword);
    }

    ?>
    <?php if( isset($result) ) echo $result;?>
    <?php
        function myFunction($username, $password,$ActualUsername,$ActualPassword){
            if($ActualUsername == $username){
                if($ActualPassword == $password){
                    truncateTable();
                }
            }
        }
        function truncateTable() {
            $sql = 'TRUNCATE TABLE Images';
            require "./config.php";
            $pdo;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            header("Location: http://localhost/projekt/Index.php");
            exit();
        }
        function test(){

        }
    ?>
</body>
</html>