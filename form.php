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
    $password = md5($postData['password']);
    $address = $postData['address'];
    $city = $postData['city'];
    $state = $postData['state'];
    $date = date('Y-m-d H:i:s');
    $sqll = "SELECT * FROM users where email='$email'";
    $resultl = $conn->query($sqll);

    if ($resultl->num_rows > 0) {
    // output data of each row
        $status = "1";
        echo json_encode($status,true);
    } else {
        $sql = "INSERT INTO users (name, email, password,address,city,state,created_at)
            VALUES ('$name', '$email', '$password', '$address', '$city', '$state','$date')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $sql = "SELECT * FROM users where id='$last_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
                $row = $result->fetch_assoc();
            echo json_encode($row,true);
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


?>