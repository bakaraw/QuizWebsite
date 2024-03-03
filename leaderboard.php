
<?php
// Start the session before any output is sent
session_start();
include "assets/php/dbh_quiz.inc.php";

// if using url to access quiz, user needs to login
if (!isset($_SESSION["username"])) {
    header("Location: assets/php/via_url_redirection.php");
    exit();
}
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    session_unset();
    session_destroy();
  
    header("Location: index.php");
    exit();
  }
  include "assets/php/dbh_quiz.inc.php";
  require('assets/php/head.inc.php');
  include('assets/php/navbar.inc.php');
  include('assets/php/ModalSubmitQ.php');
  ?>

<?php
$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$database_name = 'web';
$conn = new mysqli($servername, $dbUsername, $dbPassword, $database_name);

// Adjusted query to order results by 'score' in descending order
$query = "SELECT username, code, score FROM quiz_scores ORDER BY score DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="container">'; // Container for the cards
        echo '<div class="row justify-content-center">'; // Row to hold the columns, centered
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-auto mb-4">'; // Column auto-width for single-line layout
                    echo '<div class="card">'; // Bootstrap card
                        echo '<div class="card-body text-center">'; // Card body with centered text
                            echo '<h5 class="card-title">'.htmlspecialchars($row["username"]).'</h5>'; // Card title
                            echo '<h6 class="card-subtitle mb-2 text-muted">'.htmlspecialchars($row["code"]).'</h6>'; // Card subtitle
                            echo '<p class="card-text">Score: '.htmlspecialchars($row["score"]).'</p>'; // Card text
                        echo '</div>';
                    echo '</div>';
                echo '</div>'; // End of column
            }
        echo '</div>'; // End of row
    echo '</div>'; // End of container
} else {
    echo "0 results";
}
?>