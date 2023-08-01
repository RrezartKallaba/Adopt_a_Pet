<?php
if (isset($_SESSION["admin"])) {
    require "../validate/connect.php";
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <title>Document</title>
    </head>

    <body>
        <div class="container">
            <h2>Animal List</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Location</th>
                        <th>Size</th>
                        <th>Age</th>
                        <th>Vaccinated</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM animals";
                    $result = mysqli_query($connect, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                    <td>' . $row["name"] . '</td>
                    <td>' . $row["image"] . '</td>  
                    <td>' . $row["location"] . '</td>
                    <td>' . $row["size"] . '</td>
                    <td>' . $row["age"] . '</td>
                    <td>' . $row["vaccinated"] . '</td>
                    <td>' . $row["status"] . '</td>
                    <td>
                        <a href="?page=details_animal&animal_id=' . $row["animal_id"] . '" class="btn btn-info">Details</a>
                        <a href="?page=update_animal&animal_id=' . $row["animal_id"] . '" class="btn btn-info">Update</a>
                        <a href="delete_animal.php?animal_id=' . $row["animal_id"] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this menu item?\')">Delete</a>
                    </td>
                </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>

    </html>
<?php
} else if (isset($_SESSION["user"])) {
    header("location:../home.php");
} else {
    header("Location: ../login.php");
}
