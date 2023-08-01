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
            <h2>Users List</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($connect, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                    <td>' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                    <td>' . $row["email"] . '</td>  
                    <td>' . $row["address"] . '</td>
                    <td>' . $row["status"] . '</td>
                    <td>
                        <a href="?page=details_users&id=' . $row["id"] . '" class="btn btn-info">Details</a>
                        <a href="?page=update_users&id=' . $row["id"] . '" class="btn btn-info">Update</a>
                        <a href="delete_user.php?id=' . $row["id"] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this menu item?\')">Delete</a>
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
