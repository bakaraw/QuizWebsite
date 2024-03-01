<?php
// Start the session before any output is sent
session_start();

// Include necessary files
include "assets/php/dbh_quiz.inc.php";
require('assets/php/head.inc.php');
include('assets/php/navbar.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Other head content -->

    <!-- Include jQuery for Bootstrap modal functionality -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include the Unanswered Questions Modal -->
    <?php include('ModalUnansweredQ.php'); ?>

    <style>
        /* Add any additional styles here */
        .selected-choice {
            background-color: #EA9424 !important; /* Change the color as desired */
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

            // Fetch all questions related to the quiz
            $fetchSql = "SELECT * FROM `questions` WHERE quizcode = ?";
            $fetchStmt = $pdo->prepare($fetchSql);
            $fetchStmt->execute([$quizCode]);
            $allQuestions = $fetchStmt->fetchAll(PDO::FETCH_ASSOC);

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

    <div class="container">
        <form id="quiz-form" action="submit_quiz.php" method="post" onsubmit="return checkUnansweredQuestions();">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                <button class="btn btn-success text-light border-dark btn-md" type="submit" name="submit-quiz">Submit Quiz</button>
            </div>
        </form>
    </div>

    <?php require('assets/php/footer.inc.php'); ?>

    <script>
    $(document).ready(function () {
        // Handle the click event for choice buttons
        $('.choice-button').on('click', function () {
            // Get the question ID and choice value
            var questionId = $(this).data('question-id');
            var choice = $(this).data('choice');

            // Remove the 'selected-choice' class from all buttons with the same question ID
            $('.choice-button[data-question-id="' + questionId + '"]').removeClass('selected-choice');
            // Add the 'selected-choice' class to the clicked button
            $(this).addClass('selected-choice');
        });

        // Handle the form submission
        $('#quiz-form').on('submit', function (event) {
            // Check if there are multiple selected choices for any question
            var hasMultipleSelection = false;

            $('.choice-button.selected-choice').each(function () {
                var questionId = $(this).data('question-id');

                if ($('.choice-button.selected-choice[data-question-id="' + questionId + '"]').length > 1) {
                    hasMultipleSelection = true;
                    return false; // Exit the loop early
                }
            });

            // If there are multiple selected choices, prevent the form submission
            if (hasMultipleSelection) {
                alert('Please select only one choice per question.');
                event.preventDefault();
            }
        });
    });
</script>



</body>

</html>
