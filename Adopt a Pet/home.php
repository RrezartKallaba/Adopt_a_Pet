<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["user"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pets</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <style>
            .card-img-top {
                width: 100%;
                height: 230px;
                /* object-fit: cover; */
            }

            .col {
                margin-bottom: 30px;
            }

            .navbar {
                padding-left: 5px;
            }

            .navbar-brand {
                padding-left: 5px;
            }

            .navbar-nav {
                justify-content: center;
            }

            .navbar-nav .nav-link {
                margin: 0 10px;
            }

            .carouselExampleControlsNoTouching {
                height: 100vh !important;
                position: relative;
            }

            .carousel-item img {
                height: 90vh !important;
            }

            nav {
                height: 57px;
            }

            .card {
                border: 1px solid #ccc;
                border-radius: 5px;
                /* padding: 5px; */
                margin-bottom: 20px;
                background-color: #f7f7f7;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .card-title {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 5px;
                height: 48px !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                background-color: #F04D24;
                color: white;
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .card-text {
                font-size: 14px;
                color: #3b3b3b;
            }

            .btn-primary {
                background-color: #007bff;
                color: #fff;
                border: none;
            }

            .btn-primary:hover {
                background-color: #0056b3;
                color: #fff;
            }

            .btn-block {
                width: 100%;
            }

            .active-page {
                border-bottom: 2px solid white;
            }

            .photo-center-flex {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .bg-dark {
                background-color: #102030 !important;
            }

            .btn {
                width: 110px;
                height: 40px;
                border: 1.5px solid #F04D24 !important;
                background-color: white;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                color: #3b3b3b;
            }

            .btn:hover {
                background-color: #F04D24;
                color: white;
            }

            .width-btn-2 {
                width: 170px !important;
                height: 45px !important;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .buttons-1 {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 15px;
                margin: 20px;
            }

            .btn.active {
                background-color: #F04D24 !important;
                color: white !important;
            }
        </style>
    </head>

    <body>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark  fixed-top">
            <a class="navbar-brand" href="#">Adopt a Pet</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex">
                    <li class="nav-item active active-page">
                        <a class="nav-link" href="home.php">Pets</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        require "validate/connect.php";
                        $user_id = $_SESSION["user"];
                        $query = "SELECT first_name, last_name, image FROM users WHERE id = $user_id";
                        $result1 = mysqli_query($connect, $query);

                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            $profile_image = $row1['image']; // Assuming the image file path is stored in the "image" column
                            echo '<a class="nav-link"><img src="pictures/' . $profile_image . '" alt="Profile Picture" class="rounded-circle" style="width: 30px; height: 30px;"></a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        require "validate/connect.php";
                        $user_id = $_SESSION["user"];
                        $query = "SELECT first_name, last_name, image FROM users WHERE id = $user_id";
                        $result1 = mysqli_query($connect, $query);

                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            $full_name = $row1['first_name'] . ' ' . $row1['last_name'];
                            $profile_image = $row1['image']; // Assuming the image file path is stored in the "image" column
                            echo "<a class='nav-link' href='#'>$full_name</a>";
                        }
                        ?>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" onclick="konfirmoDaljen()">Logout</a>
                    </li>
                    <script>
                        function konfirmoDaljen() {
                            if (window.confirm("Are you sure you want to logout?")) {
                                window.location.href = "logout.php";
                            } else {
                                // Do nothing
                            }
                        }
                    </script>

                </ul>
            </div>
        </nav>
        <div class="container mt-5">
            <!-- <h3 style="text-align: center;" class="mt-5">Animal List</h3> -->
            <br>
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'users';
            function isActive($currentPage, $pageName)
            {
                if ($currentPage === $pageName) {
                    echo ' active';
                }
            }
            ?>
            <div class="buttons-1">
                <a class="btn btn-primary width-btn-2<?php isActive($page, 'senior'); ?>" href="?page=senior">Show Seniors</a>
                <a class="btn btn-primary width-btn-2<?php isActive($page, 'all_animals'); ?>" href="?page=all_animals">Show All</a>
            </div>

            <?php
            if ($page === 'all_animlas') {
                include "all_animals.php";
            } else if ($page === 'senior') {
                include "senior.php";
            } else {
                include "all_animals.php";
            }
            ?>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["user"])) {
    header("location:../../home.php");
} else {
    header("Location: ../login.php");
}
?>
