<?php
include_once 'partials/_dbconnect.php';
//retrieve data from the complaintdbn
$DisplayQuery = "SELECT * FROM `complaintdb`";
$result = mysqli_query($conn, $DisplayQuery);
$num = mysqli_num_rows($result);
$count=0;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <li><a href="/RHT2/complaints.php" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
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
                <li><a href="/RHT2/complaints.php" class="nav-link scrollto"><i class="fa-solid fa-arrow-left"
                            style="color: #ff0000;"></i><span></span></a>
                </li>
            </ul>
        </nav>
    </div>
    <section class="complaint-body">
        <div class="card">
            <div class="card-header">
                <h1 style="text-align:center;font-weight:bold;">Complaints (Completed)</h1>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div style="overflow-x:auto;">
                        <table>
                        <!-- Table to display the data for complaints those are completed by municiple -->
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Image</th>
                                    <th>Complaint</th>
                                    <th>Area</th>
                                    <th>Location</th>
                                    <th>Date and Time</th>
                                    <th>Posted by</th>
                                    <th>email Id</th>
                                    <th>Vefication</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($num > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        //return the data from each column by their column name
                                        if(($row['comfirm']=="Verified")&&($row['status']=="Completed")){
                                        echo "<tr data-id=" . $row['sr'] . ">
                                        <td>C_00" . $row['sr'] . "</td>
                                            <td><a href='" . $row['image'] . "'><img src='" . $row['image'] . "' width='50' height='50'></a> </td>
                                            <td>" . $row['complaint'] . "</td>
                                            <td>" . $row['area'] . "</td>
                                            <td><a href='#' onclick='openMap(" . $row['latitude'] . "," . $row['longitude'] . ")' class='text-secondary font-weight-bold text-xs' title='Click to go' ><i class='fas fa-map-marker-alt'></i> Click</a></td>
                                            <td>" . $row['datentime'] . "</td>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['eid'] . "</td>
                                            <td>" . $row['comfirm'] . "</td>
                                            <td>" . $row['status'] . "</td>
                                           </tr>";
                                           $count++;
                                        }
                                    }
                                    if($count==0){
                                        echo "<tr ><td colspan='11'><br><h3 style='text-align:center;'>No Complaints Yet!!</h3><br></td></tr>";
                                    }
                                }
                                else{
                                    echo"<tr ><td colspan='12'><br><h3 style='text-align:center;'>No data found!</h3><br></td></tr>";
                                }
                                ?>                                
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
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/custom-js/jquery.multi-select.html"></script>
    <script src="../assets/libs/js/main-js.js"></script>
</body>
</html>