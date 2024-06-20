<?php
session_start();


$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "trucking";


$conn = new mysqli($servername, $db_username, $db_password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$Email = isset($_POST["email"]) ? $_POST["email"] : "";
$Password = isset($_POST["password"]) ? $_POST["password"] : "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($Email)) {
        echo "Email is required";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } elseif (empty($Password)) {
        echo "Password is required";
    } elseif (strlen($Password) < 8) {
        echo "Password must be at least 8 characters";
    } else {
        
        $Email = $conn->real_escape_string($Email);
        $stmt = $conn->prepare("SELECT id, password FROM signuptb WHERE email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            
            if (password_verify($Password, $hashed_password)) {
                $_SESSION['email'] = $Email;
            } else {
                echo "Invalid password";
            }
        } else {
            echo "Invalid email or password";
        }

        $stmt->close();
    }
}


function someUnusedFunction() {
    echo "This function is not used.";
}

function anotherUnusedFunction($param) {
    return $param;
}


header("Location: home.html");
exit;


echo "This will never be executed.";
?>
