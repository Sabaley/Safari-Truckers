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
    $truck_name = $_POST["truck_name"];
    $driver_name = $_POST["driver_name"];
    $driver_email = $_POST["driver_email"];

    // Sanitize input to prevent SQL injection
    $truck_name = $conn->real_escape_string($truck_name);
    $driver_name = $conn->real_escape_string($driver_name);
    $driver_email = $conn->real_escape_string($driver_email);

    // Insert driver into the drivers table
    $stmt = $conn->prepare("INSERT INTO drivers (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $driver_name, $driver_email);

    if ($stmt->execute() === true) {
        $driver_id = $stmt->insert_id;

        // Insert truck into the trucks table
        $stmt = $conn->prepare("INSERT INTO trucks (truck_name, driver_id) VALUES (?, ?)");
        $stmt->bind_param("si", $truck_name, $driver_id);

        if ($stmt->execute() === true) {
            echo "Truck and Driver registered successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
