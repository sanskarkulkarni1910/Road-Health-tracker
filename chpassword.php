<?php
// when user doesnot logged in then it will run 
session_start();
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != true)) {
    header("location: /RHT2/");
    exit;
}
else{
    //when the user or municipal is logged in then it will run this

    include("partials/_dbconnect.php");
    $username=$_SESSION['username'];
    $password;
    $sql = "SELECT * FROM municipledb WHERE eid = '$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        
    
    if(isset($_POST["changepassword"]))
    {       
        //when you submit data using submit button then it will execute this code
            $confirmPassword=$_POST["confirmpassword"];
            $newPassword=$_POST["newpassword"];
            $oldPassword=$_POST["oldpassword"];
            $orgPassword;   
            if ($num == 1) {
                //it returns the old & original password 
                $row = mysqli_fetch_assoc($result);
                $orgPassword = $row['password'];
            }
            if($oldPassword==$orgPassword)
            {
                if($newPassword==$confirmPassword)
                {   //checks the password validation
                    if (strlen($newPassword) <= '8') {
                        $passworderror[]="Your Password Must Contain At Least 8 Characters!";
                                                    //     echo"<script>
                                                    // alert('Your Password Must Contain At Least 8 Characters!');
                                                    // </script>";
                      } elseif (!preg_match("#[0-9]+#", $newPassword)) {
                        $passworderror[]="Your Password Must Contain At Least 1 Number!";
                                                //     echo"<script>
                                                // alert('Your Password Must Contain At Least 1 Number!');
                                                // </script>";
                      } elseif (!preg_match("#[A-Z]+#", $newPassword)) {
                        $passworderror[]="Your Password Must Contain At Least 1 Uppercase letter!";
                                            // echo"<script>
                                            // alert('Your Password Must Contain At Least 1 Number!');
                                            // </script>";
                      } elseif (!preg_match("#[a-z]+#", $newPassword)) {
                        $passworderror[]="Your Password Must Contain At Least 1 Lowercase Letter!";
                                                // echo"<script>
                                                // alert('Your Password Must Contain At Least 1 Lowercase Letter!');
                                                // </script>";
                      } else {
                    $result = mysqli_query($conn, "UPDATE municipledb SET password ='$newPassword' WHERE eid='$username'");
                    if ($result) {
                                                echo"<script>
                                            alert('Password Updated Successfully!');
                                            </script>";
                                            echo"<script>window.location.href='/RHT2/profile.php'</script>";
                    } else {
                        $passworderror[]="Failed to update password!";
                                            //     echo"<script>
                                            // alert('Failed to update password!');
                                            // </script>";
                    }
                }      
                }
                else{
                    //when new password and confirm password doesnt match
                    $passworderror[]="New Password and Confirm Password Does Not Match!";
                }
            }
            else{
                $passworderror[]="Old Password Does Not Match!";
            }      
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
                width:350px;
                border-color:black;
                margin-top:10px;
            }
            #fp1{
                box-shadow: 0 10px 30px rgb(105, 102, 102);
                padding:20px;
                border-radius:10px;   
                margin-left:-50px;
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
            #email{
                width:350px;
                border-color:black;
                margin-top:10px;
            }
            #fp1{
                box-shadow: 0 10px 30px rgb(105, 102, 102);
                padding:20px; 
                border-radius:10px; 
                margin-left:-50px;
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
            .h5{
                margin-top:-20px;
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
    <h1 class="text-center" id="pf">Change Password</h1><br>
    <div class="container ">
        <div class="row ">
            <div class="col-md-8" id="fp">
                <card class="border-0" >
                    
                    <form action="" method="POST" style="margin-left:420px;">
                    
                        <div class="form-group" id="fp1"><br>
                        <?php 
                        if(isset($passworderror)){
                            //show the password error
                            echo '<div class="alert alert-danger alert-dismissible fade in">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  <strong>Failed ! </strong> &nbsp;' . $passworderror[0] . '</div>';
                          }
                    ?><br>
                    <!-- form elements start from here -->
                        <label for="password" class="h5">Old Password:</label><br>
                        <input type="password" class="form-control" id="password" name="oldpassword"  placeholder="Enter your Password" required><br><br>
                        <label for="password" class="h5">New Password :</label><br>
                        <input type="text" class="form-control" id="password" name="newpassword"  placeholder="Enter your Password" required><br><br>
                        <label for="password" class="h5">Confirm Password:</label><br>
                        <input type="password" class="form-control" id="password3" name="confirmpassword"  placeholder="Enter your Password" required>
                        &nbsp;<input type="checkbox" id="cb1" class="text10" onclick="myFunction()" style="width: 18px; height:18px; margin-top:10px;">Show Password
                        <script>
                            function myFunction() {
                                //used for show passsword
                            var x = document.getElementById("password3")
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                            }
                        </script><br><br>
                            <button type="submit" name="changepassword"  class="btn btn-primary">Submit</button>
                        </div>
                </form></card>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
    
</body>