<?php
require_once("partials/_dbconnect.php");
session_start();
$replybtn = "<button class='btn btn-warning'>Reply</button>";
$replied = "<i>replied</replied>";
// query to access all queries from feedbackdb
$DisplayQuery = "SELECT * FROM `feedbackdb`";
$result = mysqli_query($conn, $DisplayQuery);
$num = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
           
<head>
     <!-- disabled right click -->
     <script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap Links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
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
    </style>
    <title>Road Health Tracker</title>
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
                <li><a href="/RHT2/main.php" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
                            style="color: #ff0000;"></i><span></span></a>
                </li>
            </ul>
        </nav>
    </div>

    <section class="complaint-body">
        <div class="card">
            <div class="card-header">
                <h1 style="text-align:center;font-weight:bold;">Feedbacks</h1>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div style="overflow-x:auto;">
                        <table>
                            <!-- table for feedback from feedbackdb -->
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Message</th>
                                    <th>Area</th>
                                    <th>Location</th>
                                    <th>Date and Time</th>
                                    <th>Posted by</th>
                                    <th>email Id</th>
                                    <th>Rating</th>
                                    <th>Reply</th>
                                    <th>Send</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($num > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        //write data from the feedbackdb
                                        echo "<tr data-id='" . $row['sr'] . "'>
                                            <td>F_00" . $row['sr'] . "</td>
                                            <td><a href=" . $row['image_link'] . " target='_blank'><img src='" . $row['image_link'] . "' width='50' height='50'/></a> </td>
                                            <td>" . $row['msg'] . "</td>
                                            <td>" . $row['area'] . "</td>
                                            <td><a href='#' onclick='openMap(" . $row['latitude'] . "," . $row['longitude'] . ")' class='text-secondary font-weight-bold text-xs' title='Click to go' ><i class='fas fa-map-marker-alt'></i> Click</a></td>
                                            <td>" . $row['datentime'] . "</td>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['eid'] . "</td>
                                            <td>" . $row['rating'] . "</td>
                                            <td>" . $row['reply'] . "</td>
                                            <td><a title='Click if Completed' href='javascript:;' class='text-secondary font-weight-bold text-xs' onclick='reply_feed(
                                                " . $row['sr'] . ")'><i class='fa-solid fa-reply'></i></td></tr>";
                                    }
                                } 
                                else {
                                    echo "<tr ><td colspan='12'><br><h3 style='text-align:center;'>No data found!</h3><br></td></tr>";
                                }
                                ?>
                                <script>
                                    function reply_feed(id) {
                                        var msg = prompt("Enter reply here");
                                        // Send an AJAX request to update the status of the row with the given ID
                                        $.ajax({

                                            type: "POST",
                                            url: "partials/reply_feed.php",
                                            // sends data from this page to partials/reply_feed.php page for reply to the user
                                            data: { id: id, msg: msg },

                                            success: function (result) {
                                                // Refresh the page after the status has been updated
                                                location.reload();
                                            }
                                        });
                                    }
                                </script>
                                <script>
                                    function openMap(latitude, longitude) {
                                        // create URL for Google Maps with the provided latitude and longitude
                                        const url = `https://www.google.com/maps/search/?api=1&query=${latitude},${longitude}`;

                                        // open the URL in a new window
                                        window.open(url);
                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>
                </blockquote>
            </div>
        </div>
    </section>


</body>

</html>