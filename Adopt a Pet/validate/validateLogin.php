<?php
session_start();
require "connect.php";


if (isset($_SESSION["admin"])) {
    header("Location: admin/dashboard.php");
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

$email = $passError = $emailError = "";
$error = false;

function cleanInputs($input)
{
    $data = trim($input); // removing extra spaces, tabs, newlines out of the string
    $data = strip_tags($data); // removing tags from the string
    $data = htmlspecialchars($data); // converting special characters to HTML entities, something like "<" and ">", it will be replaced by "&lt;" and "&gt";

    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = cleanInputs($_POST["email"]);
    $password = $_POST["password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // if the provided text is not a format of an email, error will be true
        $error = true;
        $emailError = "Please enter a valid email address";
    }

    // simple validation for the "password"
    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty!";
    }

    if (!$error) {
        $password = hash("sha256", $password);

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1) {
            if ($row["status"] == "user") {
                $_SESSION["user"] = $row["id"];
                header("Location: home.php");
            } else {
                $_SESSION["admin"] = $row["id"];
                header("Location: admin/dashboard.php");
            }
        } else {
            echo "<div class='alert alert-danger'>
                <p>Wrong credentials, please try again ...</p>
              </div>";
        }
    }
}
