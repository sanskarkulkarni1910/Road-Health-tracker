<?php

include_once 'partials/_dbconnect.php';
define("Verify_button", "<button value='Y' class='btn btn-success'> True </button>
    <button class='btn btn-danger' value='N' onclick='verify(this.value)'> False </button>");
define("Complete_button", "<button class='btn btn-danger'>Click if Completed</button>");

$DisplayQuery = "SELECT * FROM `complaintdb`";
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
    @media screen and (max-width:800px) {
        #bc{
        margin-left:220px;
        position:fixed;
        }            
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }
        .linknext{
            text-align: end;
            text-decoration: underline;
            color: blue;
        }

        .isDisabled {
            color: currentColor;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
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
                <h1 style="text-align:center;font-weight:bold;">Complaints</h1>
                <div class="linknext">
        <p> <a href="/RHT2/ccomplaints.php" style="font-size:11px;">completed complaints</a></p>
    </div>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div style="overflow-x:auto;">
                        <table>
                            <!-- table of all complaints -->
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                              $count=0;
                                if ($num > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if (!(($row['comfirm'] != "Not Verified") && ($row['status'] == "Completed"))) {
                                            if(!($row['status'] == "Blocked"))
                                            {
                                                //retrieving the data from the database
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
                                            <td class='align-right'>";
                                                if(($row['comfirm'])!="Verified"&&($row['comfirm'])!="Blocked")
                                                {   //if the complaint is not verified and not blocked
                                                    echo"<a href='javascript:;' class='text-secondary font-weight-bold text-xs' title='Comfirm' onclick='verify_comp(" . $row['sr'] . ")'>
                                                    &nbsp;<button type='button' class='btn btn-dark'>Verify</button><br><br>                                               
                                                </a>";
                                                echo"<a href='javascript:;' class='text-secondary font-weight-bold text-xs' title='Block' onclick='block_status(" . $row['sr'] . ")'>
                                                    &nbsp;<button type='button' class='btn btn-danger'>Report False</button>                                                   
                                                </a>";
                                                }
                                                if(($row['comfirm'])=="Verified"&&($row['comfirm'])!="Blocked")
                                                {
                                                    // if the compliaint is blocked
                                                    echo "<a title='Click if Completed' href='javascript:;' class='text-secondary font-weight-bold text-xs' 
                                                    onclick='update_status(" . $row['sr'] . ")'><button type='button' class='btn btn-dark'>Completed</button>
                                                    </a></td></tr>";
                                                }
                                            $count++;
                                        }
                                    }
                                        
                                    }
                                    }
                                    if($count==0){
                                        echo "<tr ><td colspan='11'><br><h3 style='text-align:center;'>No Complaints Yet!!</h3><br></td></tr>";
                                    }
                                ?>
                                <script>
                                    function verify_comp(id) {
                                        // Send an AJAX request to update the status of the row with the given ID
                                        $.ajax({
                                            type: "POST",
                                            url: "partials/verify_comp.php",
                                            data: { id: id },
                                            success: function (result) {
                                                // Refresh the page after the status has been updated
                                                // location.href="/RHT2/complaints.php?comp_verified=1";
                                                alert("Complaint Verified Successfully.");
                                                
                                                location.reload();
                                                undisable(id);
                                            }
                                        });
                                    }
                                    function update_status(id) {
                                        // Send an AJAX request to update the status of the row with the given ID
                                        $.ajax({
                                            type: "POST",
                                            url: "partials/update_status.php",
                                            data: { id: id },
                                            success: function (result) {
                                                // Refresh the page after the status has been updated
                                                // location.href="/RHT2/complaints.php?comp_completed=1";
                                                alert("Complaint Status Updated Successfully.");
                                                location.reload();
                                            }
                                        });
                                    }
                                    function block_status(id) {
                                        var msg = prompt("Enter Reason Here: ");
                                        // Send an AJAX request to update the status of the row with the given ID
                                        $.ajax({
                                            type: "POST",
                                            url: "partials/block_status.php",
                                            data: { id: id, msg: msg },
                                            success: function (result) {
                                                // Refresh the page after the status has been updated
                                                // location.href="/RHT2/complaints.php?comp_completed=1";
                                                alert("Complaint Blocked Successfully.");
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
                        <div class="text-end" id="bc" style="margin-top:10px; font-size:11px;">
                            <a href="/RHT2/blocked_complaints.php">Blocked Complaints</a>
                        </div>
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