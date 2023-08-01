<?php
if (!isset($_SESSION)) {
    session_start();
}
// Check user authentication
if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

require "validate/connect.php";

// Function to handle pet adoption
function adoptPet($user_id, $pet_id, $connect)
{
    $user_id = mysqli_real_escape_string($connect, $user_id);
    $pet_id = mysqli_real_escape_string($connect, $pet_id);

    // Check if the user has already adopted this pet
    $checkQuery = "SELECT COUNT(*) as count FROM pet_adoption WHERE user_id = $user_id AND pet_id = $pet_id";
    $checkResult = mysqli_query($connect, $checkQuery);
    $row = mysqli_fetch_assoc($checkResult);

    if ($row["count"] == 0) {
        // Insert a new adoption record
        $insertQuery = "INSERT INTO pet_adoption (user_id, pet_id, adoption_date) VALUES ($user_id, $pet_id, NOW())";
        if (mysqli_query($connect, $insertQuery)) {
            // Update the pet status to 'unavailable'
            $updateStatusQuery = "UPDATE animals SET status = 'Unavailable' WHERE animal_id = $pet_id";
            if (mysqli_query($connect, $updateStatusQuery)) {
                header("Location: home.php?pet_id=$pet_id");
                exit;
            } else {
                // Handle update status error
                echo "Error updating pet status: " . mysqli_error($connect);
                exit;
            }
        } else {
            // Handle adoption error
            echo "Error adopting the pet: " . mysqli_error($connect);
            exit;
        }
    } else {
        // User has already adopted this pet
        echo "You have already adopted this pet.";
        exit;
    }
}

// Handle the adoption request if pet_id is set
if (isset($_GET["pet_id"])) {
    $pet_id = $_GET["pet_id"];
    $user_id = $_SESSION["user"]; // Make sure $_SESSION["user"] contains the correct user_id value
    adoptPet($user_id, $pet_id, $connect);
} else {
    echo "Invalid request.";
    exit;
}
