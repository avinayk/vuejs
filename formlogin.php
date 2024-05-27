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
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$data = json_decode(file_get_contents('php://input'), true);

if(!empty($data)){
    $postData = json_decode($data['body'],true);
    
    $email = $postData['email'];
    $password = md5($postData['password']);
   
    $sqll = "SELECT * FROM users where email='$email' And password='$password'";
    $resultl = $conn->query($sqll);

    if ($resultl->num_rows > 0) {
    // output data of each row
        $row = $resultl->fetch_assoc();
        echo json_encode($row,true);
    } else {
        $status = "1";
        echo json_encode($status,true);
    }
}


?>