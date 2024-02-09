<?php
session_start();

$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$database_name = 'web';

$conn = new mysqli($servername, $dbUsername, $dbPassword, $database_name);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    exit; 
}

if (isset($_POST['login'])) { 
    $username = $_POST['username'];
    $pass = $_POST['pass']; 
    // Using prepared statement
    $stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($pass, $user['pass'])) {
            
                $_SESSION['username'] = $username;
                header("Location: index.php"); 

                exit();
            } else {
                echo "<script>alert('Wrong Password'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Wrong Username'); window.location.href='index.php';</script>";
        }
    } else {
        // Query failed to execute
        echo "<script>alert('Login failed, please try again later.'); window.location.href='login.php';</script>";
    }
    $stmt->close();
}


?>
