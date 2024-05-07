<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location:index.php");
    exit(); // Stop further execution
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$db_name = "first_db";

// Create connection
$conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $time = strftime("%X"); // Time
    $date = strftime("%B %d, %Y"); // Date
    $decision = "no";

    // Check if the 'public' array is set and not empty
    if(isset($_POST['public']) && !empty($_POST['public'])) {
        foreach($_POST['public'] as &$each_check) { // Gets the data from the checkbox
            if($each_check != null) { // Checks if checkbox is checked
                $decision = "yes"; // Sets the value
                break; // Exit the loop once a checkbox is checked
            }
        }
    }

    mysqli_query($conn,"INSERT INTO list_tbl(details, date_posted, time_posted, public) VALUES ('$details','$date','$time','$decision')"); // SQL query
    header("location:home.php");
} else {
    header("location:home.php");
}
?>
