<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: content-type, Authorization");
$servername = "localhost";
$username   = "root";
$password   = '';
$dbname     = "vuejs";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$data = json_decode(file_get_contents('php://input'), true);

if(!empty($_GET)){
    $postData = json_decode($_GET['getuser'],true);
    $email = $postData['id'];
    $sqll = "SELECT * FROM users where id='$email'";
    $resultl = $conn->query($sqll);
    $data = array();
    if ($resultl->num_rows > 0) {
        $row = $resultl->fetch_assoc();
        echo json_encode($row);
    } else {
        $status = "1";
        echo json_encode($status,true);
    }
}
?>