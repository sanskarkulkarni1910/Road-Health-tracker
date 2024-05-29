<?php
session_start();
require_once("nav.php");
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != true)) {
  header("location: /RHT2/");
  exit;
}
include("partials/_dbconnect.php");
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
// SMTP configuration
$smtp = array(
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

$username = $_SESSION['username'];
      if(isset($_POST['helpform']))
      {
        //After Submitting the help form
        $name=$_POST['Name'];
        $Email=$_POST['Email'];
        $msg=$_POST['Msg'];
        $subject=$_POST['Subject'];
        $mail->setFrom('roadhealthtracker@gmail.com', 'Road Health Tracker');
        $mail->addAddress('roadhealthtracker@gmail.com');
        // $mail->addReplyTo('roadhealthtracker@gmail.com', 'Road Health Tracker');
        $mail->isHTML(true);
        $mail->Subject = "New Form Submission from Help Desk";
        $mail->Body = "<b>Form submitted from help-desk</b><br><br>
        <br><b>Submitted by: </b>".$name."<br><br>
        <b>Email-Id: </b>".$Email."<br><br>
        <b>Subject: </b>".$subject."<br><br>
        <b>Messsage: </b>".$msg.
                      "<br><br>";
        if ($mail->send()) {
            // header("location: /RHT2 /?set=1");
            echo"<script>alert('Message Sent Succcessfully.');</script>";
        } else {
            echo"<script>alert('Unable to send Message');</script>";
        }
      }
?>
<html>
<head>

<!-- disabled right click -->
<script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    </script>

  <!-- Bootstrap Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Template Main JS File -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- title -->
  <title>Road Health Tracker</title>
    <link href="assets/img/RHT_logo-removebg-preview.png" rel="icon">
    <link href="assets/img/RHT_logo-removebg-preview.png" rel="apple-touch-icon">

  <!-- title -->
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>

@media screen and (max-width:800px) {

#ql{
  margin-top:50px;
  margin-left:-180px;
}

#frms{
  margin-left:-140px;
  margin-top:10px;
  font-size:15px;
}

#compl{
  margin-left:-130px;
  margin-top:-10px;
}

#compl2{
  margin-left:-125px;
  margin-top:3px;
}

#there2{
  margin-left:-85px;
  margin-right:80px;
}

#first{
  margin-left:-100px;
}
#second{
  margin-left:-100px;
}

#imgg{
  width:380px;
}
#help-desk-form{
  margin-left:-7px;
  width:105%;
}

}

#textinfo{
  margin-left:90px;
}
.there{
  font-size:16px;
}
.img {
  height: 250px;
  width: 400px;
  margin-top: 100px;
  border-radius:5px;
}
.sec{
  margin-left:55px;
}
.details{
  margin-left:165px;
  width:70%;
}
.btn-helpdesk{
  width:100px;
  height:50px;
}
.font-submit{
  font-size:15px;
}
.font{
  font-size:15px;
}
.btn-info:hover{
color:black;
}
</style>
</head>
<body>
  <i class="bi bi-list mobile-nav-toggle d-lg-none"></i>
  <!-- ======= Header ======= -->
  <!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="rhtletter"><span class="typed" data-typed-items="ROAD HEALTH TRACKER"></span></h1>
      <div class="social-links">
        <!-- header -->
        <h2><b class="other">Complaint us to improve road health...</b></h2>
        <!-- header -->
      </div>
    </div>
  </section>
  <!-- End Hero -->
  <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about-us">
      <div class="container">
        <div class="section-title">
          <!-- header -->
          <h2 class="heading">About</h2>
          <!-- header -->
        </div>
        <div class="row no-gutters">
          <div class="image col-xl-4 d-flex align-items-stretch justify-content-center justify-content-lg-start"
            data-aos="fade-right">
            <div class="col-lg-6">
              <!-- image -->
              <img src="./assets/img/ezgif.com-video-to-gif (3).gif" class="img" id="imgg" alt="">
              <!-- image -->
            </div>
          </div>
          <div class="col-xl-7 ps-0 ps-lg-6 pe-lg-1 d-flex align-items-stretch" id="textinfo">
            <div class="content d-flex flex-column justify-content-center text765">
              <div class="bold" id="there2">
                <h1 data-aos="fade-up"><b class="there1">There are various accidents happen because of bad road, highway
                    and heavy turn.</b></h1>
              </div>
              <br>
              <!-- rows -->
              <div class="row row1">
                <div class="col-md-5 icon-box" data-aos="fade-up" id="first">
                  <br>
                  <h2><b class="iod">In One Day</b></h2>
                  <p><span class="there justify-content-right" id="infoofacci">430 two-wheeler accidents have taken place in which 122 two-wheeler riders have lost their life
                    whereas 202 riders have become disabled.</span></p>
                </div>
                <div class="col-md-6 icon-box sec" data-aos="fade-up" data-aos-delay="100" id="second">
                  <br>
                  <h2><b>In One Week</b></h2>
                  <p><span class="there">In kolhapur District 1,030 accident are happen, where 370 people lost their life and 652 people
                    got enjured in the last year 2023.</span></p>
                </div><br>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200" id="first">
                  <h2><b>In One Month</b></h2>
                  <p><span class="there">In Kolhapur District has reported 5,640 accidents, happen where 1,459 people got enjured and 312
                    people lost their life.</span></p>
                </div>
                <d iv class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300" id="first">
                  <h2><b>In One Year</b></h2>
                  <p><span class="there">The report stated that there are 65,890 accidents have taken place in the Kolhapur District in the
                    calendar year 2023.</span></p>
                </d>
              </div>
              <!-- rows -->
            </div>
            <!-- End .content-->
          </div>
        </div>
      </div>
    </section>
    <!-- End About Us Section -->
    <!-- services start -->
    <?php
    if ($_SESSION['logtype'] == "User") {
      // When you are the user then it will show the services part
      echo '
                      <section id="services" class="features">
                        <div class="container">
                          <div class="section-title">
    
                            <!-- header -->
    
                            <h2 class="heading">Services</h2>
    
                            <!-- header -->
                          </div>
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="card-box card1">
                                  <a href="/RHT2/frm_complaint.php"><img src="./assets/img/complaints.webp" style="width: 300px; height: 245px; margin-top: 0px; margin-left:17px;" class="imgcomp" alt="" title="Click here to fill Complaint"></a>
                                </div>
                                <br>
                              </div>
                              <div class="col-lg-6">
                                <div class="card-box card2">
                                  <br>
                                  <a href="/RHT2/frm_feedback.php"><img src="./assets/img/feedback.avif" class="imgfeed"  style="width: 300px; height: 245px; margin-top:-15px; margin-left:17px;" alt="" title="Click here to fill Feedback"></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>';
    
  
    // <!-- services end -->
    // <!-- ======= Contact Section ======= -->
    // Contact section is also for only user
echo'
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <!-- header -->
          <h2 class="heading">Help Desk</h2>
          <!-- header -->
        </div>
        <div class="col-lg-6 mt-5 details" id="help-desk-form">
        <div class="card border border-dark">
            <div class="card-title">
                <div class="card-body">
                    <form action="" method="post" class="text-center">
                        <input type="text" name="Name" placeholder="Name" class="form-control mb-3 font" required>
                        <input type="email" name="Email" placeholder="Email" value='.$username.' class="form-control mb-3 font-submit" readOnly required>
                        <input type="text" name="Subject" placeholder="Subject" class="form-control mb-3 font-submit" required>
                        <textarea name="Msg" class="form-control font-submit" rows="4" placeholder="Leave a Message here..." required></textarea>
                        <button class="btn btn-info mt-3 btn-helpdesk" name="helpform"><span class="font-submit">Submit</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <div>
      </div>
    </section>
    ';
    
    }?>
    <!-- End Contact Section -->
  </main>
  <!-- End #main -->


  <!-- ======= Footer ======= -->

  <!-- user footer start -->
  <?php
    if ($_SESSION['logtype'] == "User") { 
// Footer is also dynamic it is also different for user and also for municipal
      echo '
  <footer id="footer">
    <section id="about" class="about-us">
      <div class="container">
        <div class="row no-gutters">

          <div class="col-xl-6 ps-lg-6 pe-lg-1 d-flex align-items-stretch">
            <div class="information d-flex flex-column m-auto">
              <div class="bold "><br>
                <h1 data-aos="fade-up" class="lastheader"><b class="rhtlast">Road Health Tracker</b></h1><br>
                <div class="roadhrt">
                  <h4 classs="rhtr">Road Health Tracker, a ground-breaking platform that empowers <br>communities to actively improve their roads.</h4><br>
                    <span class="roadht m-auto" id="rhtracker">.. Designed By<a href="/RHT2/main.php"> Road Health Tracker</a> ..</span>
                </div>
              </div>
            </div>
          </div>
         <!-- End .content-->

          <div class="col-xl-6 ps-0 ps-lg-6 pe-lg-1 d-flex align-items-stretch">         
            <div class="vertical1 my-auto"></div>
            <div class=" information d-flex flex-column justify-content-center m-auto">
              <h1 data-aos="fade-up" class="lastheader" id="ql"><b class="rhtlast1" >Quick Links</b></h1>
              <h4 classs="rht" id="frms"><a href="#services" class="complaint"><b>Forms</b></a></h4><br>
              <div class="bold">
                <h4 classs="rht" id="compl"><a href="frm_complaint.php" class="complaint">Complaint &nbsp; <i class="fa-solid fa-arrow-up-right-from-square"></i></a></h4>
                <h4 classs="rht" id="compl2"><a href="frm_feedback.php" class="feedback"> Feedback &nbsp; <i class="fa-solid fa-arrow-up-right-from-square"></i></a></h4>
              </div>
            </div>
            <!-- End .content-->
          </div>

        </div>
      </div>
    </section>
  </footer>
  ';
    }
    ?>

    <!-- user footer end -->

<!-- municiple footer start -->
    <?php
    if ($_SESSION['logtype'] == "Municipal") {
      echo '
      <footer id="footer">
      <section id="about" class="about-us">
        <div class="container">
          <div class="row no-gutters">
            <div class="col-xl-12 ps-0 ps-lg-12 pe-lg-1 d-flex align-items-stretch m-auto">
              <div class="information d-flex flex-column m-auto">
                <div class="bold "><br>
                  <h1 data-aos="fade-up" class="lastheader"><b class="rhtlast">Road Health Tracker</b></h1><br>
                  <div class="roadhrt">
                    <h4 classs="rhtr">Road Health Tracker, a ground-breaking platform that empowers communities to actively improve their roads.</h4><br>
                      <span class="roadht fs-4 mx-4">.. Designed By<a href="main.php"> Road Health Tracker</a> ..</span>
                  </div>
                </div>
              </div>
            </div>
           <!-- End .content-->            
            </div>
          </div>
        </div>
        <br>
        
      </section>
    </footer>';
    }
    ?>

  <!--  municiple End Footer -->


  <div id="preloader" class="preloader"></div>
  <!-- arrow -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <!-- arrow -->

  

  <!-- pop up model end -->
  <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                <?php $success=null; $error=null;?>
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Vendor JS Files -->
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>