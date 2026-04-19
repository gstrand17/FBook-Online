<?php
  session_start();
  $title = "F-Book – University of Florida";

  $db = new mysqli("localhost", "root", "", "fbook_online");
  $traditions = [];
  $res = $db->query("SELECT tradition_name, thumbnail_url FROM traditions ORDER BY RAND() LIMIT 8");
  if ($res) {
    while ($row = $res->fetch_assoc()) {
      $traditions[] = $row;
    }
  }
  $db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/landing_page_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg uf-gradient px-3 py-2 fixed-top">
        <a class="navbar-brand" href="index.php">
            <img src="assets/uf_logo.png" alt="UF Logo">
        </a>

        <div class="navbar-nav d-flex flex-row ms-auto align-items-center">

            <div class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle fw-semibold" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Home
                </a>
            </div>

            <div class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    F-Book
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="pages/catalog.php">My F-Book</a></li>
                </ul> 
            </div>

            <div class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Achievements
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="pages/leaderboard.php">Leaderboard</a></li>
                    <li><a class="dropdown-item" href="pages/achievements.php">View Achievements</a></li> 
                </ul>
            </div>

            <div class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Connect
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Events</a></li>
                </ul>
            </div>

            <a class="btn sign-in-btn ms-3" href="pages/login.php">Sign-In</a>
        </div>
    </nav>

    <main class="main-content">

        <!-- Hero -->
        <section class="hero-section">
            <div class="hero-left">
                <h1>Be part of a<br>Community.</h1>
            </div>

            <div class="hero-right">
                <div class="hero-img large">
                    <img src="assets/community_crowd.png" alt="Community Crowd">
                </div>
                <div class="hero-img medium">
                    <img src="assets/science_lab.png" alt="Science Lab">
                </div>
                <div class="hero-img small">
                    <img src="assets/century_tower_vertical.png" alt="Century Tower">
                </div>
            </div>
        </section>

        <section class="activities-section">
            <button class="arrow-btn left-arrow" type="button" aria-label="Previous">
                <i class="fa-solid fa-circle-arrow-left"></i>
            </button>

            <?php foreach ($traditions as $t): ?>
                <div class="activity-card">
                    <img src="<?php echo htmlspecialchars($t['thumbnail_url']); ?>"
                        alt="<?php echo htmlspecialchars($t['tradition_name']); ?>">
                    <p><?php echo htmlspecialchars($t['tradition_name']); ?></p>
                </div>
            <?php endforeach; ?>

            <button class="arrow-btn right-arrow" type="button" aria-label="Next">
                <i class="fa-solid fa-circle-arrow-right"></i>
            </button>
        </section>

        <div class="gator-mark">
            <img src="assets/gator_head.png" alt="Gator Mark">
        </div>

    </main>

    <footer class="dashboard-footer">
        <div class="footer-left">
            <img src="assets/uf_logo_with_slogan.png" alt="UF Logo with Slogan">
        </div>

        <div class="footer-center">
            <p class="footer-heading">Contact</p>
            <p>(352) 392-1905</p>
            <p>UFALUM@UFALUMNI.UFL.EDU</p>
        </div>

        <div class="footer-right">
            <p class="footer-heading">Follow Us</p>
            <div class="social-icons">
                <a href="#" aria-label="X / Twitter">
                    <img src="assets/x_site_logo.png" alt="X Logo">
                </a>
                <a href="#" aria-label="Instagram">
                    <img src="assets/insta_logo.png" alt="Instagram Logo">
                </a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function () {
            const section  = document.querySelector('.activities-section');
            const cards    = Array.from(section.querySelectorAll('.activity-card'));
            const leftBtn  = section.querySelector('.left-arrow');
            const rightBtn = section.querySelector('.right-arrow');
            const visible  = 4;   
            let start = 0;	

            function render() {
                cards.forEach((c, i) => {
                    c.style.display = (i >= start && i < start + visible) ? 'flex' : 'none';
                });
            }

            leftBtn.addEventListener('click', () => {
                start = Math.max(0, start - 1);
                render();
            });

            rightBtn.addEventListener('click', () => {
                start = Math.min(cards.length - visible, start + 1);
                render();
            });

            render();
        })();
    </script>
</body>
</html>