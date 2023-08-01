<?php
if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
}
if (!isset($_SESSION["user"])) {
    header("Location: ../login.php");
}
if (!isset($_SESSION["admin"])) {
    header("Location: ../login.php");
}
require "../validate/connect.php";

$id = $_GET["animal_id"];
$sql = "SELECT * FROM animals WHERE animal_id = $id";
$result = mysqli_query($connect, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row["image"] != "user.png") {
        unlink("../pictures/" . $row["image"]);
    }

    $delete = "DELETE FROM animals WHERE animal_id = $id";
    if (mysqli_query($connect, $delete)) {
        header("Location: dashboard.php?page=animals");
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    echo "Record not found";
}
mysqli_close($connect);
