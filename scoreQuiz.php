<?php
session_start();
include "assets/php/dbh_quiz.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $quizCode = $_GET['quizCode'];
    $totalQuestions = 0;
    $correctAnswers = 0;

    try {
        if (isset($_GET['answer']) && is_array($_GET['answer'])) {
            foreach ($_GET['answer'] as $questionId => $userAnswer) {
                $stmt = $pdo->prepare("SELECT * FROM questions WHERE qid = ?");
                $stmt->execute([$questionId]);
                $question = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($question) {
                    $totalQuestions++;

                    // Assuming 'ChoiceA', 'ChoiceB', etc., are the column names in the database
                    if ($question['questiontype'] == "MCQ") {
                        $correctAnswerColumn = $question['answer']; // e.g., "ChoiceA"
                        $correctAnswerColumn = strtolower($correctAnswerColumn); // to lowercase
                        $correctAnswerColumn = substr($correctAnswerColumn, 0, -1) . strtoupper(substr($correctAnswerColumn, -1)); // Capitalize last letter
                        $correctAnswer = $question[$correctAnswerColumn]; // Access the content

                        if (strcasecmp(trim($userAnswer), trim($correctAnswer)) == 0) {
                            $correctAnswers++;
                        }
                    } elseif ($question['questiontype'] == "TOF" || $question['questiontype'] == "IDEN") {
                        if (strcasecmp(trim($userAnswer), trim($question['answer'])) == 0) {
                            $correctAnswers++;
                        }
                    }
                }
            }
        }

        // Calculate accuracy
        $accuracy = ($totalQuestions > 0) ? ($correctAnswers / $totalQuestions) * 100 : 0;

        // Fetch quiz information
        $quizInfoStmt = $pdo->prepare("SELECT title, code, creator FROM quizlisttable WHERE code = ?");
        $quizInfoStmt->execute([$quizCode]);
        $quizInfo = $quizInfoStmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Summary</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .summary-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 800px; /* Adjust the max-width as needed */
            width: 90%;
        }

        .user-quiz-info {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .panel {
            background-color: #FCBF49;
            border-radius: 1.5rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            text-align: center;
            color: black;
            width: 48%; /* Adjust the width for panels */
        }

        .summary-heading {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: black;
        }

        .summary-text {
            font-size: 18px;
            margin-bottom: 20px;
            color: black;
        }

        .try-again,
        .retake-quiz,
        .view-leaderboard {
            font-size: 16px;
            color: #3498db;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #ecf0f1;
            transition: background-color 0.3s;
        }

        .try-again:hover,
        .retake-quiz:hover,
        .view-leaderboard:hover {
            background-color: #bdc3c7;
        }
    </style>
</head>

<body>

    <div class="summary-container">
        <div class="user-quiz-info">
            <div class="panel">
                <div class="summary-heading">User Details</div>
                <div class="summary-text">
                    <p>User: <?= $username ?></p>
                </div>
            </div>

            <div class="panel">
                <div class="summary-heading">Quiz Information</div>
                <div class="summary-text">
                    <p>Title: <?= $quizInfo['title'] ?></p>
                    <p>Code: <?= $quizInfo['code'] ?></p>
                    <p>Creator: <?= $quizInfo['creator'] ?></p>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="summary-heading">Quiz Results</div>
            <div class="summary-text">
                <p>Accuracy: <?= number_format($accuracy, 2) ?>%</p>
                <p>Correct Answers: <?= $correctAnswers ?></p>
                <p>Incorrect Answers: <?= $totalQuestions - $correctAnswers ?></p>
            </div>
            <a href="List.php" class="btn btn-primary try-again">Try Another Quiz</a>
            <a href="answerQuiz.php?code_for_quiz=<?= $quizCode ?>" class="btn btn-success retake-quiz">Retake Quiz</a>
            <a href="leaderboard.php?quizCode=<?= $quizCode ?>" class="btn btn-info view-leaderboard">View Leaderboard</a>
        </div>
    </div>

</body>

</html>
