<?php
$showAlert = false;
$error=null;
$success=null;
include_once 'partials/_dbconnect.php';
session_start();
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != true)) {
    header("location: /RHT2/");
    exit;
} else {
    $username=$_SESSION['username'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //error_reporting is used dont show any error while pages start
        error_reporting(0);
        //Code to upload file in another folder
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "image_data/complaint_img/" . $filename;
        move_uploaded_file($tempname, $folder);
        $fname = $_POST["fname"];
        $email = $username;
        $mob = $_POST["mobno"];
        $complaint = $_POST["complaint"];
        $area = $_POST["area"];
        $longitude = $_POST["longitude"];
        $latitude = $_POST["latitude"];
        $sql = "INSERT INTO `complaintdb` (`sr`, `image`, `name`, `complaint`, `datentime`, `area`, `longitude`, `latitude`, `comfirm`, `eid`, `mobno`, `status`) VALUES (NULL, '$folder', '$fname', '$complaint',current_timestamp(), '$area', '$longitude', '$latitude', 'Not Verified', '$email', '$mob','Not Completed');";
        $result = mysqli_query($conn, $sql);
        if ($result) 
        {
            $success[] ="Complaint Registered Successfully.";
        } else {
            $error[] ="Failed to submit complaint.";
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
    
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Road Health tracker</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/RHT_logo-removebg-preview.png" rel="icon">
    <link href="assets/img/RHT_logo-removebg-preview.png" rel="apple-touch-icon">

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


    <!-- bottstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        .frmcompl {
            width: 60%;
            margin: auto;
        }

        #map {
            height: 400px;
            width: 100%;
        }

        #map-container {
            width: 500px;
            height: 400px;
        }
    </style>

    <!-- Code for Geolocation using Leaflet -->


    <script>
        window.addEventListener('load', function () {
            initMap();
        });

        var map;
        var marker;

        function initMap() {
            map = L.map('map').setView([0, 0], 3);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            // Get user's current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var initialLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setView(initialLocation, 13);
                    marker = L.marker(initialLocation, {
                        draggable: true
                    }).addTo(map);
                    marker.on('dragend', function () {
                        updatePosition(marker.getLatLng().lat, marker.getLatLng().lng);
                    });
                });
            } else {
                // If geolocation is not supported, set initial location to (0, 0)
                var initialLocation = { lat: 0, lng: 0 };
                map.setView(initialLocation, 3);
                marker = L.marker(initialLocation, {
                    draggable: true
                }).addTo(map);
                marker.on('dragend', function () {
                    updatePosition(marker.getLatLng().lat, marker.getLatLng().lng);
                });
            }

            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                updatePosition(marker.getLatLng().lat, marker.getLatLng().lng);
            });
            map.on('dblclick', function (e) {
                setCurrentLocation();
            });
        }
        function hideMap() {
            document.getElementById('map-container').style.display = 'none';

        }

        function updatePosition(latitude, longitude) {
            // it will round to the decimal characters
            document.getElementById('latitude').value = latitude.toFixed(6);
            document.getElementById('longitude').value = longitude.toFixed(6);
        }

        function showMap() {
            if (map) {
                map.invalidateSize();
                map.setView(marker.getLatLng());
            } else {
                initMap();
            }
            updatePosition(marker.getLatLng().lat, marker.getLatLng().lng);
            document.getElementById('map-container').style.display = 'block';
        }

        function setCurrentLocation() {
            if (navigator.geolocation) {
                //used for set current location
                navigator.geolocation.getCurrentPosition(function (position) {
                    var currentLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    marker.setLatLng(currentLocation);
                    updatePosition(currentLocation.lat.toFixed(6), currentLocation.lng.toFixed(6));
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

    </script>
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
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 class="heading">Complaint Form</h2>
                <hr>
            </div>
            <?php
            if (isset($error)) {
                // When the error is set
                echo '<div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> &nbsp;' . $error[0] . '.</div>';
            } 
            if (isset($success)) {
                // when the success is set
                echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Complint Submitted Successfully!</strong> &nbsp;'.$sucess[0].'.</div>';
            }
            ?>
            <div class="frmcompl">
                <div class="row">
                    <form method="POST" action="/RHT2/frm_complaint.php" enctype="multipart/form-data">
                        <!-- Complaint Form -->
                    <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="*Enter Name: "
                                required style="border:darkgrey 2px solid;">
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-6 form-group">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="*Email-id:" required style="border:darkgrey 2px solid;"
                                    autocomplete="on" value="<?php echo$username?>" disabled>
                            </div>
                            <div class="col-md-6  form-group">
                                <input type="text" name="mobno" class="form-control" id="mobno" placeholder="*Mob No.:"
                                    required style="border:darkgrey 2px solid; width:325px;">
                            </div>
                        </div>
                        <div class="form-group col-md-12 ">
                            <textarea minlength="20" maxlength="450" class="form-control"
                                id="exampleFormControlTextarea1" name="complaint" style="border:darkgrey 2px solid;"
                                rows="5" placeholder="*Write a complaint here........"></textarea>
                        </div>
                        <div class="form-group col-md-12 ">
                            <input type="text" class="form-control" name="area" id="area" placeholder="*Nearest Area"
                                style="border:darkgrey 2px solid;" required>
                        </div>

                        <div class="row col-md-12">
                            <div class="container">
                                <h5 class="utpor"><b>*Update Your Location: </b></h5>
                                <div class="col-md-9">
                                    <div id="map-container" class="my-4" style="display: none;">
                                        <div id="map"></div>
                                        <div onclick="hideMap()" class="mt-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12 ">
                            <div class="col-md-4 form-group">
                                <input type="text" class="form-control" name="latitude" id="latitude"
                                    placeholder="Latitude" readonly style="border:darkgrey 2px solid;" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" class="form-control" name="longitude" id="longitude"
                                    placeholder="Longitude" readonly style="border:darkgrey 2px solid;" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <input onclick="showMap()" title="Double Click to Update Location" type="button"
                                    class="btn btn-warning" value="Update location">
                            </div>
                        </div>
                        <div class="form-group col-md-12 ">
                            <h5 class="utpor"><b>*Upload photo here...... </b></h5>
                            <input type="file" id="uploadfile" name="uploadfile" style="border:darkgrey 2px solid;"
                                class="form-control" required>
                        </div>
                       <input type="reset" class="btn btn-danger">
                        <input type="submit" class="btn btn-success">
                    </form>
                </div>
            </div>
    </section>
    <!-- End Contact Section -->
    </main>
    <!-- End #main -->
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
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
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    
    <script>
        $('#form').parsley();
    </script>
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
</body >

</html >