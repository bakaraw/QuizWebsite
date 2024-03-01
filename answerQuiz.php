<?php
// Start the session before any output is sent
session_start();

// Include necessary files
include "assets/php/dbh_quiz.inc.php";
require('assets/php/head.inc.php');
include('assets/php/navbar.inc.php');

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

        // Create an array of indices and shuffle it
        $indices = range(0, count($allQuestions) - 1);
        shuffle($indices);

        // Shuffle the order of choices for each question
        $questionNumber = 1; // Initialize the question number counter
        foreach ($indices as $index => $questionIndex) {
            $question = $allQuestions[$questionIndex];

            $choices = array($question['choiceA'], $question['choiceB'], $question['choiceC'], $question['choiceD']);
            shuffle($choices);
            list($question['choiceA'], $question['choiceB'], $question['choiceC'], $question['choiceD']) = $choices;

            // Display the question with its number
            echo '<div class="container ms-auto me-auto">';
            echo '<div class="rounded p-3 mt-3 shadow shadow-4 border border-light text-light container-fluid" style="--bs-bg-opacity: .2; --bs-border-opacity: .2; --bs-text-opacity: .70; background-color: #FCBF49;">';
            echo '<h5 style="color: black;"><strong>' . $questionNumber . '.</strong> ' . $question['question'] . '</h5>';
            
            if ($question['questiontype'] == "MCQ") {
                echo '<div style="color: black;">';
                echo '<input type="radio" name="answer[' . $question['qid'] . ']" value="A"> A. ' . $question['choiceA'] . '<br>';
                echo '<input type="radio" name="answer[' . $question['qid'] . ']" value="B"> B. ' . $question['choiceB'] . '<br>';
                echo '<input type="radio" name="answer[' . $question['qid'] . ']" value="C"> C. ' . $question['choiceC'] . '<br>';
                echo '<input type="radio" name="answer[' . $question['qid'] . ']" value="D"> D. ' . $question['choiceD'] . '<br>';
                echo '</div>';
            } elseif ($question['questiontype'] == "TOF") {
                echo '<div style="color: black;">';
                echo '<input type="radio" name="answer[' . $question['qid'] . ']" value="True"> True<br>';
                echo '<input type="radio" name="answer[' . $question['qid'] . ']" value="False"> False<br>';
                echo '</div>';
            } elseif ($question['questiontype'] == "IDEN") {
                echo '<div style="color: black;">';
                echo '<input type="text" name="answer[' . $question['qid'] . ']" placeholder="Type your answer here" style="width: calc(100% - 32px); color: black; border: none; border-radius: 15px; padding: 10px; font-size: 16px;" class="form-control" placeholder="Type your answer here" style="color: gray;">';
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
    <form action="submit_quiz.php" method="post">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
            <button class="btn btn-success text-light border-dark btn-md" type="submit" name="submit-quiz">Submit Quiz</button>
        </div>
    </form>
</div>

<?php require('assets/php/footer.inc.php'); ?>
