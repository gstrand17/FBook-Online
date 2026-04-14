<?php
  $title = "Login Page";
?>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="../css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	</head>
	<body class="century-tower-bg-page">
        <nav class="navbar navbar-expand-lg uf-gradient px-3">
            <a class="navbar-brand" href="../index.php">
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

        <main class="main-content">

        <h1 class="text-center mt-5 text-white" style="-webkit-text-stroke: 1px gray; font-size: 50px; padding-bottom: 40px;">Get Ready To Start Your F-Book Journey</h1>
        
        <form action="register.php" method="POST">
            <div class="mb-3">
            <input type="text" class="form-control" name="name" id="nameInput" placeholder="Full Name (Registration Only)">
            </div>
            <div class="mb-3">
            <input type="text" class="form-control" name="username" id="usernameInput" placeholder="Username" required>
            </div>
            <div class="mb-3">
            <input type="email" class="form-control" name="email" id="emailInput" placeholder="Email (Registration Only)">
            </div>
            <div class="mb-3">
            <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" required>
            </div>
            <div class="mb-3">
            <input type="number" class="form-control" name="graduation_year" id="yearInput" placeholder="Graduation Year (Registration Only)">
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

            <div class="d-flex justify-content-center gap-3">
                <button type="submit" name="action" value="login" class="btn btn-outline-light rounded-0 px-5" style="font-family: 'Times New Roman', Times, serif;">Login</button>
                <button type="submit" name="action" value="register" class="btn btn-primary rounded-0 px-5" style="background-color: #1c233f; font-family: 'Times New Roman', Times, serif;">Join Now</button>
            </div>
        </form>
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