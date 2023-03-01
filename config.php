<?php
$host = 'localhost';

$user = 'root';

$password = '';

$database = "projekt";

$dsn = 'mysql:host=' . $host . ';dbname=' . $database;

$options = [];

try {

$pdo = new PDO($dsn, $user, $password, $options);

} catch (PDOException $e) {

echo "Konnte Verbindung nicht erstellen " . $e -> getMessage();

}

$con = mysqli_connect($host, $user, $password,$database);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>