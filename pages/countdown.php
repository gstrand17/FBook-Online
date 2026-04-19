<?php
  $title = "F-Book – University of Florida";

  session_start();

  $db = new mysqli("localhost", "root", "", "fbook_online");

  $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

  $grad_year = null;
  if ($user_id > 0) {
    $stmt = $db->prepare("SELECT graduation_year FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $grad_year = $row && $row['graduation_year'] ? (int)$row['graduation_year'] : null;
    $stmt->close();
  }

//   if ($grad_year === null) {
//     die("<p style='color:red;padding:2rem;font-family:sans-serif;'>Error: No graduation year found for your account. Please update your profile.</p>");
//   }

  $total_traditions = 0;
  $res = $db->query("SELECT COUNT(*) as total FROM traditions");
  if ($res) {
    $total_traditions = (int)$res->fetch_assoc()['total'];
  }

  $completed_count = 0;
  if ($user_id > 0) {
    $stmt = $db->prepare("SELECT COUNT(comp_id) as completed FROM completion WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $completed_count = (int)$stmt->get_result()->fetch_assoc()['completed'];
    $stmt->close();
  }

  $progress_pct = $total_traditions > 0 ? round(($completed_count / $total_traditions) * 100) : 0;

  // Fetch 8 random traditions for the carousel
  $traditions = [];
  $res = $db->query("SELECT tradition_name, thumbnail_url FROM traditions ORDER BY RAND() LIMIT 8");
  if ($res) {
    while ($row = $res->fetch_assoc()) {
      $traditions[] = $row;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/landing_page_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/countdown_page.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg uf-gradient px-3 py-2 fixed-top">
        <a class="navbar-brand" href="../index.php">
            <img src="../assets/uf_logo.png" alt="UF Logo">
        </a>

        <div class="navbar-nav d-flex flex-row ms-auto align-items-center">

            <div class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle fw-semibold" href="../index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Home
                </a>
            </div>

            <div class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <li><a class="dropdown-item" href="#">Events</a></li>
                </ul>
            </div>

            <a class="btn sign-in-btn ms-3" href="logout.php">Sign-Out</a>
        </div>
    </nav>

    <main class="main-content">
        <section class="countdown-section">
            <h2 class="countdown-title">Countdown to Graduation</h2>

            <div class="countdown-block">
                <div class="countdown-units">
                    <div class="unit-group">
                        <div class="cd-digits">
                            <div class="cd-digit" id="m0">0</div>
                            <div class="cd-digit orange" id="m1">0</div>
                        </div>
                        <span class="unit-label">Months</span>
                    </div>
                    <div class="unit-group">
                        <div class="cd-digits">
                            <div class="cd-digit" id="d0">0</div>
                            <div class="cd-digit orange" id="d1">0</div>
                        </div>
                        <span class="unit-label">Days</span>
                    </div>
                    <div class="unit-group">
                        <div class="cd-digits">
                            <div class="cd-digit" id="h0">0</div>
                            <div class="cd-digit orange" id="h1">0</div>
                        </div>
                        <span class="unit-label">Hours</span>
                    </div>
                </div>

                <div class="year-input-row">
                    <label>Graduation Year: <strong style="color:#fff;"><?php echo $grad_year; ?></strong></label>
                </div>
            </div>
        </section>

        <section class="progress-section">
            <div class="progress-header">
                <h3>Traditions Progress</h3>
                <span><?php echo $completed_count; ?> / <?php echo $total_traditions; ?> completed</span>
            </div>
            <div class="tradition-progress-bar">
                <div class="tradition-progress-fill" style="width: <?php echo $progress_pct; ?>%"></div>
            </div>
            <p class="progress-subtext">
                <?php if ($progress_pct >= 100): ?>
                    🎉 You've completed all UF traditions — congratulations!
                <?php elseif ($progress_pct >= 50): ?>
                    You're more than halfway there! Keep it up, Gator.
                <?php elseif ($progress_pct > 0): ?>
                    You've completed <?php echo $progress_pct; ?>% of UF traditions. Keep exploring!
                <?php else: ?>
                    Start completing traditions to track your progress here.
                <?php endif; ?>
            </p>
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
            <img src="../assets/gator_head.png" alt="Gator Mark">
        </div>

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
                <a href="#" aria-label="X / Twitter">
                    <img src="../assets/x_site_logo.png" alt="X Logo">
                </a>
                <a href="#" aria-label="Instagram">
                    <img src="../assets/insta_logo.png" alt="Instagram Logo">
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

        (function () {
            const GRAD_YEAR_FROM_DB = <?php echo (int)$grad_year; ?>;

            function getGraduationDate(year) {
                // First Saturday of May at 10:00 AM (typical UF ceremony)
                const d = new Date(year, 4, 1, 10, 0, 0);
                const daysUntilSat = (6 - d.getDay() + 7) % 7;
                d.setDate(d.getDate() + daysUntilSat);
                return d;
            }

            function setDigits(id0, id1, value) {
                const s = String(Math.max(0, Math.floor(value))).padStart(2, '0').slice(-2);
                document.getElementById(id0).textContent = s[0];
                document.getElementById(id1).textContent = s[1];
            }

            function updateCountdown(year) {
                if (!year || year < 2024 || year > 2035) {
                    ['m0','m1','d0','d1','h0','h1'].forEach(id => document.getElementById(id).textContent = '0');
                    return;
                }
                const diff = getGraduationDate(year) - new Date();
                if (diff <= 0) {
                    ['m0','m1','d0','d1','h0','h1'].forEach(id => document.getElementById(id).textContent = '0');
                    return;
                }
                const totalDays = Math.floor(diff / 864e5);
                setDigits('m0', 'm1', Math.floor(totalDays / 30.44));
                setDigits('d0', 'd1', totalDays % 30);
                setDigits('h0', 'h1', Math.floor((diff / 36e5) % 24));
            }

            updateCountdown(GRAD_YEAR_FROM_DB);
            setInterval(() => updateCountdown(GRAD_YEAR_FROM_DB), 60000);
        })();
    </script>
</body>
</html>