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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']); 
    $query = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username'");

    if ($result = mysqli_fetch_assoc($query)) {
        $res_pass = $result['pass']; 

        if (password_verify($pass, $res_pass)) {
            $_SESSION['username'] = $username;
            header("Location: sample.php"); 
            exit();
        } else {
            echo "<script>alert('Wrong Username'); window.location.href='index.php';</script>";

        }
    } else {
        echo "<script>alert('Wrong Password'); window.location.href='index.php';</script>";

    }
}

?>
