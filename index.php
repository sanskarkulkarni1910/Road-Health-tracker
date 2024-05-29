<?php
$login = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require "partials/_dbconnect.php";
    //initializing the post data in variables. 
    $username = $_POST["username"];
    $password = $_POST["password"];
    $logtype = $_POST["logtype"];

    // describing he is user or municipal -->

    if ($logtype == "User") {
        //for user
        $sql = "SELECT * FROM userdb WHERE eid = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        //checking the user is present or not.
        if (mysqli_num_rows($result) > 0) {
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['logtype'] = $logtype;
            header("location: main.php");
        } 
        else {
            $error[] = "Invalid Credentials";
        }
    }
    if ($logtype == "Municipal") {
        //for municipal
        $sql = "SELECT * FROM municipledb WHERE eid = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            //checking the user is present or not.
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['logtype'] = $logtype;
            header("location: /RHT2/main.php");
        } else {
            $error[] = "Invalid Credentials";
        }
    }  
}

    //used for get variables 
    if (isset($_GET['registered'])) {
        echo"<script>
            alert('Your Account is created Successfully! Username and Password is sent to your registerd Mail-id.');
            </script>";
    }
    if (isset($_GET['set'])) {
        echo"<script>
            alert('A new password has been sent to your email address.');
            </script>";
    }
?><br>
<!DOCTYPE html>
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
    <script src="assets/js/main.js"></script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- title -->
    <title>Road Health Tracker</title>
    <link href="assets/img/RHT_logo-removebg-preview.png" rel="icon">
    <link href="assets/img/RHT_logo-removebg-preview.png" rel="apple-touch-icon">
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
            .fp{
                margin-left:100px;
            }

            #fr{
                margin-top:-1%;
                margin-bottom:-100%;
            }
            #siup{
                margin-left:50px;
            }
            #forpas{
                margin-left:40px;
            }
        }
            #fr{
                margin-top:1%;
                margin-bottom:-100%;
            }

            .siup{
                margin-left:100px;
            }
        </style>
</head>
<body class="bgofsign">
    <div class="starting">
        <div class="container1">
            <div class="indextitle">
                <div class="flexlogin">
                    <div class="f1">
                        <a href="">
                            <img src="assets/img/RHT_logo-removebg-preview.png" height="100" width="100" alt=""
                                style="margin: 0 0;" >
                        </a>
                    </div>
                    <div class="f2">
                        <a href="" id="fr">
                            <h3 id="fr">Road Health Tracker</h3>
                        </a>
                        </span>
                    </div>
                </div>
                <hr>
                <!-- Dissmissable Error -->
                <?php
                if ($login) {
                    echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success! </strong> You are logged in</div>';
                }
                if (isset($error)) {
                    echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed! </strong>' . $error[0] . '</div>';
                }
                if (isset($showError)) {
                    echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed!</strong>' . $showError[0] . '</div>';
                }
                ?>
                <!-- Dismissable Errror -->
                <h3>Sign-In to your account</h3><br>
            </div>
            <form class="form" action="/RHT2/" method="POST">
                <div class="input-group1">
                    <!-- form of login -->
                    <label for="username" class="lable-title1"> Email: </label>
                    <input type="email" name="username" id="username" placeholder="E-mail" required style="color:black;"/>
                    <label for="password" class="lable-title1"> Password: </label>
                    <input type="password" name="password" id="password" placeholder="Password" required style="color:black;"/>
                    <input type="checkbox" onclick="myFunction()" style="width: 18px; height:18px;"> &nbsp;Show Password 
                    <!-- forgot password start --><span class="fp" id="forpas"><a href="/RHT2/forgotpassd.php"><span style="color:red;">Forgot Password?</span></a></span><!-- forgot password end -->

                    <script>
                        function myFunction() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                         x.type = "text";
                        } else {
                         x.type = "password";
                         }
                        }
                    </script>
                     <div class="input-group3">
                </div>
                </div><br>
                <label for="logtype" class="lable-title1"> Are you:</label>
                <div class="input-group2">
                    <input type="radio" name="logtype" id="logtype" value="User" required> User
                    &nbsp;&nbsp; <input type="radio" id="logtype" name="logtype" value="Municipal"> Municipal
                </div>
               
                <br>
                <div class="input-group1">
                    <button class="submit-btnnm">Login</button>
                </div>
           <hr>
                <span id="siup" class="siup"> Don't have any account? <a href="/RHT2/signup.php">Sign Up.</a></span>
            </form>

        </div>
    </div>
</body>
</html><br><br><br>