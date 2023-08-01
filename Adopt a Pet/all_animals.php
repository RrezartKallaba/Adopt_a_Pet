<?php

if (isset($_SESSION["user"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Books</title>
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
        </style>
    </head>

    <body>
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
            <?php
            require "validate/connect.php";
            $sql = "SELECT * FROM animals";

            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $pet_id = $row['animal_id'];
                    $checkQuery = "SELECT COUNT(*) as count FROM pet_adoption WHERE pet_id = $pet_id";
                    $checkResult = mysqli_query($connect, $checkQuery);
                    $checkRow = mysqli_fetch_assoc($checkResult);
                    $isAdopted = $checkRow["count"] > 0;
            ?>
                    <div class='col'>
                        <div class='card d-flex flex-column'>
                            <img src='pictures/<?php echo $row["image"]; ?>' class='card-img-top' alt='Animal Photo'>
                            <h5 style='height: 48px;' class='card-title'><?php echo $row["name"]; ?></h5>
                            <div class='card-body'>
                                <p class='card-text'>Breed: <?php echo $row["breed"]; ?></p>
                                <p class='card-text'>Age: <?php echo $row["age"]; ?> years</p>
                                <p class='card-text'>Size: <?php echo $row["size"]; ?></p>
                                <p class='card-text'>Vaccinated: <?php echo $row["vaccinated"]; ?></p>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <a href='details.php?animal_id=<?php echo $row["animal_id"]; ?>' class='btn btn-primary btn-block'>Details</a>
                                    </div>
                                    <div class='col-md-6'>
                                        <?php
                                        // Check if the animal has been adopted by the user
                                        if ($checkRow["count"] > 0) {
                                            // Animal has been adopted
                                            echo "<button type='button' class='btn btn-primary btn-block' disabled>Adopted</button>";
                                        } else {
                                            // Animal is available for adoption
                                            echo "<button type='button' onclick='confirmAdoption({$row["animal_id"]})' class='btn btn-primary btn-block'>Take me</button>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No results found</p>";
            }
            mysqli_close($connect);
            ?>


            <script>
                function confirmAdoption(animal_id) {
                    if (window.confirm("Are you sure you want to adopt this pet?")) {
                        window.location.href = "animal_adoption.php?pet_id=" + animal_id;
                    } else {
                        // Do nothing
                    }
                }
            </script>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    header("Location: ../login.php");
}
?>