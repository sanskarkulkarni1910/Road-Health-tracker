<?php
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != true)) {
    // it depends on the user or minicpal get logged in
    header("location: /RHT2/");
    exit;
} else {

    if ($_SESSION['logtype'] == "User")
        // Navbar for User
        echo '
            <header id="header" class="d-flex flex-column justify-content-center">

                <nav id="navbar" class="navbar nav-menu">
                <ul>
                    <!-- Link -->
                    <!-- <li><a href="" class="nav-link scrollto" data-bs-toggle="modal" data-bs-target="#myModal5"><i
                        class="fa-solid fa-address-card" style="color: #005eff;"></i><span>Sign In/Up</span></a></li> -->
                    <li><a href="#hero" class="nav-link scrollto"><i class="fa-solid fa-house"
                        style="color: #005eff;"></i><span>Home</span></a></li>
                    <li><a href="/RHT2/profile.php" class="nav-link scrollto"><i class="fa-solid fa-user"
                        style="color: #005eff;"></i><span>Profile</span></a></li>
                    <li><a href="#about" class="nav-link scrollto"><i class="fa-solid fa-earth-americas"
                        style="color: #005eff;"></i><span>About</span></a></li>
                    <li><a href="#services" class="nav-link scrollto"><i class="fa-solid fa-server"
                        style="color: #005eff;"></i><span>Services</span></a></li>
                    <li><a href="#contact" class="nav-link scrollto"><i class="fa-regular fa-address-card"
                        style="color: #005eff;"></i><span>Help Desk</span></a></li>
                    <li><a href="/RHT2/logout.php" class="nav-link scrollto"><i class="fa-solid fa-right-from-bracket" 
                        style="color: #005eff;"></i><span>Sign-out</span></a></li>
                    
                   
                </ul>
                </nav>
                <!-- .nav-menu -->

            </header>';
    else {
        //Navbar For Municipal
        echo ' 
                <header id="header" class="d-flex flex-column justify-content-center">

                <nav id="navbar" class="navbar nav-menu">
                <ul>
                    <!-- Link -->
                    <!-- <li><a href="" class="nav-link scrollto" data-bs-toggle="modal" data-bs-target="#myModal5"><i
                        class="fa-solid fa-address-card" style="color: #005eff;"></i><span>Sign In/Up</span></a></li> -->
                    <li><a href="#hero" class="nav-link scrollto"><i class="fa-solid fa-house"
                        style="color: #005eff;"></i><span>Home</span></a></li>
                    <li><a href="/RHT2/profile.php" class="nav-link scrollto"><i class="fa-solid fa-user"
                        style="color: #005eff;"></i><span>Profile</span></a></li>
                    <li><a href="#about" class="nav-link scrollto"><i class="fa-solid fa-earth-americas"
                        style="color: #005eff;"></i><span>About</span></a></li>
                    <li><a href="/RHT2/complaints.php" class="nav-link scrollto"><i class="fa-solid fa-circle-exclamation"
                        style="color: #005eff;"></i><span>Complaints</span></a></li>
                    <li><a href="/RHT2/feedbacks.php" class="nav-link scrollto"><i class="fa-regular fa-comment"
                        style="color: #005eff;"></i><span>Feedbacks</span></a></li>
                    <li><a href="/RHT2/logout.php" class="nav-link scrollto"><i class="fa-solid fa-right-from-bracket" 
                        style="color: #005eff;"></i><span>Sign-out</span></a></li>
                    
                    
                    
                    <!-- Link -->
                </ul>
                </nav>
                <!-- .nav-menu -->
            </header>';
    }
}

