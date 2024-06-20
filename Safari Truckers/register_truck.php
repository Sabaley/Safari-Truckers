<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "trucking";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $truck_id = $_POST["truck_id"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    // Sanitize input to prevent SQL injection
    $truck_id = $conn->real_escape_string($truck_id);
    $latitude = $conn->real_escape_string($latitude);
    $longitude = $conn->real_escape_string($longitude);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO truck_positions (truck_id, latitude, longitude) VALUES (?, ?, ?)");
    $stmt->bind_param("sdd", $truck_id, $latitude, $longitude);

    // Execute the statement
    if ($stmt->execute() === true) {
        echo "Truck registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
