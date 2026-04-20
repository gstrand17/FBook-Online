<?php
    $title = "Fbook";
    session_start();

    $conn = new mysqli("localhost", "root", "", "fbook_online");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'] ?? 0;

    $sql = "
        SELECT 
            t.tradition_id,
            t.tradition_name,
            t.tag_text AS tagline,
            MAX(p.file_path) AS file_path,
            CASE 
                WHEN c.comp_id IS NOT NULL THEN 1
                ELSE 0
            END AS completed

        FROM traditions t

        LEFT JOIN completion c 
            ON c.tradition_id = t.tradition_id 
            AND c.user_id = ?

        LEFT JOIN photos p 
            ON p.completion_id = c.comp_id

        GROUP BY t.tradition_id

        ORDER BY t.fbook_pagenum
        ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $traditions = [];
    while ($row = $result->fetch_assoc()) {
        $traditions[] = $row;
    }
?>

<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/catalog.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
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
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Connect
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="https://connect.ufalumni.ufl.edu/students/home">STAT Website</a></li>
                        <li><a class="dropdown-item" href="https://connect.ufalumni.ufl.edu/students/events/calendar">Upcoming Events</a></li>
                    </ul>
                </div>
                <a class="btn btn-primary" href="#" role="button">Logout</a>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        

        <div class="page-container">

            <div class="content-wrap">

                <div class="container catalog-header">

                    <div class="text-center">
                        <h1 class="catalog-title"><b>My F-Book</b></h1>
                        <p class="catalog-subtitle">Explore all 57 UF traditions</p>
                    </div>

                </div>


                <div class="container mt-4 mb-5">

            <div class="row g-4">

                <?php foreach ($traditions as $tradition): ?>

                <div class="col-md-4 col-lg-3">
                    
                    <a href="tradition_template.php?tradition_id=<?php echo $tradition['tradition_id']; ?>" 
                    class="text-decoration-none">

                        <div class="card tradition-card position-relative">

                            <img 
                                src="<?php echo $tradition['file_path'] ?? 'images/default.jpg'; ?>" 
                                class="tradition-img"
                            >

                            <div class="checkbox-overlay">
                                <input 
                                    type="checkbox"
                                    <?php echo $tradition['completed'] ? 'checked' : ''; ?>
                                    disabled
                                >
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $tradition['tradition_name']; ?>
                                </h5>

                                <p class="tagline">
                                    <?php echo $tradition['tagline']; ?>
                                </p>
                            </div>

                        </div>
                    </a>

                </div>

                <?php endforeach; ?>

                </div>

            </div>

        </div>

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

        </div>
	</body>
</html>