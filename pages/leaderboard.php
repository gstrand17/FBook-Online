<?php
  $title = "Leaderboard";
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/catalog.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
	</head>
	<body>
        <nav class="navbar navbar-expand-lg uf-gradient px-3">
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/uf_logo.png" alt="UF Logo" style="height: 40px; width: auto;">
            </a>

            <div class="navbar-nav d-flex flex-row ms-auto">
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-white" href="../index.php">
                        Home
                    </a>
                </div>
                
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        F-Book
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="catalog.php">My F-Book</a></li>
                    </ul> 
                </div>
                
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Achievements
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="leaderboard.php">Leaderboard</a></li>
                        <li><a class="dropdown-item" href="achievements.php">View Achievements</a></li> 
                    </ul>
                </div>
                
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Connect
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Event</a></li>
                    </ul>
                </div>
                <a class="btn btn-primary" href="#" role="button">Logout</a>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <main class="main-content">
        </main>
        <footer class="dashboard-footer">
            <div class="footer-left">
                <img src="../assets/uf_logo_with_slogan.png" alt="UF Logo with Slogan">
            </div>

            <div class="footer-center">
                <p class="footer-heading">Contact</p>
                <p>(352) 392-1905</p>
                <p>UFALUM@UFALUMNI.UFL.EDU</p>
            </div>

            <div class="footer-right">
                <p class="footer-heading">Follow Us</p>

                <div class="social-icons">
                    <a href="#">
                        <img src="../assets/x_site_logo.png" alt="X">
                    </a>

                    <a href="#">
                        <img src="../assets/insta_logo.png" alt="Instagram">
                    </a>
                </div>
            </div>

        </footer>
        
	</body>
</html>