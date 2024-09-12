<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Banuang Gurang Health Station</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="images/stethoscope.png">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body {
            background-color: white;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            margin-top: 20px;
        }
        .left-section {
            float: left;
            width: 45%;
            padding-right: 10px;
        }
        .right-section {
            float: right;
            width: 55%;
            padding-left: 10px;
        }
        .announcement-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            border: 5px solid black;
            height: 500px;
            margin-left: -70px;
        }
        .image-section {
            border-radius: 5px;
            margin-right: -70px;
        }
        .footer {
            background-color: #588157;
            color: white;
            text-align: right;
            padding: 3px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .contact-detail {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: larger;
            font-weight: bold;
        }
        .welcome-section {
            font-size: 20px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .announcements {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .slider-container {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
            overflow: hidden;
        }
        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            
        }
        .slide {
            min-width: 100%;
            
        }
        .slide img {
            width: 100%;
            height: 420px;
            border: 3px solid black;
        }
    </style>
</head>
<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #588157;">
        <div class="container">
            <a class="navbar-brand" href="#" style="font-weight: bold; font-size: 20px; margin-left: -70px">⚕️Banuang Gurang Health Station</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 15px; margin-right: -70px">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#" style="font-size: larger; font-weight: bold;">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="Dashboard.php" style="font-size: larger; font-weight: bold;">Dashboard</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: larger; font-weight: bold;">
                            <?php
                                session_start();
                                if (isset($_SESSION['employeeName'])) {
                                    echo $_SESSION['employeeName'];
                                } else {
                                    echo 'Guest';
                                }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="DisplayStaffs.php" style="font-size: 15px;">Staffs</a></li>
                            <li><a class="dropdown-item" href="PatientRecord.php" style="font-size: 15px;">Patient's Record</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="logout.php" style="font-size: 15px;">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container">
        <div class="left-section">
            <div class="announcement-section">
                <!-- Announcement templates go here -->
                <h2 class="announcements">Announcements</h2>
                <!-- Example of adding a photo in the announcement -->
                <div class="divider"></div>
                <div class="newsbox">
                    <div class="slider-container">
                        <div class="slider" id="slider">
                            <div class="slide">
                                <img src="images/R.jpg" alt="Image 1">
                            </div>
                            <div class="slide">
                                <img src="images/cover2.jpg" alt="Image 2">
                            </div>
                            <div class="slide">
                                <img src="images/cover3.png" alt="Image 3">
                            </div>
                            <div class="slide">
                                <img src="images/Bida.jpg" alt="Image 4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-section">
            <div class="image-section">
                <!-- Image goes here -->
                <img src="images/animation.png" alt="Image" style="width: 100%;" height="500px;">
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script>
        let slideIndex = 0;
        const slider = document.getElementById('slider');
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            slider.style.transform = 'translateX(' + (-index * 100) + '%)';
        }

        function nextSlide() {
            slideIndex = (slideIndex + 1) % totalSlides;
            showSlide(slideIndex);
        }

        function prevSlide() {
            slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
            showSlide(slideIndex);
        }

        // Auto slide
        setInterval(nextSlide, 3000);
    </script>
    <div class="footer">
        <div class="container">
             <p class="contact-detail">ADDRESS: Purok 4 Flores St. Banuang Gurang Donsol, Sorsogon Phillipines</p>
            <p class="contact-detail">CONTACT INFORMATION: bghealthstation@gmail.com | Phone: +639134567890</p>
        </div>
    </div>
</body>
</html>
