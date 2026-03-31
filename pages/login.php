<?php
  $title = "Login Page";
?>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	</head>
	<body class="century-tower-bg-page">
        <nav class="navbar navbar-expand-lg uf-gradient px-3">
            <a class="navbar-brand" href="#">
                <img src="../assets/uf_logo.png" alt="UF Logo" style="height: 40px; width: auto;">
            </a>

            <div class="navbar-nav d-flex flex-row ms-auto">
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Home
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </div>
                
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        F-Book
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                    </ul>
                </div>
                
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Achievements
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                    </ul>
                </div>
                
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Connect
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <h1 class="text-center mt-5 text-white" style="-webkit-text-stroke: 1px gray; font-size: 50px; padding-bottom: 40px;">Get Ready To Start Your F-Book Journey</h1>
        <div class="mb-3">
        <input type="email" class="form-control" id="emailInput" placeholder="Email or Phone Number">
        </div>
        <div class="mb-3">
        <input type="password" class="form-control" id="passwordInput" placeholder="Password">
        </div>

        <div class="form-check text-center d-flex align-items-center justify-content-center">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label text-white ms-2" for="flexCheckDefault">
            Remember Me
        </label>
        </div>

        <p class="fst-italic custom-text-shadow text-center" style="color: #9babe8">
        Forgot Password?
        </p>

        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary rounded-0 px-5" style="background-color: #1c233f; font-family: 'Times New Roman', Times, serif;"  onclick="window.location.href='/pages/dashboards.php'">Join Now</button>
        </div>

        <nav class="navbar fixed-bottom navbar-expand-lg navbar-dark uf-blue-footer px-3">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/uf_logo_with_slogan.png" alt="UF Logo" style="height: 80px; width: auto;">
                </a>
                <div>
                    <h6>Contact</h6>
                    <h6>123-456-7890</h6>
                    <h6>UFALUM@UFALUMNI.UFL.EDU</h6
                    >            </div>
                    <div>
                        <h6>Follow Us</h6>
                        <div>
                            <img src="../assets/insta_logo.png" alt="Insta Logo" style="height: 50px; width: auto;">
                            <img src="../assets/x_site_logo.png" alt="Twitter Logo" style="height: 50px; width: auto;">
                        </div>
                    </div>
            </div>
        </nav>
	</body>
</html>