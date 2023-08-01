<?php
if (isset($_SESSION["admin"])) {
    require "../validate/connect.php";
    require "../file_upload.php";

    $id = $_GET["animal_id"];
    $sql = "SELECT * FROM animals WHERE animal_id=$id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    if (!$result) {
        die("Error executing query: " . mysqli_error($connect));
    }


    if (isset($_POST["update"])) {
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
        $status = $_POST["status"];


        if ($_FILES["picture"]["error"] == 0) {
            /* checking if the picture name of the product is not product.png to remove it from pictures folder */
            if ($row["image"] != "user.png") {
                unlink("pictures/" . $row["image"]);
            }
            $sql = "UPDATE animals SET 
        name='$name', 
        image='{$picture[0]}', 
        gender='$gender',
        location='$location', 
        description='$description', 
        size='$size', 
        age='$age', 
        vaccinated='$vaccinated', 
        breed='$breed', 
        category='$category',
        status='$status' 
        WHERE animal_id=$id";
        } else {
            $sql = "UPDATE animals SET 
        name='$name', 
        gender='$gender',
        location='$location', 
        description='$description', 
        size='$size', 
        age='$age', 
        vaccinated='$vaccinated', 
        breed='$breed', 
        category='$category',
        status='$status' 
        WHERE animal_id=$id";
        }

        if (mysqli_query($connect, $sql)) {
            $delete_adoption_query = "DELETE FROM pet_adoption WHERE pet_id = $id";

            if (mysqli_query($connect, $delete_adoption_query)) {
                echo "<div class='alert alert-success' role='alert'>
                Product has been updated
              </div>";
                echo "<script>window . location . href = 'dashboard.php?page=animals'</script>";
                // header("refresh: 2; url= dashboard.php?page=animals");
            } else {
                echo "Gabim gjatë fshirjes së rreshtit nga tabela pet_adoption: " . mysqli_error($connect);
            }
        } else {
            echo "Error updating data: " . mysqli_error($connect);
        }

        mysqli_close($connect);
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Document</title>
        <style>
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;
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

            .col-md-12 {
                display: flex;
                justify-content: center;
                flex-direction: row !important;
                gap: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="picture" class="form-label">Picture</label>
                        <input type="file" class="form-control" id="picture" name="picture" value="<?php echo $row['image']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required value="<?php echo $row['location']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $row['description']; ?></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="Male" <?php if ($row['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($row['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="size" class="form-label">Size</label>
                        <input type="text" class="form-control" id="size" name="size" required placeholder="1m and 10cm" value="<?php echo $row['size']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" min="0" max="100" required value="<?php echo $row['age']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="vaccinated" class="form-label">Vaccinated</label>
                        <select class="form-control" id="vaccinated" name="vaccinated">
                            <option value="Yes" <?php if ($row['vaccinated'] === 'Yes') echo 'selected'; ?>>Yes</option>
                            <option value="No" <?php if ($row['vaccinated'] === 'No') echo 'selected'; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="breed" class="form-label">Breed</label>
                        <input type="text" class="form-control" id="breed" name="breed" required value="<?php echo $row['breed']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="Cat" <?php if ($row['category'] === 'Cat') echo 'selected'; ?>>Cat</option>
                            <option value="Dog" <?php if ($row['category'] === 'Dog') echo 'selected'; ?>>Dog</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Available" <?php if ($row['status'] === 'Available') echo 'selected'; ?>>Available</option>
                            <option value="Unavailable" <?php if ($row['status'] === 'Unavailable') echo 'selected'; ?>>Unavailable</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div style="display: flex;justify-content: center;gap: 20px;" class="col-md-12 text-center">
                        <a href="dashboard.php?page=animals" class="btn btn-outline-info width-btn-2" style="background-color: #0dcaf0;color: black">Back</a>
                        <button name="update" type="submit" class="btn btn-primary width-btn-2">Update Data</button>
                    </div>
                </div>
            </form>
        </div>
    </body>

    </html>
    </body>

    </html>
<?php
} else if (isset($_SESSION["user"])) {
    header("location:../home.php");
} else {
    header("Location: ../login.php");
}
