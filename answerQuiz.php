<?php
// Start the session before any output is sent
session_start();

// if using url to access quiz, user needs to login
if (!isset($_SESSION["username"])) {
    header("Location: assets/php/via_url_redirection.php");
    exit();
}

// Include necessary files
include "assets/php/dbh_quiz.inc.php";
require('assets/php/head.inc.php');
include('assets/php/navbar.inc.php');
// Update the inclusion to use the correct path for the ModalSubmitQ.php file
include('assets/php/ModalSubmitQ.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Other head content -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include Bootstrap JS from CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".choice-button").click(function () {
                $(this).addClass("selected-choice");
                $(this).siblings().removeClass("selected-choice");
            });
        });
    </script>
    <style>
        /* Add any additional styles here */
        .selected-choice {
            background-color: #EA9424 !important;
            /* Change the color as desired */
            color: white !important;
            border: none !important;
            
        }

        
    </style>
</head>

<body>
<?php 
if (isset($_GET['code_for_quiz'])) {
    $quizCode = htmlspecialchars($_GET['code_for_quiz']);

    try {
        // Assuming $pdo is your PDO database connection instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch quiz details, including 'views'
        $fetchSql = "SELECT * FROM quizlisttable WHERE code = ?";
        $fetchStmt = $pdo->prepare($fetchSql);
        $fetchStmt->execute([$quizCode]);
        $quizDetails = $fetchStmt->fetch(PDO::FETCH_ASSOC);

        if ($quizDetails) {
            // Increment the 'views' count
            $updateSql = "UPDATE quizlisttable SET views = views + 1 WHERE code = ?";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute([$quizCode]);

            // Fetch all questions related to the quiz and shuffle the array
            $fetchSql = "SELECT * FROM `questions` WHERE quizcode = ?";
            $fetchStmt = $pdo->prepare($fetchSql);
            $fetchStmt->execute([$quizCode]);
            $allQuestions = $fetchStmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($allQuestions)) {
                echo "No questions found for this quiz.";
                exit;
            }

            shuffle($allQuestions);

            // Display quiz details above the first question
            echo '<div class="container text-center mt-4">';
            echo '<h2 class="text-dark">' . htmlspecialchars($quizDetails['title']) . '</h2>';
            echo '<p class="text-muted">Quiz Code: ' . htmlspecialchars($quizDetails['code']) . ' | Creator: ' . htmlspecialchars($quizDetails['creator']) . '</p>';
            echo '</div>';

            // Start the form for submitting quiz answers
            echo '<form id="quizForm" action="answerQuiz.php" method="post">';
            echo '<input type="hidden" name="quizCode" value="' . $quizCode . '">';


            $questionNumber = 1;
            foreach ($allQuestions as $question) {
                // Check if keys exist before using them
                $fontStyle = isset($question['fontstyle']) ? 'font-family: ' . $question['fontstyle'] . ';' : '';
                $fontColor = isset($question['fontcolor']) ? 'color: ' . $question['fontcolor'] . ' !important;' : '';

                $choices = array($question['choiceA'], $question['choiceB'], $question['choiceC'], $question['choiceD']);
                shuffle($choices);

                // Display the question with its number
                echo '<div class="container ms-auto me-auto" style="width: 90%; max-width: 1000px;">'; // Adjust the width as needed
                echo '<div class="rounded p-3 mt-3 shadow shadow-4 border border-light text-light container-fluid" style="--bs-bg-opacity: .2; --bs-border-opacity: .2; --bs-text-opacity: .70; background-color: #FCBF49; padding: 20px;">'; // Added padding for internal spacing
                echo '<h5 style="color: black; ' . $fontStyle . '; min-height: 60px;">' . $questionNumber . '. ' . $question['question'] . '</h5>'; // Adjust min-height as needed
                

<<<<<<< Updated upstream

                switch ($question['questiontype']) {
                    case "MCQ":
                        $choices = [$question['choiceA'], $question['choiceB'], $question['choiceC'], $question['choiceD']];
                        shuffle($choices);
                        foreach ($choices as $choice) {
                            echo "<div><label><input type='radio' name='answer[{$question['qid']}]' value='{$choice}'> {$choice}</label></div>";
                        }
                        break;
                    case "TOF":
                        echo "<div><label><input type='radio' name='answer[{$question['qid']}]' value='True'> True</label></div>";
                        echo "<div><label><input type='radio' name='answer[{$question['qid']}]' value='False'> False</label></div>";
                        break;
                    case "IDEN":
                        echo "<div><label>Your answer: <input type='text' name='answer[{$question['qid']}]'></label></div>";
=======
                switch ($question['questiontype']) {
                    case "MCQ":
                    case "TOF":
                        $choices = $question['questiontype'] == "MCQ" ? 
                            [$question['choiceA'], $question['choiceB'], $question['choiceC'], $question['choiceD']] : 
                            ['True', 'False'];
                        shuffle($choices);
                        
                        echo "<div class='choices-container' data-question-id='{$question['qid']}' style='display: flex; flex-direction: column; gap: 10px;'>"; // Added flex styles for consistent spacing
                        foreach ($choices as $choice) {
                            echo "<button type='button' class='btn btn-primary choice-button' data-value='{$choice}'>{$choice}</button>";
                        }
                        echo "<input type='hidden' name='answer[{$question['qid']}]' class='selected-answer'>";
                        echo "</div>";
                        break;
                    case "IDEN":
                        echo "<div class='form-group'>";
                        echo "<label>Your answer:</label>";
                 echo "<input type='text' class='form-control' name='answer[{$question['qid']}]' style='height: 50px;'>";
                        echo "</div>";
>>>>>>> Stashed changes
                        break;
                }
                echo "</div>"; // Close question div

                echo "</div>"; // Close question div
                $questionNumber++;
            }

            // Close the form after all questions have been output
            echo '<div class="d-grid gap-2 d-md-flex justify-content-center mt-3">';
            echo '<button class="btn btn-success text-light border-dark btn-md btn-submit-quiz" type="submit">Submit Quiz</button>';
            echo '</div>';
            echo '</form>';
        } else {
            echo 'Quiz not found.';
            exit;
        }
    } catch (PDOException $e) {
        // Handle the error
        echo "Database error: " . $e->getMessage();
        exit;
    }
}
?>
<<<<<<< Updated upstream
=======

<script>
$(document).ready(function() {
    $('.choice-button').click(function() {
        var $parentContainer = $(this).closest('.choices-container');
        $parentContainer.find('.choice-button').removeClass('selected-choice');
        $(this).addClass('selected-choice');
        
        // Update the hidden input with the selected value
        var selectedValue = $(this).data('value');
        $parentContainer.find('.selected-answer').val(selectedValue);
    });
});
</script>

>>>>>>> Stashed changes
    <?php include('assets/php/modalSubmitQ.php'); ?>

    <!-- modal popup when user is out of tab -->
    <div class="modal fade" id="unclosableModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Out of tab for too long</h1>
                </div>
                <div class="modal-body">
                    You have been kicked out
                </div>
                <div class="modal-footer">
                    <a href="List.php" type="button" class="btn btn-primary">Omki :(</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    var timer;
    $(document).on('visibilitychange', function () {
        seconds = 3;
        if (document.visibilityState === 'hidden') {
            timer = setTimeout(function () {
                $('#unclosableModal').modal('show');
                console.log('smells fishy');
            }, seconds * 100000);
        } else {
            clearTimeout(timer);
        }
    });
</script>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"])) {
    $newScore = 0; // This will hold the score for the current attempt
    $username = $_SESSION["username"];
    $quizCode = $_POST['quizCode'];

    if (isset($_POST['answer']) && is_array($_POST['answer'])) {
        foreach ($_POST['answer'] as $questionId => $userAnswer) {
            $stmt = $pdo->prepare("SELECT * FROM questions WHERE qid = ?");
            $stmt->execute([$questionId]);
            $question = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($question) {
                // Assuming 'ChoiceA', 'ChoiceB', etc., are the column names in the database
                if ($question['questiontype'] == "MCQ") {
                    $correctAnswerColumn = $question['answer']; // e.g., "ChoiceA"
                    $correctAnswerColumn = strtolower($correctAnswerColumn); // to lowercase
                    $correctAnswerColumn = substr($correctAnswerColumn, 0, -1) . strtoupper(substr($correctAnswerColumn, -1)); // Capitalize last letter
                    $correctAnswer = $question[$correctAnswerColumn]; // Access the content
                    
                    if (strcasecmp(trim($userAnswer), trim($correctAnswer)) == 0) {
                        $newScore++;
                    }
                } elseif ($question['questiontype'] == "TOF" || $question['questiontype'] == "IDEN") {
                    if (strcasecmp(trim($userAnswer), trim($question['answer'])) == 0) {
                        $newScore++;
                    }
                }
            }
        }
    }
<<<<<<< Updated upstream
=======

    // Fetch the existing score, if any
    $stmt = $pdo->prepare("SELECT score FROM quiz_scores WHERE username = ? AND code = ?");
    $stmt->execute([$username, $quizCode]);
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $existingScore = $row['score'];
        $cumulativeScore = $existingScore + $newScore; // Add new score to existing score

        // Update the cumulative score
        $updateStmt = $pdo->prepare("UPDATE quiz_scores SET score = ? WHERE username = ? AND code = ?");
        $updateStmt->execute([$cumulativeScore, $username, $quizCode]);
    } else {
        // If no existing score, insert the new score as is
        $insertStmt = $pdo->prepare("INSERT INTO quiz_scores (username, code, score) VALUES (?, ?, ?)");
        $insertStmt->execute([$username, $quizCode, $newScore]);
    }

    echo "<script>$(document).ready(function() { $('#scoreModal').modal('show'); });</script>";
>>>>>>> Stashed changes

    // Fetch the existing score, if any
    $stmt = $pdo->prepare("SELECT score FROM quiz_scores WHERE username = ? AND code = ?");
    $stmt->execute([$username, $quizCode]);
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $existingScore = $row['score'];
        $cumulativeScore = $existingScore + $newScore; // Add new score to existing score

<<<<<<< Updated upstream
        // Update the cumulative score
        $updateStmt = $pdo->prepare("UPDATE quiz_scores SET score = ? WHERE username = ? AND code = ?");
        $updateStmt->execute([$cumulativeScore, $username, $quizCode]);
    } else {
        // If no existing score, insert the new score as is
        $insertStmt = $pdo->prepare("INSERT INTO quiz_scores (username, code, score) VALUES (?, ?, ?)");
        $insertStmt->execute([$username, $quizCode, $newScore]);
    }

    echo "Your score is: $newScore"; // Display the new score for this attempt
}
?>
    <?php require('assets/php/footer.inc.php'); ?>
=======
echo <<<HTML
<div class="modal fade" id="scoreModal" tabindex="-1" role="dialog" aria-labelledby="scoreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scoreModalLabel">Quiz Score</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="redirectToQuizList()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Your score is: $newScore
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="redirectToQuizList()">Close and Go Back</button>
      </div>
    </div>
  </div>
</div>
>>>>>>> Stashed changes

HTML;

}



?>
<script>
$(document).ready(function() {
    $('#scoreModal').modal('show');
});

function redirectToQuizList() {
    // Close the modal if you want, though it will automatically close on page redirection
    $('#scoreModal').modal('hide');
    // Redirect to list.php
    window.location.href = 'list.php';
}
</script>
    <?php require('assets/php/footer.inc.php'); ?>