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

$sql = "SELECT truck_id, latitude, longitude FROM truck_positions";
$result = $conn->query($sql);

$truck_positions = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $truck_positions[] = $row;
    }
}

echo json_encode($truck_positions);

$conn->close();
?>
