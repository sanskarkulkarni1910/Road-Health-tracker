<?php
$error = null;
$success = null;
include("partials/_dbconnect.php");
session_start();
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != true)) {
    header("location:/RHT2/");
    exit;
} else {
    //when you are user
    if ($_SESSION['logtype'] == "User") {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM userdb WHERE eid = '$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        //Displaying the sql query
        if ($num == 1) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['eid'];
            $address = $row['address'];
            $gender = $row['gender'];
            $password = $row['password'];
            $mobno = $row['mobno'];
            $signupdate = $row['datetime'];
            $image = $row['user_image'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- disabled right click -->
     <script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
    
    <meta charset="UTF-8">
    <title>Road health Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <!-- Bootstrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <style>
        
    /* media query start */

        @media screen and (max-width:800px) {

           

        .text1{
            width:100px;
            height:100px;
        }

        #fname{
            width:350px;
            margin-left:0px;
        }

        #address{
            width:350px;
            margin-left:0px;
        }

        #chpa{
            margin-left:17px;
        }


        .text9{
            margin-top:-180px;
        }

        #mobno{
            width:350px;
        }

        .text3{
        margin-top:2px;
        }

        .text3{
            width:350px;
        }

        #mobno{
            width:350px;
        }


        #fname1{
            width:350px;
        }
        #fname2{
            width:350px;
        }


        }

     /* media query end */


        body {
            background-color: rgb(243, 243, 243);
        }
        .title {
            text-align: center;
            margin-bottom: 30px;
            margin-top: -20px;
        }

        .pict {
            margin-left: 75px;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .btn {
            margin-left: 60px;
        }

        .btn1 {
            margin-left: -15px;
        }

        .titl {
            background-color: rgb(224, 224, 224);
            padding: 5px 0px;
        }

        .title12 {
            margin-left: 20px;
            font-size: 20px;
        }

        .card {
            border-radius: 0px;
            box-shadow: 0 0 5px rgb(51, 51, 51);
        }

        .text1{
            height: 40px;
            width: 680px;
            padding: 10px;
        }

        .text {
            color: rgb(109, 109, 109);
        }
        .modal-header {
            background-color: rgb(224, 224, 224);
        }
        .text2 {
            width: 48%;
            margin-right: 10px;
            height: 40px;
            padding: 10px;
        }
        .text3 {
            width: 48%;
            margin-right: 10px;
            height: 40px;
            padding: 10px;
        }
        .text4 {
            margin-left: 305px;
        }
        .cp {
            margin-left: 57%;
        }
        .text7 {
            height: 40px;
            width: 100%;
            padding: 10px;
        }
        .text8 {
            margin-right: 140px;
        }
        .text10 {
            width: 215px;
            margin-right: 24px;
            height: 40px;
            padding: 10px;
        }
        .text11 {
            width: 215px;
            height: 40px;
            padding: 10px;
        }
        #mobno,#letters,#fname2{
            width:83%;
            margin-left:20px;
        }
        #address{
            width:83%;
            margin-left:20px;
        }
        #letter{
            margin-left:5px;
        }
        #fname1,#fname{
            width:100%;
        }
        #submit{
            margin-left:-60px;
        }
    </style>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex flex-column justify-content-center arrow">
        <nav id="navbar" class="nav-menu">
            <ul>
                <li><a href="/RHT2/profile.php" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
                            style="color: #ff0101;"></i><span>Go Back</span></a>
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
                <li><a href="/RHT2/profile.php" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
                            style="color: #ff0000;"></i><span></span></a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- go back button end -->
    <br>
    <br>
    <div class="container">
        <div class="row">
            <h1 class="title">Edit Profile</h1>
            <div class="col-lg-4">
                <div class="card">
                    <?php
                    if (isset($_POST['edit_profile'])) {
                        //data updating in userdb
                        $name = $_POST['name'];
                        $mobno = $_POST['mobno'];
                        $address = $_POST['address'];
                        $gender = $_POST['gender'];
                        $folder = 'image_data/user_data/';
                        $file = $_FILES['image']['tmp_name'];
                        $file_name = $_FILES['image']['name'];
                        $file_name_array = explode('.', $file_name);
                        $extension = end($file_name_array);
                        $new_image_name = 'profile_' . rand() . '.' . $extension;
                        if ($_FILES["image"]["size"] > 1000000) {
                            echo "<script>
                                alert('Sorry, your image is too large.Upload less than 1 MB in size.');
                                </script>";
                            $error = 'Sorry,your image is too large.Upload less than 1 MB in size.';
                        }
                        if ($file != "") {
                            //checks the file is in the format of image or not
                            if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" && $extension != "PNG" && $extension != "JPG" && $extension != "JPEG" && $extension != "GIF" ) {
                                echo "<script>
                                alert('Sorry, Unable to upload image it must be in .jpg, .jpeg, .png or .gif format');
                                window.href.src('/RHT2/edit_profile.php');
                                </script>";
                                
                                $error = 'Sorry, your image is too large.Upload less than 1 MB in size.';
                            }
                        }
                        if (!isset($error)) {
                            if ($file != "") {
                                //deleting the old image from databse also from the file.
                                $result = mysqli_query($conn, "SELECT user_image from userdb WHERE eid='$username'");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $deleteimage = $row['user_image'];
                                }
                                unlink($deleteimage);
                                move_uploaded_file($file, $folder . $new_image_name);
                                mysqli_query($conn, "UPDATE userdb SET user_image ='$folder$new_image_name' WHERE eid='$username'");
                            }
                            $result = mysqli_query($conn, "UPDATE userdb SET name='$name', gender='$gender', mobno='$mobno',address='$address' WHERE eid='$username'");
                            if ($result) {
                                // header_remove();
                                // header("location: /RHT2/profile.php?profile_updated=1");
                                // $success="Profile Updated Successfully";
                                // header_remove();
                                // header("location: /RHT2/profile.php?profile_updated=1");
                                echo"<script>
                                window.location.href ='/RHT2/profile.php?profile_updated=1';
                                </script>";
                            } else {
                                echo"<script>
                                alert('Something Went Wrong!');
                                </script>";
                            }
                        }
                    }
                    ?>
                    <form method="POST" action="/RHT2/edit_profile.php" enctype="multipart/form-data">
                    <div class="titl">                
                    </div>
                        <h1 class="titl"><span class="title12">Profile Picture</span></h1>
                        <div style="width:100%;padding:auto;">
                        <?php
                        if ($image == "") {
                            echo '<img src="image_data/default_user_img.png" height="200px" width="200" alt="profile picture" class="rounded-pill pict">';

                        } else {
                            echo '<img src="' . $image . '" height="200px" width="200" alt="profile picture" class="rounded-pill pict">';
                        }
                        ?>
                        </div>
                        <!-- <img src="assets/img/u1.jpg" height="200px" width="200" alt="" class="rounded-pill pict"> -->
                        <div class="card-body">
                            <input type="file" id="image" name="image" style="border:darkgrey 2px solid;"
                                class="form-control"  value="<?php echo $image ?>">
                            <!-- <input type="button" class="btn btn-outline-primary" value="Change profile Picture"
                            data-bs-toggle="modal" data-bs-target="#myModal2    "> -->
                        </div>
                </div>
            </div>
            <div class="col-lg-8 navbar-expand-sm">
                <div class="card">
                    <h1 class="titl"><span class="title12">Account Details</span></h1>
                    <div class="card-body">
                        <?php
                        //shows the information of user with editabke textbox
                        echo '<h6 class="text" id="letters" style="color:black;">Name</h6>
                                <input type="text" id="fname2" class="text1" name="name" placeholder="Name" value="' . $name . '" required>
                                <br><br>

                                <h6 class="text" id="letters" style="color:black;">Email</h6>
                                <input type="text" id="mobno" class="text3"  name="email" placeholder="Email" value="' . $email . '" required disabled title="You can not change email id"><br><br>

                                <h6 class="text" id="letters" style="color:black;">Mobile No</h6>
                                <input type="phone" id="mobno" class="text3" min="10" maxlength="10" name="mobno" placeholder="Mobile No" value="' . $mobno . '" required>
                                <br><br>                                  

                                <h6 class="text" id="letters" style="color:black;">Address</h6>
                                <input type="text" id="address" class="text1" name="address" placeholder="Address" value="' . $address . '" required>
                                <br><br>';
                        ?>
                        <h6 class="text"><span class="text5" id="letters" required style="color:black;">Gender</span></h6>
                        <!-- Radio Nutton for Gender -->
                       &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" class="text"  name="gender" value="Male"<?php if (($gender == "Male")) {
                            echo "checked";
                        } ?>>&nbsp; Male &nbsp;
                        <input type="radio" name="gender"  value="Female" class="text"<?php if (($gender == "Female")) {
                            echo "checked";
                        } ?>>&nbsp;Female
                        <div class="card-body">
                            <!-- Button for save changes which is updated data in the  -->
                            <input type="submit" id="letter" class="btn btn1 btn-outline-primary" name="edit_profile"
                                value="Save Changes">
                            </form>
                        </div>
                        <div class="text-end">
                            <!-- After clicking this it will show the modal -->
                        <a href="" id="chpa" class="cp" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa-solid fa-key"></i>
                                Change Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
    <!-- Modal for change password -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--modal content-->
                <div class="modal-header">
                    <!-- After Clicking the change password in the edit profie page then it fade up on webpage -->
                    <h5>Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!--Modal content-->
                <div class="modal-body">
                    <?php
                    if (isset($_POST["change_password"])) {
                        //used for change password
                        $oldpassword = $_POST["oldpassword"];
                        $newpassword = $_POST["newpassword"];
                        $comfirmpassword = $_POST["comfirmpassword"];
                        $mainpassword = $password;
                        //checks the olad and mainpassword
                        if ($mainpassword == $oldpassword) {
                            //checks the comfirmpassword an new password is same
                            if ($comfirmpassword == $newpassword) {
                                if (strlen($password) <= '8') {
                                    echo"<script>
                                alert('Your Password Must Contain At Least 8 Characters!');
                                </script>";
                                  } elseif (!preg_match("#[0-9]+#", $password)) {
                                    echo"<script>
                                alert('Your Password Must Contain At Least 1 Number!');
                                </script>";
                                  } elseif (!preg_match("#[A-Z]+#", $password)) {
                                    echo"<script>
                                    alert('Your Password Must Contain At Least 1 Capital Letter!');
                                    </script>";
                                  } elseif (!preg_match("#[a-z]+#", $password)) {
                                    echo"<script>
                                    alert('Your Password Must Contain At Least 1 Lowercase Letter!');
                                    </script>";
                                  } else {
                                    //query to update password in the
                                $result = mysqli_query($conn, "UPDATE userdb SET password ='$newpassword' WHERE eid='$username'");
                                if ($result) {
                                    echo"<script>
                                alert('Password Updated Successfully!');
                                </script>";
                                } else {
                                    echo"<script>
                                alert('Failed to update password!');
                                </script>";
                                }
                            }
                        }
                            else {
                                echo"<script>
                            alert('New Password and Confirm Password Does not match!');
                            </script>";
                            }
                        }
                        else {
                            echo"<script>
                        alert('Old Password does not match!');
                        </script>";
                        }
                    }
                    ?>
                    <form method="POST" action="">
                        <!-- <h6 class="text">Username</h6>
                        <input type="text" id="fname" class="text7" name="name" placeholder="Username">
                        <br><br> -->
                        <h6 class="text" style="color:black;"> Old Password</h6>
                        <input type="password" id="fname" class="text7" name="oldpassword" placeholder="Password" required>
                        <br><br>
                        <h6 class="text"><span class="text8" required style="color:black;">New Password</span></h6>
                        <input type="text" id="fname1" class="text10"  name="newpassword" placeholder="New Password" required ><br><br>
                        <h6><span class="text" required style="color:black;">Confirm Password</span></h6>
                        <input type="password" id="cpass" class="text10" name="comfirmpassword" placeholder="Confirm Password" style="width: 100%;" ><br>
                        <input type="checkbox" id="cb1" class="text10" onclick="myFunction()" style="width: 18px; height:18px; margin-top:10px;">Show Password
                        <script>
                            function myFunction() {
                                // used for show password
                            var x = document.getElementById("cpass")
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                            }
                        </script>
                </div>
                <!--Modal Footer-->
                <div class="modal-footer">
                    <input type="submit" id="submit" name="change_password" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for Update profile -->
</body>
</html>