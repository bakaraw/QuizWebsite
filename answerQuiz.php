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

        // Assuming $pdo is your PDO database connection instance
    
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
            shuffle($allQuestions);

            // Display quiz details above the first question
            echo '<div class="container text-center mt-4">';
            echo '<h2 class="text-dark">' . htmlspecialchars($quizDetails['title']) . '</h2>';
            echo '<p class="text-muted">Quiz Code: ' . htmlspecialchars($quizDetails['code']) . ' | Creator: ' . htmlspecialchars($quizDetails['creator']) . '</p>';
            echo '</div>';

            // Shuffle the order of choices for each question
            $questionNumber = 1; // Initialize the question number counter
            foreach ($allQuestions as $question) {
                // Check if keys exist before using them
                $fontStyle = isset($question['fontstyle']) ? 'font-family: ' . $question['fontstyle'] . ';' : '';
                $fontColor = isset($question['fontcolor']) ? 'color: ' . $question['fontcolor'] . ' !important;' : '';

                $choices = array($question['choiceA'], $question['choiceB'], $question['choiceC'], $question['choiceD']);
                shuffle($choices);

                // Display the question with its number
                echo '<div class="container ms-auto me-auto">';
                echo '<div class="rounded p-3 mt-3 shadow shadow-4 border border-light text-light container-fluid" style="--bs-bg-opacity: .2; --bs-border-opacity: .2; --bs-text-opacity: .70; background-color: #FCBF49;">';
                echo '<h5 style="color: black; ' . $fontStyle . '"><strong>' . $questionNumber . '.</strong> ' . $question['question'] . '</h5>';

                if ($question['questiontype'] == "MCQ") {
                    echo '<div style="color: black;">';
                    echo '<button type="button" class="btn btn-light mt-2 text-start font-weight-bold choice-button" onclick="selectChoice(' . $question['qid'] . ', \'A\')" style="width: 100%; box-shadow: 0px 5px 0px 0px rgb(234, 148, 36); border-radius: 16px; ' . $fontColor . '" name="answer[' . $question['qid'] . ']" value="A"><strong>' . $choices[0] . '</strong></button><br>';
                    echo '<button type="button" class="btn btn-light mt-2 text-start font-weight-bold choice-button" onclick="selectChoice(' . $question['qid'] . ', \'B\')" style="width: 100%; box-shadow: 0px 5px 0px 0px rgb(234, 148, 36); border-radius: 16px; ' . $fontColor . '" name="answer[' . $question['qid'] . ']" value="B"><strong>' . $choices[1] . '</strong></button><br>';
                    echo '<button type="button" class="btn btn-light mt-2 text-start font-weight-bold choice-button" onclick="selectChoice(' . $question['qid'] . ', \'C\')" style="width: 100%; box-shadow: 0px 5px 0px 0px rgb(234, 148, 36); border-radius: 16px; ' . $fontColor . '" name="answer[' . $question['qid'] . ']" value="C"><strong>' . $choices[2] . '</strong></button><br>';
                    echo '<button type="button" class="btn btn-light mt-2 text-start font-weight-bold choice-button" onclick="selectChoice(' . $question['qid'] . ', \'D\')" style="width: 100%; box-shadow: 0px 5px 0px 0px rgb(234, 148, 36); border-radius: 16px; ' . $fontColor . '" name="answer[' . $question['qid'] . ']" value="D"><strong>' . $choices[3] . '</strong></button><br>';
                    echo '</div>';
                } elseif ($question['questiontype'] == "TOF") {
                    echo '<div style="color: black;">';
                    echo '<button type="button" class="btn btn-light mt-2 text-start font-weight-bold choice-button" onclick="selectChoice(' . $question['qid'] . ', \'True\')" style="width: 100%; box-shadow: 0px 5px 0px 0px rgb(234, 148, 36); border-radius: 16px; ' . $fontColor . '" name="answer[' . $question['qid'] . ']" value="True"><strong>True</strong></button><br>';
                    echo '<button type="button" class="btn btn-light mt-2 text-start font-weight-bold choice-button" onclick="selectChoice(' . $question['qid'] . ', \'False\')" style="width: 100%; box-shadow: 0px 5px 0px 0px rgb(234, 148, 36); border-radius: 16px; ' . $fontColor . '" name="answer[' . $question['qid'] . ']" value="False"><strong>False</strong></button><br>';
                    echo '</div>';
                } elseif ($question['questiontype'] == "IDEN") {
                    echo '<div style="color: black;">';
                    echo '<input type="text" name="answer[' . $question['qid'] . ']" placeholder="Type your answer here" style="width: 100%; color: black; border: none; border-radius: 16px; padding: 10px; font-size: 16px; box-shadow: 0px 5px 0px 0px rgb(234, 148, 36);" class="form-control" placeholder="Type your answer here" style="color: gray;">';
                    echo '</div>';
                }

                echo '</div>';
                echo '</div>';

                $questionNumber++;
            }
        } else {
            echo 'Quiz not found.';
            exit;
        }
    }
    ?>

    <form id="quizForm" action="submit_quiz.php" method="post" onsubmit="return checkUnansweredQuestions();">
        <div class="d-grid gap-2 d-md-flex justify-content-center mt-3">
            <button class="btn btn-success text-light border-dark btn-md btn-submit-quiz" type="button"
                data-toggle="modal" data-target="#modalSubmitQuiz">Submit Quiz</button>
        </div>
    </form>

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
                    // window.location.href = 'another-page.html';
                    $('#unclosableModal').modal('show');
                    console.log('smells fishy');
                }, seconds * 1000);
            } else {
                clearTimeout(timer);
            }
        });
    </script>


    <?php require('assets/php/footer.inc.php'); ?>

