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


//for attemps checker
if (isset($_GET['code_for_quiz'])) {
    $code = $_GET['code_for_quiz'];
    $user = $_SESSION['username'];

    $stmt = $pdo->prepare("SELECT * FROM user_quiz_attempts WHERE username = :username AND  quizcode = :quizcode");
    // Bind parameters (if needed)
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':quizcode', $code);
    // Execute the query
    $stmt->execute();

    // Fetch the result
    if ($stmt->rowCount() > 0) {
        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['remaining_attempts'] == 0) {
            header("Location: assets/php/no_attempts_left.php");
            exit();
        }

    } else {
        $stmt = $pdo->prepare("SELECT max_attempts FROM quizlisttable WHERE code = :quizcode");
        $stmt->bindParam(':quizcode', $code);
        $stmt->execute();
        // Fetch the result and store it in a PHP variable
        $max_attempts_row = $stmt->fetch(PDO::FETCH_ASSOC);
        $max_attempts = $max_attempts_row['max_attempts'];

        $stmt = $pdo->prepare("INSERT INTO user_quiz_attempts (username, quizcode, remaining_attempts) VALUES (:username, :quizcode, :remaining_attempts)");
        $stmt->bindParam(':username', $user);
        $stmt->bindParam(':quizcode', $code);
        $stmt->bindParam(':remaining_attempts', $max_attempts);
        $stmt->execute();

    }
}


if (isset($_POST['kick-out-btn'])) {
    $decrement_value = 1;
    $stmt = $pdo->prepare("UPDATE user_quiz_attempts SET remaining_attempts = remaining_attempts - :decrement_value WHERE quizcode = :quizcode");

    // Bind parameters
    $stmt->bindParam(':decrement_value', $decrement_value, PDO::PARAM_INT);
    $stmt->bindParam(':quizcode', $code);

    // Execute the prepared statement
    $stmt->execute();

    header("Location: List.php");
    exit();

}

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

     <!-- model when tab is closed or go backed -->
     <div class="modal fade" id="exit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
                }, seconds * 1000);
            } else {
                clearTimeout(timer);
            }
        });

        $(window).on('blur', function () {
            console.log('Window is out of focus');
        });

        $(window).on('focus', function () {
            console.log('Window is in focus');
        });


    </script>



<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"])) {
    $newScore = 0; 
    $username = $_SESSION["username"];
    $quizCode = $_POST['quizCode'];

    if (isset($_POST['answer']) && is_array($_POST['answer'])) {
        foreach ($_POST['answer'] as $questionId => $userAnswer) {
            $stmt = $pdo->prepare("SELECT * FROM questions WHERE qid = ?");
            $stmt->execute([$questionId]);
            $question = $stmt->fetch(PDO::FETCH_ASSOC);

            $quizCode = $_POST['quizCode']; // Assuming you have the quiz code from the form submission
            $stmt = $pdo->prepare("SELECT * FROM questions WHERE quizcode = ?");
            $stmt->execute([$quizCode]);
            $allQuestions = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all questions and store them in $allQuestions

            $totalQuestions = count($allQuestions);


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
            Your score is: $newScore out of $totalQuestions
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="redirectToQuizList()">Close and Go Back</button>
          </div>
        </div>
      </div>
    </div>
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