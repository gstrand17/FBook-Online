<?php
  $title = "Residence Page";
?>
<html>
	<head>
		<title><?php echo $title; ?></title>
		
		<link href="https://googleapis.com" rel="stylesheet">
		<link rel="stylesheet" href="../css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
		<link rel="stylesheet" href="../css/residence_page_style.css">
	</head>
	<body>
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
                <a class="btn btn-primary" href="#" role="button">Logout</a>
            </div>
        </nav>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/js.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


		<div class="paper-container">
        <div class="row">
            <div class="col text-center">
                <h1 class="experience-heading">
                    Experience
                    <span class="highlight-word">Life On Campus</span>
                </h1>
                
            </div>
        <div class="row w-100 p-3"> 
			<div class="col-md-6 text-column">
				<p><span class="highlight-word"><b>LIVING ON CAMPUS IS A GREAT WAY TO STAY CONNECTED</b> </span>to your Gator student experience. With 30 residence halls and villages, you are never far from all the action. 
				On-campus residents are also provided with innovative and fun programming throughout the year in addition to the many 
				leadership opportunities available through residence life.</p>
				<p style="padding-top: 50px">Upload a sketch of your room, and list out your roomates!</p>
				<form action="your_php_handler.php" method="POST" enctype="multipart/form-data" class="mt-4 p-4 border rounded shadow-sm bg-light">
				
				<div class="mb-4">
					<label for="roommateNames" class="form-label fw-bold" style="color: #0021A5;">List your roommates</label>
					<textarea class="form-control" id="roommateNames" name="roommates" rows="2" placeholder="ex: , Albert, Alberta, ..."></textarea>
				</div>

				<div class="mb-4">
					<label for="roomImage" class="form-label text-left	 fw-bold" style="color: #0021A5;">Upload your room sketch or photo</label>
					<input class="form-control" type="file" id="roomImage" name="room_image" accept="image/*">
				</div>

				<button type="submit" class="btn w-100 fw-bold text-white" style="background-color: #fe7d1a;">
					Add to My F-Book
				</button>
			</form>
			</div>	
		
			<div class="col-md-6 image-column">
				<img src="../assets/uf_residence_img.jpg" alt="UF Logo">
			</div>
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