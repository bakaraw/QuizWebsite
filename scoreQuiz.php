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

                    if ($question['questiontype'] == "MCQ") {
                        $correctAnswerColumn = $question['answer'];
                        $correctAnswerColumn = strtolower($correctAnswerColumn);
                        $correctAnswerColumn = substr($correctAnswerColumn, 0, -1) . strtoupper(substr($correctAnswerColumn, -1));
                        $correctAnswer = $question[$correctAnswerColumn];

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

        $accuracy = ($totalQuestions > 0) ? ($correctAnswers / $totalQuestions) * 100 : 0;

        $quizInfoStmt = $pdo->prepare("SELECT title, code, creator FROM quizlisttable WHERE code = ?");
        $quizInfoStmt->execute([$quizCode]);
        $quizInfo = $quizInfoStmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT score FROM quiz_scores WHERE username = ? AND code = ?");
        $stmt->execute([$username, $quizCode]);

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $existingScore = $row['score'];
            $cumulativeScore = $correctAnswers;

            $updateStmt = $pdo->prepare("UPDATE quiz_scores SET score = ? WHERE username = ? AND code = ?");
            $updateStmt->execute([$cumulativeScore, $username, $quizCode]);
        } else {
            $insertStmt = $pdo->prepare("INSERT INTO quiz_scores (username, code, score) VALUES (?, ?, ?)");
            $insertStmt->execute([$username, $quizCode, $correctAnswers]);
        }

        $decrement_value = 1;
        $stmt = $pdo->prepare("SELECT max_attempts FROM quizlisttable WHERE code = :quizcode");
        $stmt->bindParam(':quizcode', $quizCode);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['max_attempts'] != -1) {
                $updateStmt = $pdo->prepare("UPDATE user_quiz_attempts SET remaining_attempts = remaining_attempts - :decrement_value WHERE username = :username AND quizcode = :quizcode");
                $updateStmt->bindParam(':username', $username);
                $updateStmt->bindParam(':quizcode', $quizCode);
                $updateStmt->bindParam(':decrement_value', $decrement_value);
                $updateStmt->execute();
            }
        }
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
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #f2f2f2;
            /* display: flex; */
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .summary-container {
            /* display: flex; */
            flex-direction: column;
            align-items: center;
            max-width: 800px;
            width: 90%;
            box-sizing: border-box;
        }

        .user-quiz-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
        }

        .panel {
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            text-align: center;
            color: black;
            width: 100%;
            box-sizing: border-box;
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
            text-decoration: none;
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            width: 100%;
        }

        .try-again {
            background-color: #fbbb4b;
            color: white;
        }

        .try-again:hover {
            background-color: #ec9424;
        }

        .retake-quiz {
            background-color: #198653;
            color: white;
        }

        .retake-quiz:hover {
            background-color: #0b633a;
        }

        .view-leaderboard {
            background-color: #3498db;
            color: white;
        }

        .view-leaderboard:hover {
            background-color: #bdc3c7;
        }

        .leaderboard-table {
            width: 100%;
        }

        @media (min-width: 768px) {
            .panel {
                width: calc(50% - 20px);
            }
        }
    </style>
</head>

<body>
    

    <div class="summary-container container">
        <div class="user-quiz-info">
            <div class="panel user-details">
                <div class="summary-heading">User Details</div>
                <div class="summary-text">
                    <p>User: <?= $username ?></p>
                </div>
            </div>

            <div class="panel quiz-details">
                <div class="summary-heading">Quiz Details</div>
                <div class="summary-text">
                    <p>Title: <?= $quizInfo['title'] ?></p>
                    <p>Code: <?= $quizInfo['code'] ?></p>
                    <p>Creator: <?= $quizInfo['creator'] ?></p>
                </div>
            </div>

            <div class="panel leaderboard-panel">
                <div class="summary-heading">Leaderboard</div>
                <div class="summary-text">
                    <?php
                    $quizcode = $quizInfo['code'];

                    $sql = "SELECT username, score,
                            DENSE_RANK() OVER (ORDER BY score DESC) AS rank
                            FROM quiz_scores WHERE code=:quizcode LIMIT 5";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':quizcode', $quizcode);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0): ?>
                        <table class="table leaderboard-table">
                            <thead>
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $rank = $row['rank'];
                                    $username = $row['username'];
                                    $score = $row['score'];

                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $rank; ?>
                                        </td>
                                        <td>
                                            <?php echo $username; ?>
                                        </td>
                                        <td>
                                            <?php echo $score; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No users have attempted this quiz yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="panel quiz-results">
                <div class="summary-heading">Quiz Results</div>
                <div class="summary-text">
                    <p>Accuracy: <?= number_format($accuracy, 2) ?>%</p>
                    <p>Correct Answers: <?= $correctAnswers ?></p>
                    <p>Incorrect Answers: <?= $totalQuestions - $correctAnswers ?></p>
                </div>
                <a href="List.php" class="btn btn-primary try-again">Try Another Quiz</a>
                <a href="answerQuiz.php?code_for_quiz=<?= $quizCode ?>" class="btn btn-success retake-quiz">Retake Quiz</a>
                <a href="index.php" class="btn btn-info view-leaderboard">Go to Homepage</a>
            </div>
        </div>
    </div>

</body>

</html>
