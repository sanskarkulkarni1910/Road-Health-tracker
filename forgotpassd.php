<?php
//forgot password 
include("partials/_dbconnect.php");
// PHP Mailer files
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
// SMTP configuration
$smtp = array(
    //accesing the gmail to send the mail
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'username' => 'roadhealthtracker@gmail.com',
    'password' => 'bssh gzmv wszb ecik',
    'SMTPSecure' => PHPMailer::ENCRYPTION_STARTTLS
);
// Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = $smtp['host'];
$mail->Port = $smtp['port'];
$mail->SMTPSecure = $smtp['SMTPSecure'];
$mail->SMTPAuth = true;
$mail->Username = $smtp['username'];
$mail->Password = $smtp['password'];
if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $email = $_POST['email'];
    $usersql = "SELECT * FROM `userdb` WHERE eid='$email'";
    $municiplesql = "SELECT * FROM `municipledb` WHERE eid='$email'";
    $userresult = mysqli_query($conn, $usersql);
    $municpleresult = mysqli_query($conn, $municiplesql);
    // $num = mysqli_num_rows($result);
    // $numExistRows = mysqli_num_rows($result);                                                                                                                                              -
    if ((mysqli_num_rows($userresult))||(mysqli_num_rows($municpleresult))) {
        // $showError = "Username Already Exists.";
        //creating a new 8 digit dafault password 
        $new_password = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        // query to set new password
        $sql = "UPDATE userdb SET password = '$new_password' WHERE eid = '$email'";
        mysqli_query($conn, $sql);
        $sql = "UPDATE municipledb SET password = '$new_password' WHERE eid = '$email'";
        mysqli_query($conn, $sql);
        // sending mail to user or municipal 
        $mail->setFrom('roadhealthtracker@gmail.com', 'Road Health Tracker');
        $mail->addAddress($email);
        $mail->addReplyTo('roadhealthtracker@gmail.com', 'Road Health Tracker');
        $mail->isHTML(true);
        $mail->Subject = "Your Password Updated Successfully!";
        $mail->Body = "<b>Password has been updated Successfully</b>
                           <br>Your updated password of your account .$email. is: <h1>" . $new_password
            . "</h1><br><br><br><br>Thanks & regards,<br>RHT.";
        if ($mail->send()) {
            header("location: /RHT2 /?set=1");
            $success = "A new password has been sent to your email address.";
            
        } else {
            echo"<script>alert('Unable to send the new password. Please try again later.');</script>";
            $error = "Unable to send the new password. Please try again later.";
        }
    }
    else {
        echo"<script>alert('Invalid Email Address. Check and try again Later !!');</script>";
       }
}
?>
<head>
     <!-- disabled right click -->
     <script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Road Health Tracker</title>
    <!-- bottstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

     <!-- fontawesome cdn -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    @media screen and (max-width:800px) {
            #fp{
                margin-left:-350px;
            }

            #email{
                width:310px;
                border-color:black;
                margin-top:10px;
            }

            #fp1{
                box-shadow: 0 10px 30px rgb(105, 102, 102);
                padding:20px;
                border-radius:10px;   
                margin-left:-50px;
            }
            .h3{
              margin-left:10px;
              margin-top:-40px;
              margin-bottom:10px;
            }
            .btn{
                margin-left:5px;
            }
            #pf{
                margin-top:20px;
                margin-bottom:50px;
            }
            #text{
                margin-bottom:20px;
            } 

        }

            .form-control{
                width:358px;
                border-color:black;
                margin-top:10px;
            }
            #fp1{
                box-shadow: 0 10px 30px rgb(105, 102, 102);
                padding:20px; 
                border-radius:10px; 
                margin-left:-50px;
            }
            .h3{
              margin-left:10px;
              margin-top:-40px;
              margin-bottom:10px;
            }
            .btn{
                margin-left:5px;
            }
            #pf{
                margin-top:20px;
                margin-bottom:50px;
                margin-left:-40px;
            }
            #text{
                margin-bottom:20px;
    
}    
        </style>
</head>
<body>
<header id="header" class="d-flex flex-column justify-content-center arrow">
        <nav id="navbar" class="nav-menu">
            <ul>
                <li><a href="/RHT2/main.php" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
                            style="color: #bab4b4;"></i><span>Go Back</span></a>
                </li>
            </ul>
        </nav>
        <!-- .nav-menu -->
    </header>
    <!-- End Header -->
    <!-- go back button start -->
    <div class="gb">
        <nav id="navbar" class="navbar nav-menu">
            <ul>
                <li>
                    <a href="/RHT2/main.php" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
                            style="color: #ff0000;"></i></a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- HTML form to enter the user's email address -->
    <h1 class="text-center" id="pf">Reset Password</h1><br>
    <div class="container ">
        <div class="row ">
            <div class="col-md-8" id="fp">
                <card class="border-0" ><form action="" method="post" style="margin-left:400px;">
                    <div class="form-group" id="fp1"><br><br>
                        <label for="email" class="h3">Email:</label><br>
                        <h5 id="text">Enter your Email here and new password will send into your registered Email-Id.</h5>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your Email"><br>
                        <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
                    </div>
                </form></card>
            </div>
        </div>
    </div>

<!-- Backup Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
</body>