<?php
  $title = "achievements";
  session_start();

  $conn = new mysqli("localhost", "root", "", "fbook_online");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
  $user_id = $_SESSION['user_id'] ?? 0;
  $achievements = [
    [
        "id" => 1,
        "name" => "Orange Tradition Keeper",
        "type" => "count",
        "requirement" => 10,
        "image1" => "../assets/badges/ach1.png",
        "image2" => "../assets/badges/ach1b.png",
        "description" => "Complete any 10 Traditions!"
    ],
    [
        "id" => 2,
        "name" => "Blue Tradition Keeper",
        "type" => "count",
        "requirement" => 20,
        "image1" => "../assets/badges/ach2.png",
        "image2" => "../assets/badges/ach2b.png",
        "description" => "Complete any 20 Traditions!"
    ],
    [
        "id" => 3,
        "name" => "Silver Tradition Keeper",
        "type" => "count",
        "requirement" => 30,
        "image1" => "../assets/badges/ach3.png",
        "image2" => "../assets/badges/ach3b.png",
        "description" => "Complete any 30 Traditions!"
    ],
    [
        "id" => 4,
        "name" => "Gold Tradition Keeper",
        "type" => "count",
        "requirement" => 40,
        "image1" => "../assets/badges/ach4.png",
        "image2" => "../assets/badges/ach4b.png",
        "description" => "Complete any 40 Traditions!"
    ],
    [
        "id" => 5,
        "name" => "Go Getter Gator",
        "type" => "specific",
        "chapter" => "GET STARTED, GATORS!",
        "image1" => "../assets/badges/ach5.png",
        "image2" => "../assets/badges/ach5b.png",
        "description" => "Complete all Traditions in the Get Started Gators chapter: 
        Attend Preview, Join the Gator Nation, Get Your Class Shirt, Be in the Class Photo, 
        Enjoy Good Times and Great Events, Experience Life on Campus, and Look Up & Around."
    ],
    [
        "id" => 6,
        "name" => "Campus Photo Model",
        "type" => "specific",
        "chapter" => "CAMPUS TOUR PHOTO OPS",
        "image1" => "../assets/badges/ach6.png",
        "image2" => "../assets/badges/ach6b.png",
        "description" => "Complete all Traditions in the Campus Tour Photo Ops Chapter: 
        Catch Up at The Fries, Strike a Pose with Albert and Alberta, Heisman with the Heisman, 
        Chomp with the Bull Gator, Rub Murphree's Shoe for Luck, Walk Under the Arch, and 
        What's That Called?" 
        ],
        [
        "id" => 7,
        "name" => "Campus Insider",
        "type" => "specific",
        "chapter" => "THE CAMPUS INSIDER",
        "image1" => "../assets/badges/ach7.png",
        "image2" => "../assets/badges/ach7b.png",
        "description" => "Complete all Traditions in the Campus Insider Chapter: 
        Get the Reitz Stuff, Eat Like a Gator, Work Hard Play Hard, Be Well, 
        Connect Toward Your Career, and Travel the World." 
        ],
        [
        "id" => 8,
        "name" => "Green Gator",
        "type" => "specific",
        "chapter" => "GATOR GREEN SPOTS",
        "image1" => "../assets/badges/ach8.png",
        "image2" => "../assets/badges/ach8b.png",
        "description" => "Complete all Traditions in the Green Gator Spots Chapter: 
        Find your Campus Oasis, Relax at Lake Alice, Watch the Bats Fly, 
        Unwind on the Plaza, and Play Outside." 
        ],
        [
        "id" => 9,
        "name" => "Cultured Gator",
        "type" => "specific",
        "chapter" => "CULTURE ON CAMPUS",
        "image1" => "../assets/badges/ach9.png",
        "image2" => "../assets/badges/ach9b.png",
        "description" => "Complete all Traditions in the Culture on Campus Chapter: 
        Listen to the Chimes of Century Tower, Visit the University Auditorium, 
        Visit the National Pan-Hellenic Council Garden, and Explore the Cultural Plaza." 
        ],
        [
        "id" => 10,
        "name" => "Involved Gator",
        "type" => "specific",
        "chapter" => "GET INVOLVED, GATORS!",
        "image1" => "../assets/badges/ach10.png",
        "image2" => "../assets/badges/ach10b.png",
        "description" => "Complete all Traditions in the Get Involved Gators Chapter: 
        Take in Turlington Plaza, Attend UF Family Weekend, Vote in a Student Government Election, 
        Read the Independent Florida Alligator, Join a Student Organization, and Mr. Two Bits." 
        ],
        [
        "id" => 11,
        "name" => "Gameday Victor",
        "type" => "specific",
        "chapter" => "GAMEDAYS + HOMECOMING",
        "image1" => "../assets/badges/ach11.png",
        "image2" => "../assets/badges/ach11b.png",
        "description" => "Complete all Traditions in the Gamedays + Homecoming Chapter: 
        Get Your Gator Nation BEAT Tee, Tailgate with Fellow Gator, Won't Back Down, 
        Cheer on Gator Sports, Get Rowdy in the O'Dome, Cebebrate Homecoming Weekend, 
        and Growl with the Gators." 
        ],
        [
        "id" => 12,
        "name" => "Gainesville Explorer",
        "type" => "specific",
        "chapter" => "EXPLORE GAINESVILLE",
        "image1" => "../assets/badges/ach12.png",
        "image2" => "../assets/badges/ach12b.png",
        "description" => "Complete all Traditions in the Explore Gainesville Chapter: 
        Go Beyond Campus, Picnic in the Parks, and Paint the 34th St. Wall." 
        ],
        [
        "id" => 13,
        "name" => "Giving Gator",
        "type" => "specific",
        "chapter" => "GATORS GIVEBACK",
        "image1" => "../assets/badges/ach13.png",
        "image2" => "../assets/badges/ach13b.png",
        "description" => "Complete all Traditions in the Gators Give Back Chapter: 
        Do Some Gator Good, Dance Dance Dance, Stand Up & Holler, and Be a Grateful Gator." 
        ],
        [
        "id" => 14,
        "name" => "Alumni Status",
        "type" => "specific",
        "chapter" => "FROM STUDENTS TO ALUMNI",
        "image1" => "../assets/badges/ach11.png",
        "image2" => "../assets/badges/ach11b.png",
        "description" => "Complete all Traditions in the Gamedays + Homecoming Chapter: 
        Show Off Your Gator Wrap Ring, Attend Senior Sendoff, Say Cheers, Celebrate Your Graduation, and Join the Alumni Association." 
        ]
    ];
    $sql = "
        SELECT t.tradition_id, t.category
        FROM completion c
        JOIN traditions t ON c.tradition_id = t.tradition_id
        WHERE c.user_id = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $userCompleted = [];
    $userCompletedByCategory = [];

    while ($row = $result->fetch_assoc()) {
        $userCompleted[] = $row['tradition_id'];

        $cat = $row['category'];
        if (!isset($userCompletedByCategory[$cat])) {
            $userCompletedByCategory[$cat] = 0;
        }
        $userCompletedByCategory[$cat]++;
    }

    $totalCompleted = count($userCompleted);

    $sql2 = "
    SELECT category, COUNT(*) as total
    FROM traditions
    GROUP BY category
    ";

    $result2 = $conn->query($sql2);

    $chapterTotals = [];

    while ($row = $result2->fetch_assoc()) {
        $chapterTotals[$row['category']] = $row['total'];
    }

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
                        <li><a class="dropdown-item" href="../assets/badges/achievements.php">View Achievements</a></li> 
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
            <div class="container py-4">
            <div class="row">

            <?php foreach ($achievements as $ach): ?>

            <?php
            $unlocked = false;

            // COUNT achievements
            if ($ach["type"] === "count") {
                if ($totalCompleted >= $ach["requirement"]) {
                    $unlocked = true;
                }
            }

            // CHAPTER achievements
            if ($ach["type"] === "specific") {
                $chapter = $ach["chapter"];

                $userCount = $userCompletedByCategory[$chapter] ?? 0;
                $totalNeeded = $chapterTotals[$chapter] ?? 0;

                if ($totalNeeded > 0 && $userCount == $totalNeeded) {
                    $unlocked = true;
                }
            }

            $image = $unlocked ? $ach["image2"] : $ach["image1"];
            ?>

            <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-3">
                <img src="../assets/<?php echo $image; ?>" class="card-img-top">

                <div class="card-body">
                <h5><?php echo $ach["name"]; ?></h5>
                <p><?php echo $ach["description"]; ?></p>

                <?php if ($ach["type"] === "specific"): ?>
                    <small>
                    <?php echo ($userCompletedByCategory[$ach["chapter"]] ?? 0); ?>
                    /
                    <?php echo ($chapterTotals[$ach["chapter"]] ?? 0); ?>
                    completed
                    </small>
                <?php endif; ?>

                <br>

                <?php if ($unlocked): ?>
                    <span class="badge bg-success">Unlocked</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Locked</span>
                <?php endif; ?>
                </div>
            </div>
            </div>

            <?php endforeach; ?>

            </div>
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