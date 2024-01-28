<?php
session_start();

$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$database_name = 'web';

$conn = new mysqli($servername, $dbUsername, $dbPassword, $database_name);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    exit; // Redirect to an error page or display a user-friendly error message
}

if (isset($_POST['login'])) { // Change 'submit' to 'login' to match the name attribute of your login button
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']); // Make sure this matches the name attribute in your form

    $query = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username'");

    if ($result = mysqli_fetch_assoc($query)) {
        $res_pass = $result['pass']; // Replace 'pass' with the actual field name of your password in the database

        if ($pass == $res_pass) {
            $_SESSION['username'] = $username;
            header("Location: sample.php"); // Redirect to welcome page after successful login
            exit();
        } else {
            echo "<div class='message'><p>Wrong Username or Password</p></div><br>";
            echo "<a href='index.php'><button class='btn'>Go Back</button>";
        }
    } else {
        echo "<div class='message'><p>Wrong Username or Password</p></div><br>";
        echo "<a href='index.php'><button class='btn'>Go Back</button>";
    }
}

?>
