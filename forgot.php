<button><?php
// Alternative for forgot password for user purpose only.
$showAlert = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require("partials/_dbconnect.php");
  $password = $_POST['password'];
  $password2 = $_POST['cpassword'];
  $email = $_POST['email'];
  $mobno = $_POST['mobno'];

  if (($password == $password2)) {
    $sql = "SELECT * FROM userdb WHERE eid = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $Updatesql = "UPDATE userdb SET password = '$password' WHERE eid = '$email' AND mobno ='$mobno';";
      $Updateresult = mysqli_query($conn, $Updatesql);
      if ($Updateresult) {
        header("location: /RHT2/");
        $showAlert = "Password updated successfully.";
      } else {
        // $showAlert = "Something went wrong.";
        die(mysqli_connect_error());
      }

    } else {
      // $showAlert = "User does not exist";
      die(mysqli_connect_error());

    }

  } else {
    // $showAlert = "Password does not match.";
    die("Error");

  }

}
?></button>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- disabled right click -->
   <script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
    
  <link href="assets/img/RHT_logo-removebg-preview.png" rel="icon">
  <link href="assets/img/RHT_logo-removebg-preview.png" rel="apple-touch-icon">

  <!-- Template Main JS File -->

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- bottstrap css -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .wrapper {
      background-color: rgb(0, 119, 255);
      width: 100%;
      height: 100vh;
      padding: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      margin: 50px 0px;
      width: 500px;
      background-color: white;
      padding: 30px;
      border-radius: 16px;
    }

    .title-section {
      margin-bottom: 30px;
    }

    .title {
      color: rgb(0, 0, 0);
      font-weight: 500;
      text-transform: capitalize;
      margin-bottom: 10px;
    }

    .infopara {
      color: rgb(110, 110, 110);
      font-size: 16px;
      line-height: 1.5;
      margin-bottom: 20px;
      text-transform: initial;
      text-align: start;
      justify-content: end;
    }

    .input-group {
      position: relative;
    }

    .input-group .lable-title {
      color: gray;
      margin-bottom: 11px;
      font-size: 14px;
      display: block;
      font-weight: 500;
      text-transform: capitalize;
    }

    .input-group input {
      width: 100%;
      background-color: none;
      color: gray;
      height: 50px;
      font-size: 16px;
      font-weight: 100;
      border: 1px solid #000000;
      padding: 9px 18px 9px 52px;
      outline: none;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .input-group input::placeholder {
      color: rgb(56, 56, 56);
      font-size: 16px;
      font-weight: 400;
    }

    .input-group .icon {
      position: absolute;
      color: gray;
      left: 13px;
      top: calc(50% - 11px);
      text-align: center;
      font-size: 23px;
    }

    .submit-btn {
      width: 40%;
      background-color: rgb(255, 208, 0);
      border: 1px sollid transparent;
      border-radius: 8px;
      font-size: 16px;
      color: white;
      padding: 13px 24px;
      font-weight: 500;
      text-align: center;
      border-color: transparent;
      cursor: pointer;

    }

    .submit-btn:hover {
      opacity: 0.8;
    }

    .reset-btn {
      width: 40%;
      background-color: rgb(255, 208, 0);
      border: 1px sollid transparent;
      border-radius: 8px;
      font-size: 16px;
      color: white;
      padding: 13px 24px;
      font-weight: 500;
      text-align: center;
      text-transform: capitalize;
      border-color: transparent;
      cursor: pointer;
    }

    .submit-btn:hover {
      opacity: 0.8;
    }
  </style>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>


  <div class="wrapper">

    <header id="header" class="d-flex flex-column justify-content-center arrow">

      <nav id="navbar" class="nav-menu">
        <ul>
          <li><a href="/RHT2/" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
                style="color: #ff0101;"></i><span>Go Back</span></a>
          </li>
        </ul>
      </nav>
      <!-- .nav-menu -->

    </header><!-- End Header -->


    <!-- ======= Hero Section ======= -->

    <!-- ======= Contact Section ======= -->

    <!-- go back button start -->
    <div class="gb">
      <nav id="navbar" class="navbar nav-menu">
        <ul>
          <li><a href="/RHT2/" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
                style="color: #ff0000;"></i><span></span></a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- go back button end -->
    <div class="container">
      <div class="title-section">
        <h2 class="title" style="text-align:center"> Reset Password</h2>

        <p class="infopara justify-content-end">

          <b>1.</b> Enter your Email id, Registered Mobile No. and then enter new password. <br>
          <b>2.</b> If the Email Id and Mobile no. is correct then the password will change otherwise it will remains as
          it is.


        </p>
      </div>

      <form action="/RHT2/forgot.php" class="form" method="post" autocomplete="off">
        <div class="input-group">
          <label for="" class="lable-title"> Enter your mail</label>
          <input type="email" name="email" id="email" placeholder="Username" required autocomplete="off">
          <span class="icon">&#9993;</span>
        </div>
        <div class="input-group">
          <label for="" class="lable-title"> Enter your Registered Mobile no.</label>
          <input type="text" name="mobno" id="mobno" placeholder="Mobile No." min="10" maxlength="10" required
            autocomplete="off">
          <span class="icon">&#9990;</span>
        </div>
        <div class="input-group">
          <label for="" class="lable-title"> New Password</label>
          <input type="password" name="password" id="password" placeholder="Password" required>
          <span class="icon">&#9919;</span>
        </div>
        <div class="input-group">
          <label for="" class="lable-title"> Confirm Password</label>
          <input type="password" name="cpassword" id="cpassword" placeholder="Password" required>
          <span class="icon">&#9919;</span>
        </div>
        <div class="text-center">
          <input type="reset" class="btn btn-danger" style="font-size:20px">
          <input type="submit" class="btn btn-warning ms-5" style="font-size:20px">
        </div>



      </form>
    </div>
  </div>
</body>

</html>
