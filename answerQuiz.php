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

                echo "<div class='question' style='{$fontStyle} {$fontColor}'>";
                echo "<p><strong>Question {$questionNumber}:</strong> {$question['question']}</p>";

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
                        break;
                }

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
    </div>F

    <script>
    var timer;
    $(document).on('visibilitychange', function () {
        seconds = 3;
        if (document.visibilityState === 'hidden') {
            timer = setTimeout(function () {
                $('#unclosableModal').modal('show');
                console.log('smells fishy');
            }, seconds * 1000);
        } else {
            clearTimeout(timer);
        }
    });
</script>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"])) {
    $totalScore = 0;
    $username = $_SESSION["username"];
    $quizCode = $_POST['quizCode'];

    // Calculate total score based on answers
    if (isset($_POST['answer']) && is_array($_POST['answer'])) {
        foreach ($_POST['answer'] as $questionId => $userAnswer) {
            $stmt = $pdo->prepare("SELECT answer FROM questions WHERE qid = ?");
            $stmt->execute([$questionId]);
            $question = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userAnswer === $question['answer']) {
                $totalScore++;
            }
        }
    }

    // Check if a score already exists for this user and quiz
    $stmt = $pdo->prepare("SELECT score FROM quiz_scores WHERE username = ? AND code = ?");
    $stmt->execute([$username, $quizCode]);
    $scoreExists = $stmt->fetch(PDO::FETCH_ASSOC);

    // If a score exists, update it with the new total score
    if ($scoreExists) {
        $stmt = $pdo->prepare("UPDATE quiz_scores SET score = score + ? WHERE username = ? AND code = ?");
        $stmt->execute([$totalScore, $username, $quizCode]);
    } else {
        // If no score exists, insert the new score
        $stmt = $pdo->prepare("INSERT INTO quiz_scores (username, code, score) VALUES (?, ?, ?)");
        $stmt->execute([$username, $quizCode, $totalScore]);
    }

    // Redirect or inform the user of their score
    echo "Your score is: $totalScore"; // Temporary line for demonstration
}
?>

    <?php require('assets/php/footer.inc.php'); ?>

