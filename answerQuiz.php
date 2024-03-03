<?php
// Start the session before any output is sent
session_start();
include "assets/php/dbh_quiz.inc.php";
// if using the URL to access the quiz, the user needs to login
if (!isset($_SESSION["username"])) {
    header("Location: assets/php/via_url_redirection.php");
    exit();
}

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

    $stmt = $pdo->prepare("SELECT max_attempts FROM quizlisttable WHERE code = :quizcode");
    // Bind parameters (if needed)
    $stmt->bindParam(':quizcode', $code);
    // Execute the query
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['max_attempts'] != -1) {
            $stmt = $pdo->prepare("UPDATE user_quiz_attempts SET remaining_attempts = remaining_attempts - :decrement_value WHERE quizcode = :quizcode");
            // Bind parameters
            $stmt->bindParam(':decrement_value', $decrement_value, PDO::PARAM_INT);
            $stmt->bindParam(':quizcode', $code);
            // Execute the prepared statement
            $stmt->execute();
        }

        header("Location: List.php");
        exit();
    }
}

// Include necessary files
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
    <style>
        /* Add any additional styles here */
        .selected-choice {
            background-color: #EA9424 !important;
            color: white !important;
            border: none !important;
        }

        .choice-button {
            background-color: white; /* Set background color to white */
            color: black !important; /* Set text color to black */
            border: none !important; /* Remove button borders */
        }

        /* Style for identification question textbox */
        .iden-answer {
            border: none !important;
            border-radius: 1.5rem !important; /* Set more rounded border-radius */
            color: white !important; /* Set text color to white */
        }

        /* Style for "Your answer:" text */
        .your-answer-label {
            font-weight: bold; /* Set font-weight to bold */
            color: white !important; /* Set text color to white */
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
                            echo "<label class='your-answer-label'>Your answer:</label>";
                            echo "<input type='text' class='form-control iden-answer' name='answer[{$question['qid']}]' style='height: 50px;'>";
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

    <?php include('assets/php/modalSubmitQ.php'); ?>

    <!-- modal popup when the user is out of tab -->
    <div class="modal fade" id="unclosableModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Out of tab for too long</h1>
                </div>
                <div class="modal-body">
                    You have been kicked out
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <input type="submit" class="btn btn-primary" name="kick-out-btn" id="kick-out-btn"
                            value="Omki :(">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- score modal -->
    <div class="modal fade" id="scoreModal" tabindex="-1" role="dialog" aria-labelledby="scoreModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scoreModalLabel">Quiz Score</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="redirectToQuizList()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="score-display"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="redirectToQuizList()">Close and Go
                        Back</button>
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
                }, seconds * 10000);
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

    <script>
        $(document).ready(function () {
            $('.choice-button').click(function () {
                var $parentContainer = $(this).closest('.choices-container');
                $parentContainer.find('.choice-button').removeClass('selected-choice');
                $(this).addClass('selected-choice');

                // Update the hidden input with the selected value
                var selectedValue = $(this).data('value');
                $parentContainer.find('.selected-answer').val(selectedValue);
            });

            $('#quizForm').submit(function (e) {
                e.preventDefault();
                $('#scoreModal').modal('show');
                var quizForm = $('#quizForm').serialize()
                $.ajax({
                    type: "POST",
                    url: "assets/ajax/score_counter.php",
                    data: quizForm,
                    success: function (response) {
                        $('#score-display').text("Your score is: " + response);
                    }
                });
            });
        });

        function redirectToQuizList() {
            // Close the modal if you want, though it will automatically close on page redirection
            $('#scoreModal').modal('hide');
            // Redirect to list.php
            window.location.href = 'list.php';
        }
    </script>
    <?php require('assets/php/footer.inc.php'); ?>
</body>

</html>
