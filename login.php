<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
   

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

$message = '';

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
                $message = 'Wrong Password';
            }
        } else {
            $message = 'Wrong Username';
        }
    } else {
        // Query failed to execute
        $message = 'Login failed, please try again later.';
    }
    $stmt->close();
}
$conn->close();
?>
</body>
</html>


<!-- Bootstrap Modal for Feedback -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: orange;">
        <h5 class="modal-title" id="alertModalLabel">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $message; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" id="closeButton" style="background-color: orange; color: white;">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
<script>
$(document).ready(function() {
  // Show the modal if there's a message
  <?php if (!empty($message)) : ?>
  $('#alertModal').modal('show');
  <?php endif; ?>

  // Redirect to index.php when the close button is clicked
  $('#closeButton').click(function() {
    window.location.href = 'index.php';
  });
});
</script>