

<?php
session_start();

$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$database_name = 'web';

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $database_name);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    // Validate input
    if (empty($username) || empty($pass)) {
        echo "<script>alert('Password and Username are required'); window.location.href='index.php';</script>";
        } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT username FROM account WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "Username is already taken.";
        } else {
            // Hash the password
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

            // Prepare and execute the statement
            $stmt = $conn->prepare("INSERT INTO account (username, pass) VALUES ( ?, ?)");
            $stmt->bind_param("ss", $username, $hashedPass);
            if ($stmt->execute()) {
                echo "<script>alert('Account successful created'); window.location.href='index.php';</script>";

            } else {
                echo "<script>alert('Error: ' . $stmt->error'); window.location.href='index.php';</script>";
            
            }

        }
        $stmt->close();
    }
    if(empty($username)){
        echo "<script>alert(' Username are required'); window.location.href='index.php';</script>";
    } if(empty($pass)){
        echo "<script>alert(' Username are required'); window.location.href='index.php';</script>";
    }
}

$conn->close();
?>
