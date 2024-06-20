<?php
$servername = "localhost";
$db_username = "root"; 
$db_password = ""; 
$database = "trucking";

// Create a connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT truck_id, latitude, longitude, timestamp FROM truck_positions ORDER BY timestamp DESC";
$result = $conn->query($sql);

$positions = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $positions[] = $row;
    }
}

echo json_encode($positions);

$conn->close();
?>
