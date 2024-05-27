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
    $name = $postData['name'];
    $email = $postData['email'];
    $address = $postData['address'];
    $city = $postData['city'];
    $state = $postData['state'];
    $id = $postData['id'];
    $date = date('Y-m-d H:i:s');
    $sqll = "SELECT * FROM users where id <>'$id' and email = '$email'";
    $resultl = $conn->query($sqll);
    if ($result->num_rows > 0) {
        $status = "1";
        echo json_encode($status);
    } else {
   
        $sql = "UPDATE users SET name ='$name', email='$email', address='$address', city='$city', state= '$state' where id='$id'";

        if ($conn->query($sql) === TRUE) {
            $sql = "SELECT * FROM users where id='$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
                $row = $result->fetch_assoc();
                echo json_encode($row,true);
            }
        } else {
            $status = "1";
            echo json_encode($status);
        }
    }
    
}


?>