<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: content-type, Authorization");
$success = "";
$data = json_decode(file_get_contents('php://input'), true);
echo "<pre>"; print_r($data); echo "</pre>"; die;
if(!empty($data)){
    $postData = json_decode($data['body'],true);
    $name = $postData['name'];
    $email = $postData['email'];
    $message = $postData['messagee'];
    $subject = $postData['subject'];
 // echo "<pre>"; print_r($_POST); echo "</pre>"; die;
  $to = $email;
  
  
  $message ='<div style="margin:0 10% 0 10%;border: 1px solid #cdcdcd;">
      <div class="col-sm-6 col-sm-offset-3">
          <div class="panel panel-primary">
              <div class="panel-body">
                  <div style="padding: 30px;">
                      <p>Name: '.$name.'</p>
                      <p>Email: '.$email.'</p>
                      <p>Message: '.$message.'</p>
                     
                      <p>Regards</p>
                      <p>Vue Ja</p>
                      <div style="margin-top:10%;">
                          <hr>
                          <small class="text-center" style="display:block;">&copy; '.date("Y").' Vue Js Inc. All Rights Reserved. <br></small>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>';
  

  $headers = "From: bhartikumaritesting@gmail.com" . "\r\n";
  $headers .= "Content-type: text/html\r\n";

  if(mail($to, $subject, $message, $headers)){
        echo json_encode("Email sent successfully!");
    } else {
        echo json_encode("An error occurred while sending the email.");
    }
 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>LOGO</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="images/f-icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="./css/custom-style.css" type="text/css" />
    <link rel="stylesheet" href="sass/main.css" type="text/css" />
    <link rel="stylesheet" href="sass/otherstyle.css" type="text/css" />
</head>

<body>
    <div class="d-block">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="mx-auto d-table my-5">
                        <a href="" class="w-230 fulw d-inline-block">
                            <img src="./images/logow.png" alt="image" />
                        </a>
                    </div>
                    <div class="mx-auto d-table mt-120 pb-20">
                        <div class="d-flex flex-column gap-5 justify-content-center">
                            <h2 class="text-white text-center fs-22 fw-400">Contact Us</h2>
                            <?php if(!empty($success)){?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $success;?>
                            </div>
                            <?php } ?>
                            <p class="text-white text-center fs-14 fw-300">
                                For business inquires with our clients, please fill out the
                                form below
                            </p>
                        </div>
                    </div>
                    <div class="d-block outline-form pb-60">
                        <form action="index.php" method="post">

                            <div class="row gy-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="name" required
                                        placeholder="name@example.com" />
                                    <label for="floatingInput">Name: *</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="phone" required
                                        placeholder="name@example.com" />
                                    <label for="floatingInput">Phone: *</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" name="email" required
                                        placeholder="name@example.com" />
                                    <label for="floatingInput">Email:*</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="client" id="floatingInput"
                                        placeholder="name@example.com" />
                                    <label for="floatingInput">Client of Interest:</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="notes" placeholder="Leave a comment here"
                                        id="floatingTextarea2" style="height: 100px"></textarea>

                                    <label for="floatingInput">Notes:</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <button type="submit">SEND</button>
                                    </div>
                                </div>
                                <div class="d-block mt-4 text-center">
                                    <p class="fs-12 fw-300 tser">
                                        This site is protected by reCAPTCHA and the Google
                                        <a href="" class="fs-12 text-white fw-300">Privacy Policy
                                        </a>
                                        and
                                        <a href="" class="fs-12 text-white fw-300">Terms of Service</a>
                                        apply.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <foote class="d-block py-40 bg-white">
        <div class="container-lg">
            <p class="text-black fs-16 fw-300 text-center">
                Copyright © 2023 Major League Agency Group - New York, NY - All Rights
                Reserved.
            </p>
        </div>
    </foote>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>