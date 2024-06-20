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

$sql = "SELECT t.truck_id, t.truck_name, d.name AS driver_name, d.email AS driver_email, t.latitude, t.longitude 
        FROM trucks t 
        JOIN drivers d ON t.driver_id = d.driver_id";
$result = $conn->query($sql);

$trucks_with_drivers = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $trucks_with_drivers[] = $row;
    }
}

echo json_encode($trucks_with_drivers);

$conn->close();
?>
