<style>
.card {
    width: 20rem; 
    padding: 5px;
    border: 1px solid #bd1717;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    background-color: purple;
    color: #2f11f2; /* Light text color for better contrast with purple background */
    text-align: left; /* Center align the text */
    cursor: pointer; /* Change cursor to pointer to indicate it's clickable */
    margin: 20px auto; /* Center the element horizontally and add space between cards */
    width: 58%;
    
  }

  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Enhanced shadow on hover for a "lifting" effect */
    color: #FFFFFF;
    background-color: #dddddd;
    transition: transform 0.05s linear, box-shadow 0.5s ease;

  }

  .card-body {
    padding: 20px;
    display: flex; /* Add flex display to align items in a row */
    align-items: center; /* Align items vertically */
}
.left-content {
    display: flex;
    align-items: center;
}

.right-content {
    text-align: right; /* Aligns the "Views" text to the right */
}

.card-title, .card-subtitle, .card-text {
    margin: 5px 0; /* Existing spacing */
}

.card-title {
    font-size: 1.25rem; /* Larger title font size */
    font-weight: bold; /* Make title bold */
    color: #A020F0; /* Custom color for title */
}

.card-subtitle {
    font-size: 1rem; /* Subtitle font size */
    color: #FFFFFF; /* White color for subtitle */
}

.card-text {
    font-size: 1rem; /* Regular font size for text */
    color: #000000; /* Black color for text */
}

.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center; /* Vertical centering */
    color: #FFFFFF; /* White color for pagination text */
}

/* New styles for image container and image */
.img-container {
    flex: 0 0 50px; /* Fixed width, no flex-grow, no flex-shrink */
    height: 50px; /* Fixed height */
    overflow: hidden; /* Hide overflow */
    margin-right: 15px; /* Space between image and text */
}

.img-container img {
    width: 100%; /* Make image fill the container */
    height: auto; /* Maintain aspect ratio */
}

.text-content {
    flex: 1; /* Allow text content to grow and fill available space */
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

 
      ?>

<!-- header -->
<?php require('assets/php/head.inc.php'); ?>
<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var quizCards = document.querySelectorAll('.card.quiz-card');
    quizCards.forEach(function(card) {
        card.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action
            var code_for_quiz = this.getAttribute('data-quiz-code');
            window.location.href = 'answerQuiz.php?code_for_quiz=' + code_for_quiz;
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

        $stmt = $conn->prepare("SELECT * FROM quizlisttable WHERE code = ? AND accessibility <> 'PRIVATE'");
        $stmt->bind_param("s", $quizCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {           
            echo '<hr style="border-top: 2px solid #ff4500; width: 73%; margin: auto;">';
            echo '<div class="d-flex justify-content-center"><h5 class="card-title" style="color: white;">Quiz found</h5></div>';
            $thumbnailPath = 'assets/img/uploads/' . htmlspecialchars($row["thumbnail"]);
            if ($row["thumbnail"] === 'default_img.jpg' || !file_exists($thumbnailPath)) {
                $thumbnailPath = 'assets/img/uploads/default_img.jpg'; 
            }
            echo '<div class="card quiz-card" data-quiz-code="' . htmlspecialchars($row["code"]) . '">'
            . '<div class="card-body d-flex align-items-center justify-content-between">'
            . '<div class="left-content d-flex align-items-center">'
            . '<div class="img-container me-3" style="flex: 0 0 50px; height: 50px; overflow: hidden;">'
            . '<img src="' . $thumbnailPath . '" alt="Quiz Thumbnail" style="width: 100%; height: auto;">'
            . '</div>'
            . '<div>'
            . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
            . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
            . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
            . '</div>' 
            . '</div>' 
            . '<div class="right-content">'
            . '<p class="views-text">Views: ' . htmlspecialchars($row["views"]) . '</p>'
            . '</div>' 
            . '</div>'
            . '</div>'; 
              echo '<hr style="border-top: 2px solid #ff4500; width: 60%; margin: auto;">';
              unset($_SESSION['quizCode']);

            }
      } else {
        unset($_SESSION['quizCode']);

        echo '<hr style="border-top: 2px solid #ff4500; width: 73%; margin: auto;">';
        echo '<br>';
        echo '<div data-quiz-code class="d-flex justify-content-center"><h5 class="card-subtitle" style="color: white;">No quiz found with code: ' . $quizCode . '</h5></div>';
        echo '<br>';
        echo '<hr style="border-top: 2px solid #ff4500; width: 73%; margin: auto;">';
           

      }
    }
      ?>

      

?>

<?php

$itemsPerPage = 4;
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
$sql = "SELECT * FROM quizlisttable WHERE accessibility != 'PRIVATE' LIMIT $itemsPerPage OFFSET $offset";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      // Define the path for the thumbnail
      $thumbnailPath = 'assets/img/uploads/' . htmlspecialchars($row["thumbnail"]);
      if ($row["thumbnail"] === 'default_img.jpg' || !file_exists($thumbnailPath)) {
          $thumbnailPath = 'assets/img/uploads/default_img.jpg'; // Default image
      }

      // Generate the card for each quiz
      echo '<div class="card quiz-card" data-quiz-code="' . htmlspecialchars($row["code"]) . '">'
      . '<div class="card-body d-flex align-items-center justify-content-between">'
      . '<div class="left-content d-flex align-items-center">'
      . '<div class="img-container me-3" style="flex: 0 0 50px; height: 50px;">' // Removed overflow:hidden to allow adjustments below
      . '<img src="' . $thumbnailPath . '" alt="Quiz Thumbnail" style="width: 100%; height: 100%; object-fit: cover;">' // Adjusted styles here
      . '</div>'
      . '<div>'
      . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
      . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
      . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
      . '</div>' // Close text container
      . '</div>' // Close left content
      . '<div class="right-content">'
      . '<p class="views-text">Views: ' . htmlspecialchars($row["views"]) . '</p>'
      . '</div>' // Close right content
      . '</div>' // Close card-body
      . '</div>'; // Close card
    }
} else {
    echo '<div class="card quiz-card">'
    . '<div class="card-body d-flex align-items-center justify-content-between">'
    . '<div class="left-content d-flex align-items-center">'
    . '<p>No quiz found.</p>'
    . '</div>' // Close left content
    . '</div>' // Close card-body
    . '</div>'; // Close card
}
echo    '<div class="pagination-container">';
echo         '<div class="card-body d-flex justify-content-center">';

for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $currentPage) {
        echo "<b>$i</b> ";
    } else {
        echo "<a href='?page=$i'>$i</a> "; 
    }
}
        echo '</div>'; 
    echo '</div>'; 
$conn->close();

?>


<?php require('assets/php/footer.inc.php'); 

