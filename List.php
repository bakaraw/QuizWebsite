<style>
.card {
    transition: transform 0.5s linear, box-shadow 0.3s ease; 
    width: 50rem; 
    padding: 15px;
    border: 1px solid #bd1717;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    background-color: purple;
    color: #2f11f2; /* Light text color for better contrast with purple background */
    text-align: center; /* Center align the text */
    cursor: pointer; /* Change cursor to pointer to indicate it's clickable */
    margin: 20px auto; /* Center the element horizontally and add space between cards */
    width: 58%;
    
  }

  .card:hover {
    transform: scale(1.00); 
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Enhanced shadow on hover for a "lifting" effect */
    color: #FFFFFF;
    background-color: #dddddd;

  }

  .card-body {
    padding: 10px;
  }

  .card-title, .card-subtitle, .card-text{
    margin: 5px 0; 
    /* Add spacing between title, subtitle, and content */
  }

  .card-title {
    font-size: 1.25rem; /* Larger title font size */
    font-weight: bold; /* Make title bold */
    color: #A020F0; /* Lighter shade for subtitle for differentiation */

    
  }
  .card-subtitle {
    font-size: 1rem; /* Subtitle font size */
    color: #FFFFFF; /* Lighter shade for subtitle for differentiation */
  }
  .card-text {
    font-size: 1rem; /* Subtitle font size */
    color: #000000; /* Lighter shade for subtitle for differentiation */
  }
  </style>


    <?php
    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
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
                          element.addEventListener('click', function() {
                            var quizCode = this.getAttribute('data-quiz-code');
                            window.location.href = 'answerQuiz.php?quizCode=' + quizCode;
                          });
                        });
                      });
                    </script>
        <br>

        <form class="d-flex justify-content-center" role="search" method="post">
        <input class="form-control me-2" style="width: 15rem;" type="search" name="quizCode" placeholder="Quiz Code" aria-label="Search">
        <button class="btn btn-primary border-dark" type="submit">Search</button>
        </form>
        
      
            <?php

      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quizCode'])) {
        $_SESSION['quizCode'] = $_POST['quizCode'];
      }

      if (isset($_SESSION['quizCode'])) {
        $quizCode = $_SESSION['quizCode'];
        $stmt = $conn->prepare("SELECT * FROM quizlisttable WHERE code = ?");
        $stmt->bind_param("s", $quizCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo '<hr style="border-top: 2px solid #ff4500; width: 60%; margin: auto;">';
            echo '<br>';
            echo '<div class="d-flex justify-content-center"><h5 class="card-subtitle" style="color: white;">Quiz Found</h5></div>';
      
              echo '<a href="answerQuiz.php?quizCode=' . $row["code"] . '" style="text-decoration: none; color: inherit;">';
              echo '<div class="card" style="border: 2px solid blue;" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'" data-quiz-code="' . $row["code"] . '">'
              . '<div class="card-body">'
              . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
              . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
              . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
              . '</div>'
              . '</div>';
              echo '</a>';
              echo '<hr style="border-top: 2px solid #ff4500; width: 60%; margin: auto;">';
              unset($_SESSION['quizCode']);

            }
      } else {
        echo '<hr style="border-top: 2px solid #ff4500; width: 60%; margin: auto;">';
        echo '<br>';
        echo '<div class="d-flex justify-content-center"><h5 class="card-subtitle" style="color: white;">No quiz found with code: ' . $quizCode . '</h5></div>';
        echo '<br>';
        echo '<hr style="border-top: 2px solid #ff4500; width: 73%; margin: auto;">';
           
        unset($_SESSION['quizCode']);

      }
    }
      ?>

      

?>

<?php

$itemsPerPage = 5; // Number of items you want per page
$sql = "SELECT COUNT(*) as count FROM quizlisttable";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalItems = $row['count'];
$totalPages = ceil($totalItems / $itemsPerPage);
echo '<div class="d-flex justify-content-center"><h5 class="card-title" style="color: white;">Quiz List</h5></div>';

if (isset($_GET['page']) && is_numeric($_GET['page'])) { 
    $currentPage = (int) $_GET['page'];
} else {
    $currentPage = 1; 
}

$offset = ($currentPage - 1) * $itemsPerPage;

$sql = "SELECT * FROM quizlisttable LIMIT $itemsPerPage OFFSET $offset";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
        echo '<a href="answerQuiz.php?quizCode=' . $row["code"] . '" style="text-decoration: none; color: inherit;">';
        echo '<div class="card" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'" data-quiz-code="' . $row["code"] . '">'
        . '<div class="card-body">'
        . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
        . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
        . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
        . '</div>'
        . '</div>';
        echo '</a>';
    }
} else {
    echo "0 results";
}
    echo '<div class="card-body" class="d-flex justify-content-center">';

        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                echo "<b>$i asdasd</b> ";
            } else {
                echo "<a href='?page=$i'>$i asdsd</a> "; 
            }
        }

    echo '</div>'; 
$conn->close();

?>

<?php require('assets/php/footer.inc.php'); ?>
