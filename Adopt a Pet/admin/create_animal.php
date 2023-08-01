<?php
if (isset($_SESSION["admin"])) {
    require "../validate/connect.php";
    require "../file_upload.php";

    if (isset($_POST["create"])) {
        $name = $_POST["name"];
        $picture = fileUpload($_FILES["picture"]);
        $gender = $_POST["gender"];
        $location = $_POST["location"];
        $description = mysqli_real_escape_string($connect, $_POST["description"]);
        $size = $_POST["size"];
        $age = $_POST["age"];
        $vaccinated = $_POST["vaccinated"];
        $breed = $_POST["breed"];
        $category = $_POST["category"];

        $sql = "INSERT INTO animals (name, image, location, gender, description, size, age, vaccinated, breed, category)
        VALUES ('$name', '{$picture[0]}', '$location', '$gender', '$description', '$size', '$age', '$vaccinated', '$breed', '$category')";

        if (mysqli_query($connect, $sql)) {
            echo "<div class='alert alert-success' role='alert'>
        Product has been created, {$picture[1]}
      </div>";
            echo "<script>window . location . href = 'dashboard.php?page=animals'</script>";
            // header("refresh: 2; url=dashboard.php?page=animals");
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error found: " . mysqli_error($connect) . "</div>";
        }

        // Close the database connection
        mysqli_close($connect);
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Create New Product</title>
        <style>
            body {
                background-image: url("../img/bg-animals.jpg");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .input-column {
                flex: 1;
                padding: 0 5px;
            }

            .width-btn-2 {
                width: 170px !important;
                height: 50px !important;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .bg-color-1 {
                background-color: rgba(249, 249, 249, 0.6);
                /* Use rgba() to set opacity */
                border-radius: 5px;
                padding: 30px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 590px;
                width: 100%;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="bg-color-1">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="picture" class="form-label">Picture</label>
                            <input type="file" class="form-control" id="picture" name="picture">
                        </div>
                        <div class="col-md-4">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" class="form-control" id="size" name="size" required placeholder="1m and 10cm">
                        </div>
                        <div class="col-md-4">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" min="0" max="100" required>
                        </div>
                        <div class="col-md-4">
                            <label for="vaccinated" class="form-label">Vaccinated</label>
                            <select class="form-control" id="vaccinated" name="vaccinated" required>
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="breed" class="form-label">Breed</label>
                            <input type="text" class="form-control" id="breed" name="breed" required>
                        </div>
                        <div class="col-md-4">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="Cat" selected>Cat</option>
                                <option value="Dog">Dog</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div style="display: flex;justify-content: center;gap: 20px;" class="col-md-12 text-center">
                            <a href="dashboard.php?page=animals" class="btn btn-outline-info width-btn-2" style="background-color: #0dcaf0;color: black">Back</a>
                            <button name="create" type="submit" class="btn btn-primary width-btn-2">Create animal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>
<?php
} else if (isset($_SESSION["user"])) {
    header("location:../home.php");
} else {
    header("Location: ../login.php");
}
