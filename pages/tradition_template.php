<?php
  session_start();
  $title = "Residence Page";
  
  $tradition_id = $_GET['tradition_id'] ?? 1;
  
  $db = new mysqli("localhost", "root", "", "fbook_online");
  
  $query = "SELECT tradition_name, tag_text, description, directions, thumbnail_url, requires_photo, requires_answer FROM traditions WHERE tradition_id = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("i", $tradition_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $tradition = $result->fetch_assoc();
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
	<body style="height: 100vh;">
        <nav class="navbar navbar-expand-lg uf-gradient px-3">
            <a class="navbar-brand" href="#">
                <img src="../assets/uf_logo.png" alt="UF Logo" style="height: 40px; width: auto;">
            </a>

            <div class="navbar-nav d-flex flex-row ms-auto">
                <div class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-white" href="../index.php" role="button">
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
                        <li><a class="dropdown-item" href="#">Events</a></li>
                    </ul>
                </div>
            </div>
        </nav>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


		<div class="paper-container" style="padding-left: 15%">
            <div class="row">
                <div class="col text-center">   
                    <h1 class="experience-heading">
                        <?php echo $tradition['tradition_name']; ?>
                        <span class="highlight-word"></span>
                    </h1>
                    
                </div>
        <div class="row w-100 p-3"> 
			<div class="col-md-6 text-column">
				<p><span class="highlight-word"><b><?php echo $tradition['tag_text']; ?></b> </span><?php echo $tradition['description']; ?></p>
				<p style="padding-top: 50px"><?php echo $tradition['directions']; ?></p>
				<form action="add_fbook.php" method="POST" enctype="multipart/form-data" class="mt-4 p-4 border rounded shadow-sm bg-light">
				

                <?php
                if ($tradition['requires_answer']) {
                    echo '<div class="mb-4">
					<textarea class="form-control" id="textFormAnswer" name="textForm" rows="2" placeholder="ex: , Albert, Alberta, ..."></textarea>
				</div>';
                }
                ?>

                <?php
                if ($tradition['requires_photo']) {
                    echo '<div class="mb-4">
					<input class="form-control" type="file" id="photoFormAnswer" name="photoForm" accept="image/*">
				</div>';
                }
                ?>

                <?php
                if (true) {
                    echo '<button type="submit" class="btn w-100 fw-bold text-white" style="background-color: #fe7d1a;">
					Add to My F-Book
				</button>';
                }
                ?>
			</form>
			</div>	
		
			<div class="col-md-6 image-column" style="padding-left: 150px">
                <div style="align-items: center; justify-content: center; flex-direction: column;">
                    <img src="<?php echo htmlspecialchars($tradition['thumbnail_url']); ?>" style="padding-bottom: 10px; padding-left: 30   px" alt="Tradition image" ...>
                    
                    <img src="../assets/residence_hall_placeholder_img.png" class="border border-secondary border-5" alt="UF Logo" style="height: 20%">
                </div>
			</div>
		</div>
        </div>
        </div>

        <footer class="dashboard-footer sticky-bottom w-100">
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
