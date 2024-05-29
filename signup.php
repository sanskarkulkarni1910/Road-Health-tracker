<?php
$showAlert = false;
$showError = false;
use PHPMailer\PHPMailer\PHPMailer;
// adding the PHP Mailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
$smtp = array(
  //accessing the data from 
  'host' => 'smtp.gmail.com',
  'port' => 587,
  'username' => 'roadhealthtracker@gmail.com',
  'password' => 'bssh gzmv wszb ecik',
  'SMTPSecure' => PHPMailer::ENCRYPTION_STARTTLS
);
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = $smtp['host'];
$mail->Port = $smtp['port'];
$mail->SMTPSecure = $smtp['SMTPSecure'];
$mail->SMTPAuth = true;
$mail->Username = $smtp['username'];
$mail->Password = $smtp['password'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // After submitting the form
  require "partials/_dbconnect.php";
  $fname = $_POST["fname"];
  $gender = $_POST["gender"];
  $password = $_POST["password"];
  $mob = $_POST["mobno"];
  $email = $_POST["eid"];
  $password2 = $_POST["cpassword"];
  $address = $_POST["adrs"];
  // $image = 'image_data/user_default.jpg';
  // $exists = false;
  // Checks the existence of user: 
  $existsSql = "SELECT * FROM `userdb` WHERE eid='$email';";
  $result = mysqli_query($conn, $existsSql);
  $numExistRows = mysqli_num_rows($result);
  if ($numExistRows > 0) {
    //if user found
    $showError = "User Already Exists.";
  } else {
    //If user not found
    $exists = false;
    if (($password == $password2)) {
      if (strlen($password) <= '8') {
        $passwordErr[] = "Your Password Must Contain At Least 8 Characters!";
      } elseif (!preg_match("#[0-9]+#", $password)) {
        $passwordErr[] = "Your Password Must Contain At Least 1 Number!";
      } elseif (!preg_match("#[A-Z]+#", $password)) {
        $passwordErr[] = "Your Password Must Contain At Least 1 Capital Letter!";
      } elseif (!preg_match("#[a-z]+#", $password)) {
        $passwordErr[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
      } else {
        //inserting data in userdb if the password validates
        $sql = "INSERT INTO `userdb` (`user_image`, `gender`, `name`, `password`, `mobno`, `eid`, `address`, `datetime`) VALUES ('', '$gender', '$fname', '$password', '$mob', '$email', '$address', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          // sending the mail to the user of their username and  passeword
          $mail->setFrom('roadhealthtracker@gmail.com', 'Road Health Tracker');
          $mail->addAddress($email);
          $mail->addReplyTo('roadhealthtracker@gmail.com', 'Road Health Tracker');
          $mail->isHTML(true);
          $mail->Subject = "Hi, Welcome to Road Health Tracker.";
          $mail->Body = "<b>Your Account has been created successfully.</b>
                        <br><br>
                        Hi,$fname.<br>
                        Welcome to the <b>Road Health Tracker.</b>! 
                        <br>We're thrilled to have you as part of our community. 🎉
                        <br>
                        <br>Thank you for choosing us as your platform of choice. Your new account is now set up and ready for you to explore the exciting features we have to offer. 
                        <br><br>Your Username and Password to access our website is as follows: 
                        <br><b>Username: </b>$email<br>
                        <b>Password: </b>$password
                        <br><br><br><br>Thanks & regards,<br>RHT.";
          if ($mail->send()) {
            echo "";
            $success = "A new password has been sent to your email address.";
          } else {
            $error = "Unable to send the new password. Please try again later.";
          }
          $showAlert = true;
          echo "<script>alert('Your Account Created Successfully. Username and password of your account is sent to your mail id successfully');</script>";
          header("location: /RHT2/?registered=1");


        } else {
          die("Error" . mysqli_error($conn));
        }
        // } 
      }
    } else {
      $showError = "Password does not match.";
    }
  }
}
?><br><br><br>
<!DOCTYPE html>
<br><br><br><html>

<head>
  <link href="assets/img/RHT_logo-removebg-preview.png" rel="icon">
  <link href="assets/img/RHT_logo-removebg-preview.png" rel="apple-touch-icon">

  <!-- bottstrap css -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

 <!-- disabled right click -->
 <script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    </script>

  <!-- Template Main JS File -->

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- title -->
  <title>Road Health Tracker</title>
  <!-- title -->

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->

  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
   @media screen and (max-width:800px) {
    #logo{
      margin-left:-40%;
    }

    #fr{
      margin-left:-100%;
    }
   }

    #fr{
      margin-top:-3%;
      margin-left:-10%;
      margin-bottom:-100%;
    }
    </style>
</head>
<br><br><br><br><br>
<body class="bgofsign">
  <div class="starting">
    <div class="container2">
      <div class="indextitle">
        <div class="flexlogin">

          <div class="f1">
            <a href="">
              <img src="assets/img/RHT_logo-removebg-preview.png" id="logo" height="100" width="100" alt="">
            </a>
          </div>
          <div class="f2">
            <a href="">
              <h2 id="fr">Road Health Tracker</h2>
            </a>
            </span>
          </div>
        </div>
        <hr>
        <!-- Dissmissable Error -->
        <?php
        if ($showAlert) {
          
          echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> &nbsp;Your data added succesfully.</div>';
        }
        if ($showError) {
          echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed !</strong> &nbsp;' . $showError . '</div>';
        }
        if(isset($passwordErr)){
          echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed ! </strong> &nbsp;' . $passwordErr[0] . '</div>';
        }
        ?>
        <!-- Dismissable Errror -->
        <h3>Create an account</h3><br>
      </div>
      <!-- sign up page  -->
      <form class="form" action="/RHT2/signup.php" method="post">
        <div class="input-group1">
          <!-- Name -->
          <label for="name" class="lable-title1">Enter Your Full Name: *</label>
          <input type="text" name="fname" id="fname" placeholder="Full Name" required style="color:black;" />
          <br>

          <label for="eid" class="lable-title1"> Enter Email: *</label>
          <!-- email -->
              <input type="email" name="eid" id="eid" placeholder="Email" required style="color:black;" />
              <br>
              <!-- Mobile No. -->
              <label for="username" class="lable-title1"id="mobno"> Enter Mob No: *</label>
              <input type="text" maxlength="10" max="10" name="mobno" id="mobno" placeholder="+91" required
                style="color:black;" />
                <br>
                <!-- Password -->
                <label for="password" class="lable-title1"> Password: *</label>
              <input type="text" name="password" maxlength="18" minlength="8" id="password" placeholder="Password"
                required style="color:black;" />
                <br>
                <!-- Confirm Password -->
                <label for="password" class="lable-title1">Confirm Password: *</label>
              <input type="password" name="cpassword" maxlength="18" minlength="8" id="cpassword"
                placeholder="Confirm Password" required onfocus="displayMessage()" style="color:black;" />
                &nbsp;&nbsp;<input type="checkbox" onclick="myFunction()" style="width: 18px; height:18px;"> &nbsp;Show
              Password
              <p type="hidden" id="hidpara" style="color:red;text-size: 9px;"></p>
          <script>
            function myFunction() {
              // for show password
              var x = document.getElementById("cpassword");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
          </script>
        </div>
        <!-- Gender -->
        <label for="logtype" class="lable-title1"> Gender:</label>
        <div class="input-group2">
          <input type="radio" name="gender" id="gender" value="Male" required> Male
          &nbsp;&nbsp; <input type="radio" id="gender" name="gender" value="Female"> Female
        </div>
        <div class="input-group1">
          <!-- Address -->
          <label for="address" class="lable-title1">Enter Your Address: </label>
          <textarea id="" cols="30" rows="3" name="adrs" id="adrs" minlength="30" maxlength="200" placeholder="Address"
            style="color:black;"></textarea>
          <div class="insideflexsu">
            <div class="suflex1">
              <button class="submit-btnnm" type="reset">Reset</button>
            </div>
            <div class="suflex2">
              <!-- After Filling information you have to submit the form -->
              <button class="submit-btnnm">Sign Up</button>
            </div>
          </div>
          <br>
          <hr>
          <div class="" style="text-align: center;">
          <!-- SignIn button -->
            <span class=" ">Already have an account?<a href="/RHT2/">&nbsp;Sign-In</a></span>
          </div>
      </form>
    </div>
  </div>
</body>
</html>
