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
    $sqll = "SELECT * FROM product";
    $resultl = $conn->query($sqll);
    $data = array();
    if ($resultl->num_rows > 0) {
        while($row = $resultl->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data,true);
    } else {
        $status = "1";
        echo json_encode($status,true);
    }
}
?>