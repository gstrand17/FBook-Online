<?php
  $title = "Leaderboard";
  $db = new mysqli("localhost", "root", "", "fbook_online");

  $query = "SELECT u.name, u.graduation_year, COUNT(c.comp_id) as completion_count 
            FROM users u 
            JOIN completion c ON u.user_id = c.user_id 
            GROUP BY u.user_id, u.name 
            ORDER BY completion_count DESC 
            LIMIT 5";
  
  $result = $db->query($query);
  $top_students = $result->fetch_all(MYSQLI_ASSOC);

  $query = "SELECT u.graduation_year, COUNT(c.comp_id) as total_completions
            FROM users u
            JOIN completion c ON u.user_id = c.user_id
            GROUP BY u.graduation_year
            ORDER BY total_completions DESC
            LIMIT 3;";
   $result = $db->query($query);
   $top_years = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
        <link href="https://googleapis.com" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>   
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/leaderboard.css">
        <link rel="stylesheet" href="../css/catalog.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
	</head>
	<body style="background-color: #ffffff">
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

        <div class="col text-center">
            <h1 style="font-family: 'Lobster', cursive !important; padding: 20px; color: #0021A5; font-size: 84px">
                F-Book Leaderboard
            </h1>
            <p class="catalog-subtitle">Discover who the most dedicated Gators are! Check out the top-ranked students and see which class is leading in campus participation.</p>
        </div>

        <div class="container my-5">
            <div class="row g-4">
                
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4" style="background-color: #f3e7cd;">
                        <div class="card-body p-4">
                            <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #0021A5; font-size: 3rem;">Overall Student Leaderboard</h2>
                            
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover align-middle text-center">
                                    <thead style="border-bottom: 2px solid #0021A5; color: #0021A5;">
                                        <tr>
                                            <th scope="col">Rank</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Class Year</th>
                                            <th scope="col">Total Events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($top_students as $index => $student) {
                                                echo "<tr>";
                                                $rank = $index + 1;
                                                $name = $student['name'];
                                                $graduation_year = $student['graduation_year'];
                                                $count = $student['completion_count'];
                                                
                                                echo "<td class=\"fs-5 fw-bold\">$rank</td>";
                                                echo "<td class=\"fw-bold\">$name</td>";
                                                echo "<td>$graduation_year</td>";
                                                echo "<td class=\"fs-5 fw-bold\">$count</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4" style="background-color: #f3e7cd;">
                        <div class="card-body p-4">
                            <h2 class="text-center mb-4" style="font-family: 'Lobster', cursive; color: #0021A5; font-size: 3rem;">Class Standings</h2>
                                <div style="font-family: 'Lora', serif;">

                                    <?php
                                    foreach ($top_years as $index => $year) {
                                        $rank = $index + 1;
                                        $graduation_year = $year['graduation_year'];
                                        $total_completions = $year['total_completions'];
                                        
                                        echo "<div class=\"mb-3\">";
                                        echo "<div class=\"d-flex justify-content-between mb-1\">";
                                        echo "<span><strong>$graduation_year</strong></span>";
                                        echo "<span class=\"fw-bold\">$total_completions</span>";
                                        echo "</div>";
                                        echo "</div>";
                                        }
                                        ?>
                                </div>
                                
                                <p class="text-center text-muted small mt-2">Total Events Completed</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <footer class="dashboard-footer fixed-bottom w-100">
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