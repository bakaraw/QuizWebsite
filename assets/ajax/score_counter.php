<?php
session_start();
include "../php/dbh_quiz.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"])) {
    $newScore = 0; // This will hold the score for the current attempt
    $username = $_SESSION["username"];
    $quizCode = $_POST['quizCode'];
    try {
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

        // Fetch the existing score, if any
        $stmt = $pdo->prepare("SELECT score FROM quiz_scores WHERE username = ? AND code = ?");
        $stmt->execute([$username, $quizCode]);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $existingScore = $row['score'];
            $cumulativeScore = $newScore;

            // Update the cumulative score
            $updateStmt = $pdo->prepare("UPDATE quiz_scores SET score = ? WHERE username = ? AND code = ?");
            $updateStmt->execute([$cumulativeScore, $username, $quizCode]);
        } else {
            // If no existing score, insert the new score as is
            $insertStmt = $pdo->prepare("INSERT INTO quiz_scores (username, code, score) VALUES (?, ?, ?)");
            $insertStmt->execute([$username, $quizCode, $newScore]);
        }

        $decrement_value = 1;

        // Prepare and execute the SELECT query
        $stmt = $pdo->prepare("SELECT max_attempts FROM quizlisttable WHERE code = :quizcode");
        $stmt->bindParam(':quizcode', $quizCode);
        $stmt->execute();

        // Check if there are rows returned by the SELECT query
        if ($stmt->rowCount() > 0) {
            // Fetch the result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if max_attempts is not unlimited (-1)
            if ($row['max_attempts'] != -1) {
                // Prepare and execute the UPDATE query
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


    echo $newScore;
}

?>