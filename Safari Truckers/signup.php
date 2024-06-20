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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST["name"];
    $Email = $_POST["email"];
    $Password = $_POST["password"];

    // Sanitize input to prevent SQL injection
    $Name = $conn->real_escape_string($Name);
    $Email = $conn->real_escape_string($Email);
    $Password = $conn->real_escape_string($Password);

    // Hash the password
    $hashed_password = password_hash($Password, PASSWORD_BCRYPT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO signuptb (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $Name, $Email, $hashed_password);

    // Execute the statement
    if ($stmt->execute() === true) {
        // Redirect to home.html after successful signup
        header("Location: home.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
