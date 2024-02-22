<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  // Redirect to login page or show an error
  header("Location: login.php");
  exit;
}



$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$database_name = 'web';

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $database_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>


<!-- header -->
<?php require('assets/php/head.inc.php'); ?>
<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var elements = document.querySelectorAll('.card');
            elements.forEach(function(element) {
              element.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.05)';
              });
              element.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
              });
            });
          });
        </script>
        <br>

    
<?php
$sql = "SELECT * FROM quizlisttable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<div class="card" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'">'
    . '<div class="card-body">'
    . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
    . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
    . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
    . '</div>'
    . '</div>';
    
}
} else {
  echo "0 results";
}
$conn->close();

?>

<?php require('assets/php/footer.inc.php'); ?>








