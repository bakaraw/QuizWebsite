

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

$message = '';
$redirectLocation = 'index.php'; // Default redirection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    // Validate input
    if (empty($username) || empty($pass)) {
        $message = 'Password and Username are required.';
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT username FROM account WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = 'Username is already taken.';
        } else {
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO account (username, pass) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashedPass);
            if ($stmt->execute()) {
                $message = 'Account successfully created.';
            } else {
                $message = 'Error occurred: ' . $conn->error;
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>


>

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
<script>
$(document).ready(function() {
  // Show the modal if there's a message
  <?php if (!empty($message)) : ?>
  $('#alertModal').modal('show');
  <?php endif; ?>

  // Redirect when the close button is clicked
  $('#closeButton').click(function() {
    window.location.href = '<?php echo $redirectLocation; ?>';
  });
});
</script>
</body>
</html>