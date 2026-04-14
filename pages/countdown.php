<?php
  $title = "F-Book – University of Florida";

  session_start();
  $grad_year = isset($_SESSION['graduation_year']) ? (int)$_SESSION['graduation_year'] : (int)date('Y') + 1;

  // DB connection
  $db = new mysqli("localhost", "root", "", "fbook_online");

  // Get total number of traditions available
  $total_traditions = 0;
  $res = $db->query("SELECT COUNT(*) as total FROM traditions");
  if ($res) {
    $total_traditions = (int)$res->fetch_assoc()['total'];
  }

  // Get number of traditions the logged-in user has completed
  $completed_count = 0;
  $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;
  if ($user_id > 0) {
    $stmt = $db->prepare("SELECT COUNT(comp_id) as completed FROM completion WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $completed_count = (int)$stmt->get_result()->fetch_assoc()['completed'];
    $stmt->close();
  }

  // Progress percentage (avoid divide-by-zero)
  $progress_pct = $total_traditions > 0 ? round(($completed_count / $total_traditions) * 100) : 0;
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

    <style>
        /* ── Countdown Section ── */
        .countdown-section {
            background: linear-gradient(135deg, #0021A5 0%, #1a3bc4 60%, #2a4fd4 100%);
            padding: 2.5rem 3rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 2rem;
            position: relative;
            overflow: hidden;
        }
        .countdown-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 80% 60% at 70% 50%, rgba(250,70,22,.18) 0%, transparent 70%);
            pointer-events: none;
        }
        .countdown-title {
            font-family: 'Merriweather', serif;
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.2;
            max-width: 240px;
        }
        .countdown-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .5rem;
        }
        .countdown-units {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .unit-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .3rem;
        }
        .unit-label {
            color: #fff;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .cd-digits {
            display: flex;
            gap: 5px;
        }
        .cd-digit {
            background: #0021A5;
            border: 2px solid rgba(255,255,255,.25);
            color: #fff;
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            font-weight: 700;
            width: 52px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 4px 14px rgba(0,0,0,.3);
        }
        .cd-digit.orange {
            background: #FA4616;
            border-color: rgba(255,255,255,.3);
        }
        .year-input-row {
            display: flex;
            align-items: center;
            gap: .7rem;
            margin-top: .4rem;
        }
        .year-input-row label {
            color: rgba(255,255,255,.85);
            font-size: .85rem;
            font-weight: 600;
        }
        .grad-year-input {
            background: rgba(255,255,255,.15);
            border: 2px solid rgba(255,255,255,.4);
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Source Sans 3', sans-serif;
            border-radius: 6px;
            padding: .3rem .7rem;
            width: 90px;
            text-align: center;
            outline: none;
            transition: border-color .2s;
        }
        .grad-year-input:focus { border-color: #fff; }
        .grad-year-input::placeholder { color: rgba(255,255,255,.5); }

        /* ── Fix navbar overlap ── */
        .main-content { padding-top: 70px; }

        /* ── Traditions Progress Bar ── */
        .progress-section {
            background: #fff;
            padding: 2rem 3rem;
            border-bottom: 1px solid #e0e0e0;
        }
        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: .75rem;
        }
        .progress-header h3 {
            font-family: 'Merriweather', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #0021A5;
        }
        .progress-header span {
            font-size: .9rem;
            font-weight: 600;
            color: #555;
        }
        .tradition-progress-bar {
            width: 100%;
            height: 22px;
            background: #e0e4f0;
            border-radius: 999px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,.08);
        }
        .tradition-progress-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #0021A5 0%, #FA4616 100%);
            transition: width 1s cubic-bezier(.4,0,.2,1);
            position: relative;
        }
        .tradition-progress-fill::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,.2) 0%, transparent 60%);
            border-radius: 999px;
        }
        .progress-subtext {
            margin-top: .5rem;
            font-size: .82rem;
            color: #777;
        }
    </style>
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

            <a class="btn sign-in-btn ms-3" href="login.php">Sign-In</a>
        </div>
    </nav>

    <main class="main-content">

        <!-- Countdown to Graduation -->
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

                <!-- graduation_year seeded from users table via PHP session -->
                <div class="year-input-row">
                    <label for="grad-year">Graduation Year:</label>
                    <input class="grad-year-input" type="number" id="grad-year"
                           value="<?php echo htmlspecialchars($grad_year); ?>"
                           min="2024" max="2035"/>
                </div>
            </div>
        </section>

        <!-- Traditions Progress Bar -->
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

            <div class="activity-card">
                <img src="../assets/chimes.png" alt="Listen to the Chimes of Century Tower">
                <p>Listen to the Chimes<br>of Century Tower</p>
            </div>

            <div class="activity-card">
                <img src="../assets/career_connections.jpg" alt="Career Connections">
                <p>Career Connections</p>
            </div>

            <div class="activity-card">
                <img src="../assets/lake_alice.jpeg" alt="Relax at Lake Alice">
                <p>Relax at Lake Alice</p>
            </div>

            <div class="activity-card">
                <img src="../assets/get_active.jpg" alt="Get Active">
                <p>Get Active</p>
            </div>

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
        // Activity carousel
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

        // Graduation countdown
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

            const input = document.getElementById('grad-year');
            updateCountdown(GRAD_YEAR_FROM_DB);
            input.addEventListener('input', () => updateCountdown(parseInt(input.value, 10)));
            setInterval(() => updateCountdown(parseInt(input.value, 10)), 60000);
        })();
    </script>
</body>
</html>