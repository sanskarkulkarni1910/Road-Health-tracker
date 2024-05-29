<?php
$name = '';
$email = '';
$mobno = '';
$address = '';
$gender = '';
$signupdate = '';
$image = '';
$Complaintresult = false;
$Displayresult = false;
require "partials/_dbconnect.php";
session_start();
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != true)) {
    //checks the user is logged in
    header("location: /RHT2/");
    exit;
} 
else {
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
            $mobno = $row['mobno'];
            $signupdate = $row['datetime'];
            $image = $row['user_image'];
        }
        //For Complaints -- Data Collection which is send by particular user
        $ComplaintQuery = "SELECT * FROM `complaintdb` WHERE `eid` LIKE '$username'";
        $Complaintresult = mysqli_query($conn, $ComplaintQuery);
        $num = mysqli_num_rows($Complaintresult);
        
    }

    if ($_SESSION['logtype'] == "Municipal") {
        $style = "style='display:none'";
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM municipledb WHERE eid = '$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        //Displaying the sql query
        if ($num == 1) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['eid'];
            $address = $row['address'];
            $password=$row['password'];
            $gender = "Municipal";
            $mobno = $row['mobno'];
            $signupdate = '28/01/2024';
            $image = "assets/img/municipal_logo.png";
        }
        $style = "style='display:none'";
    }
}
// GET data from URL
if (isset($_GET['profile_updated'])) {
    echo"<script>
        alert('Profile Updated Successfully!');
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- disabled right click -->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap Links -->
    <style>
@media screen and (max-width:800px) {
    .pflex2{
        margin-top:250px;
        margin-left:-260px;
        font-size:12x;
    }
    .button{
        border:hidden;
    }

    .pict{
        margin-left:50px;
    }
    .titl{
        margin-left:50px;
    }
    #title1{
        margin-top:20px;
    }
    #btn678{
        margin-left:-89px;
    }
    #button,#buttone{
        width:30px;
    }

    #ep{
        margin-left:-30px;
    }

    #info{
        margin-left:-310px;
    }

    #hrr{
        width:350px;
    }

    #img{
        margin-left:100px;
    }
    #fill-table{
        width:102%;
    }
    #table-width{
        width:102%;
    }
}
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }
        th,
        td {
            font-size: 12px;
            text-align: left;
            text-wrap: balance;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #bab4b4;
        }
        .pflex {
            display: flex;
            font-size: 16px;
            padding: 20px;
        }
        .pflex1 {
            flex: 25%;
            text-align: center;
        }
        .pfdata {
            margin: 10px;
            padding-bottom: 10px;
            }
        .pflex2 {
            flex: 75%;
            justify-content: left;
            padding-top: 20px;
            padding-left: 30px;
            /* border-left: 1px solid grey; */
        }

        .card{
            height:260px;
            box-shadow: 0 0 30px rgb(105, 102, 102);
        }
        #cc{
            font-family: "Teko", sans-serif;
            color:white;
        }
        .co{
            margin-bottom:11px;
        }
        #button{
            border:hidden;
            margin-top:30px;
        }
        #buttone{
            border:hidden;
            margin-top:34px;
        }
        #tble{
            height:80px;
        }
        #box{
            border-radius:100px;
        }
        .hrh{
            width:600px;
        }
        .card-bdy{
            height:125%;
            border:hidden;
            box-shadow: 0 10px 30px rgb(105, 102, 102);
            border-radius:5px;
        }       
        .cc{
            color:white;
            font-size:15px;
            font-weight:bold;
        }
    </style>
    <title>Road Health Tracker</title>
    <!-- Favicons -->
    <link href="assets/img/RHT_logo-removebg-preview.png" rel="icon">
    <link href="assets/img/RHT_logo-removebg-preview.png" rel="apple-touch-icon">

     <!-- disabled right click -->
    <script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    </script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

 <!-- bottstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- ======= Header ======= -->
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
    <!-- go back button end -->
    <div class="container" id="fill-table">
        <div class="card col-md-12">
            <div class="card-header">
                <h1 style="text-align:center"> <b>Profile</b></h1>
                <?php
                if (isset($success)) {
                    echo '<div class="alert alert-danger alert-dismissible fade out">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong>' . $success . '</div>';
                }
                ?>
            </div>
            <div class="card-body">
                <div class="pflex">
                    <div class="pflex1">
                        <h1 class="titl"><span class="title12">Profile Picture</span></h1>
                        <?php
                        // Image of user or municipal
                        if($image=="")
                        {
                            echo '<img src="image_data/default_user_img.png" height="200px" width="200" alt="" class="rounded-pill pict mt-5">';
                        }
                        else{
                            echo '<img src="' . $image . '" height="200px" width="200" alt="" class="rounded-pill pict">';
                        }
                        ?>
                    </div>
                    <div class="pflex2" id="info">
                        <br>
                        <!-- User Data accessing dynamically -->
                        <?php
                        echo '<span class="pfdata"><b title="Name"><i class="fa-solid fa-user"></i>&nbsp;</b>' . $name . ' </span><br><hr class="hrh" id="hrr">
                        <span class="pfdata"><b title="You are"><i class="fa-solid fa-genderless"></i>&nbsp;</b> ' . $gender . '</span><br><hr class="hrh" id="hrr">
                        <span class="pfdata"><b title="Email"><i class="fa-solid fa-at"></i>&nbsp;</b> ' . $email . '</span><br><hr class="hrh" id="hrr">
                        <span class="pfdata"><b title="Mobile No"><i class="fa-solid fa-mobile"></i>&nbsp;</b> ' . $mobno . '</span><br><hr class="hrh" id="hrr">
                        <span class="pfdata"><b title="Address"><i class="fa-solid fa-address-card"></i>&nbsp;</b> ' . $address . '</span><br><hr class="hrh" id="hrr">
                        <span class="pfdata"><b title="Sign Up Date"><i class="fa-solid fa-calendar-day"></i>&nbsp;</b> ' . $signupdate . '</span><br>';
                        ?>
                    </div>
                    <div>
                        <?php
                        if ($_SESSION['logtype'] == "User") {
                            // Only user can change their profile
                            echo '<a href="/RHT2/edit_profile.php"><i class="fa-solid fa-pen-to-square" style="color:#bb0c0c; font-size:20px;" title="Edit Profile" id="ep"></i>
                            </a>';
                        }
                        ?>
                    </div>
                </div>
          <?php
    if ($_SESSION['logtype'] == "Municipal") { 
        // Municipal change their password only
      echo '
         <button class="border-0" style=" margin-left:85%; background-color:white;"><a href="chpassword.php" id="btn678" style="font-size:15px;">Change Password?</a></button>';
         
            }
            ?>
            </div>
        </div>
    </div>
    
    <br>
    <br>
    <div class="container" id="table-width">
        <div class="row justify-content-center">
                <h1 class="text-center">Dashboard</h1><br><br><br><hr>
                <!-- Dashboard  -->
                <!-- It contains 5 blocks or cards  -->
            <div class="col-lg-2 text-center"><br>
                <div class="card-bdy" style="background: linear-gradient(110.1deg, rgb(34, 126, 34) 2.9%, rgb(168, 251, 60) 90.3%);">
                     <div class="card-body text-center"><br>
                     <h3 class="cc">Completed Complaints</h3><br>
                       <button class="rounded-pill px-md-5 button" id="button"> 
                       <?php 
                       if ($_SESSION['logtype'] == "User") {
                        $sql="SELECT * FROM `complaintdb` WHERE `eid` LIKE '$username' AND `comfirm` LIKE 'verified' AND `status` LIKE 'completed'";
                        if($result = mysqli_query($conn,$sql))
                        {
                            $count= mysqli_num_rows($result);
                            echo"<h1>".$count."</h1>";
                        }
                        else{
                            echo"<h1>0</h1>";
                        }
                    }
                    else{  
                        $sql="SELECT * FROM `complaintdb` WHERE `comfirm` LIKE 'verified' AND `status` LIKE 'completed'";
                        if($result = mysqli_query($conn,$sql))
                        {
                            $count= mysqli_num_rows($result);
                            echo"<h1>".$count."</h1>";
                        }
                        else{
                            echo"<h1>0</h1>";
                        }
                    }
                       ?></button>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 text-center"><br>
                <div class="card-bdy" style="background: radial-gradient(337px at 0% 2.1%, rgb(0, 226, 192) 0.3%, rgb(149, 0, 248) 100%);">
                     <div class="card-body"><br>
                     <!-- Pending Block -->
                     <h3 class="cc">Pending Complaints</h3><br>
                     <button class="rounded-pill px-md-5 button" id="button">
                     <?php 
                        if ($_SESSION['logtype'] == "User") {
                            $sql="SELECT * FROM `complaintdb` WHERE `eid` LIKE '$username' AND`comfirm` LIKE 'Not Verified' AND `status` LIKE 'Not Completed'";
                            if($result = mysqli_query($conn,$sql))
                            {
                                $count= mysqli_num_rows($result);
                                echo"<h1>".$count."</h1>";
                            }
                            else{
                                echo"<h1>0</h1>";
                            }
                        }
                        else{  
                            $sql="SELECT * FROM `complaintdb` WHERE `comfirm` LIKE 'Not Verified' AND `status` LIKE 'Not Completed'";
                            if($result = mysqli_query($conn,$sql))
                            {
                                $count= mysqli_num_rows($result);
                                echo"<h1>".$count."</h1>";
                            }
                            else{
                                echo"<h1>0</h1>";
                            }
                        } 
                       ?>
                       </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 text-center"><br>
                <div class="card-bdy"  style="background: linear-gradient(108.4deg, rgb(253, 44, 56) 3.3%, rgb(176, 2, 12) 98.4%);">
                     <div class="card-body"><br>
                     <h3 class="cc">Blocked Complaints</h3><br>
                     <!-- Blocked Complaint -->
                     <button class="rounded-pill px-md-5 button" id="buttone">
                     <?php 
                        if ($_SESSION['logtype'] == "User") {
                            $sql="SELECT * FROM `complaintdb` WHERE `eid` LIKE '$username'   AND `status` LIKE 'Blocked'";
                            if($result = mysqli_query($conn,$sql))
                            {
                                $count= mysqli_num_rows($result);
                                echo"<h1>".$count."</h1>";
                            }
                            else{
                                echo"<h1>0</h1>";
                            }
                        }
                        else{  
                            $sql="SELECT * FROM `complaintdb` WHERE `status` LIKE 'Blocked'";
                            if($result = mysqli_query($conn,$sql))
                            {
                                $count= mysqli_num_rows($result);
                                echo"<h1>".$count."</h1>";
                            }
                            else{
                                echo"<h1>0</h1>";
                            }
                        } 
                       ?></button>

                    </div>
                </div>
            </div>
            <div class="col-lg-2 text-center"><br>
                <div class="card-bdy" style="background: linear-gradient(109.6deg, rgb(187, 0, 212) 11.2%, rgb(32, 38, 238) 91.1%);">
                     <div class="card-body"><br>
                     <h3 class="cc" class="co">Total Complaints</h3><br>
                     <!-- Total Complaint Blocks -->
                     <button class="rounded-pill px-md-5 button" id="button">
                    <?php 
                        if ($_SESSION['logtype'] == "User") {
                            $sql="SELECT * FROM `complaintdb` WHERE `eid` LIKE '$username'";
                            if($result = mysqli_query($conn,$sql))
                            {
                                $count= mysqli_num_rows($result);
                                echo"<h1>".$count."</h1>";
                            }
                            else{
                                echo"<h1>0</h1>";
                            }
                            
                        }
                        else{  
                            $sql="SELECT * FROM `complaintdb`";
                            if($result = mysqli_query($conn,$sql))
                            {
                                $count= mysqli_num_rows($result);
                                echo"<h1>".$count."</h1>";
                            }
                            else{
                                echo"<h1>0</h1>";
                            }
    
                        }
                       ?></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 text-center"><br>
                <div class="card-bdy" style="background: linear-gradient(107deg, rgb(255, 67, 5) 11.1%, rgb(245, 135, 0) 95.3%);">
                     <div class="card-body"><br>
                     <h3 class="cc" class="co"> Total Feedbacks</h3><br>
                     <!-- Total Feedabacks block -->
                     <button class="rounded-pill px-md-5 button" id="button">
                    <?php 
                     if ($_SESSION['logtype'] == "User") {
                        $sql="SELECT * FROM `feedbackdb` WHERE `eid` LIKE '$username'";
                        if($result = mysqli_query($conn,$sql))
                        {
                            $count= mysqli_num_rows($result);
                            echo"<h1>".$count."</h1>";
                        }
                        else{
                            echo"<h1>0</h1>";
                        }
                        
                    }
                    else{  
                        $sql="SELECT * FROM `feedbackdb`";
                        if($result = mysqli_query($conn,$sql))
                        {
                            $count= mysqli_num_rows($result);
                            echo"<h1>".$count."</h1>";
                        }
                        else{
                            echo"<h1>0</h1>";
                        }

                    }
                       ?></button>

                    </div>
                </div>
            </div>

        </div>
    </div><br><br>
    </div><br><br><br>
    <!-- Complaints -->
    <?php
    // If the logtype is user then the he can see their sent complaints and feedbacks in there profile.
    //so the if logtype is municipal then he can't see it .
    if ($_SESSION['logtype'] == "User") {
        echo '<div class="card">
    <br><br><div class="card-header">
        <h1 style="text-align:center;font-weight:bold;">Complaints</h1>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0" >
            <div style="overflow-x:auto;">
                <table id="tble">
                    <thead>
                        <tr>
                            <th id="img">&nbsp;&nbsp;&nbsp;Id</th>
                            <th id="img">Image</th>
                            <th id="img">Complaint</th>
                            <th id="img">Area</th>
                            <th id="img">Location</th>
                            <th id="img">Date and Time</th>
                            <th id="img">Verification</th>
                            <th id="img">Status</th>
                        </tr>
                    </thead>
                    <tbody>';

        if ($num > 0) 
        {
            // fetching data from the complaintdb and displaying it.
            while ($row = mysqli_fetch_assoc($Complaintresult)) {
                echo "<tr data-id='" . $row['sr'] . "'>
                    <td>&nbsp;&nbsp;&nbsp;C_00" . $row['sr'] . "</td>
                    <td><a href=" . $row['image'] . " target='_blank'><img src='" . $row['image'] . "' width='50' height='50'/></a> </td>
                    <td>" . $row['complaint'] . "</td>
                    <td>" . $row['area'] . "</td>
                    <td><a href='#' onclick='openMap(" . $row['latitude'] . "," . $row['longitude'] . ")' class='text-secondary font-weight-bold text-xs' title='Click to go' ><i class='fas fa-map-marker-alt'></i> Click</a></td>
                    <td>" . $row['datentime'] . "</td>
                    <td>" . $row['comfirm'] . "</td>
                    <td>" . $row['status'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='8'><br><h3 style='text-align:center;'>No data found!</h3><br></td></tr>";
        }

        echo '            </tbody>
                        </table>
                    </div>
                </blockquote>
            </div>
        </div>

        <!-- Feedbacks -->
        <br><br>
        <br><br><br>

        <div class="card">
            <div class="card-header">
                <h1 style="text-align:center;font-weight:bold;">Feedbacks</h1>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div style="overflow-x:auto;">
                        <table id="tble">
                            <thead>
                                <tr>
                                    <th id="img">&nbsp;&nbsp;&nbsp;Id</th>
                                    <th id="img">Image</th>
                                    <th id="img">Message</th>
                                    <th id="img">Area</th>
                                    <th id="img">Location</th>
                                    <th id="img">Date and Time</th>
                                    <th id="img">Rating</th>
                                    <th id="img">Reply</th>

                                </tr>
                            </thead>
                            <tbody>';
                            // For Feedbacks Data Collection which is send by particular user
                            $DisplayQuery = "SELECT * FROM `feedbackdb` WHERE `eid` LIKE '$username'";
                            $Displayresult = mysqli_query($conn, $DisplayQuery);
                            $num = mysqli_num_rows($Displayresult);
                            $style = "style='display:block'";
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($Displayresult)) {
                    
            // fetching data from the Feedbackdb and displaying it.
                echo "<tr data-id='" . $row['sr'] . "'>
                                            <td>&nbsp;&nbsp;&nbsp;F_00" . $row['sr'] . "</td>
                                            <td><a href=" . $row['image_link'] . " target='_blank'><img src='" . $row['image_link'] . "' width='50' height='50'/></a> </td>
                                            <td>" . $row['msg'] . "</td>
                                            <td>" . $row['area'] . "</td>
                                            <td><a href='#' onclick='openMap(" . $row['latitude'] . "," . $row['longitude'] . ")' class='text-secondary font-weight-bold text-xs' title='Click to go' ><i class='fas fa-map-marker-alt'></i> Click</a></td>
                                            <td>" . $row['datentime'] . "</td>
                                            <td>" . $row['rating'] . "</td>
                                            <td>" . $row['reply'] . "</td>
                                            </tr>";
            }
        } else {
            echo "<tr ><td colspan='8'><br><h3 style='text-align:center;'>No data found!</h3><br></td></tr>";
        }
        echo '      
                            </tbody>
                        </table>
                    </div>
                </blockquote>
            </div>
        </div>';

    }
    ?>
<!-- Modal for change password start -->
    <!-- Modal for change password end -->
    <script>
        function openMap(latitude, longitude) {
            // create URL for Google Maps with the provided latitude and longitude
            const url = `https://www.google.com/maps/search/?api=1&query=${latitude},${longitude}`;
            // open the URL in a new window
            window.open(url);
        }
    </script>
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
</body>
</html><br><br>