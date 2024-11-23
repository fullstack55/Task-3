//db.php
<?php
$servername = "localhost";
$username = "root";
$password = "Sharoon"; 
$dbname = "task_3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
