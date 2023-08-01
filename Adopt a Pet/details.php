<?php
session_start();
if (isset($_SESSION["user"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Animal Details</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }

            .row {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container {
                padding-top: 20px;
            }

            .card-img-top {
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                height: 350px;
                width: 65%;
            }

            .card-body {
                padding: 20px;
            }

            .card-title {
                font-size: 24px;
                font-weight: bold;
                color: #333;
                text-align: left;
            }

            .card-text {
                font-size: 16px;
                text-align: left;
                color: #555;
                margin: 0 0 14px 0;
                /* line-height: 1.6; */
            }

            .btn-back {
                display: flex;
                justify-content: center;
                width: 90px;
                text-align: left;
                color: #fff;
                background-color: #0a5a6a;
                border: none;
                border-radius: 6px;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .btn-back:hover {
                background-color: #0e7490;
            }

            @media (max-width: 768px) {
                .row-row {
                    flex-direction: column !important;
                }
            }
        </style>
    </head>

    <body>
        <?php
        require "validate/connect.php";
        // Getting data from the database
        $id = $_GET["animal_id"];
        $sql = "SELECT * FROM animals WHERE animal_id=$id";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        mysqli_close($connect);
        ?>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <img src="pictures/<?php echo $row['image']; ?>" class="card-img-top" alt="Animal Image">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <br>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <div>
                            <p class="card-text"><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
                            <p class="card-text"><strong>Location:</strong> <?php echo $row['location']; ?></p>
                            <p class="card-text"><strong>Size:</strong> <?php echo $row['size']; ?></p>
                            <p class="card-text"><strong>Age:</strong> <?php echo $row['age']; ?></p>
                            <p class="card-text"><strong>Vaccinated:</strong> <?php echo $row['vaccinated']; ?></p>
                            <p class="card-text"><strong>Breed:</strong> <?php echo $row['breed']; ?></p>
                            <p class="card-text"><strong>Category:</strong> <?php echo $row['category']; ?></p>
                            <p class="card-text"><strong>Status:</strong> <?php echo $row['status']; ?></p>
                        </div>
                        <br>
                        <a style="text-decoration: none;" href="home.php" class="btn-back">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
}
?>