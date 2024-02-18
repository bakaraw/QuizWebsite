<?php
include "../php/dbh_quiz.inc.php";
$qid = $_POST['qid'];
$quizcode = $_POST['quizcode'];
$questionform = $_POST['questionform'];

parse_str($questionform, $questionData);

$question = $questionData['question' . $qid];
$questiontype = $questionData['questiontype' . $qid];

try {
    switch ($questiontype) {
        case "IDEN":
            $answer = $questionData['answerIden'];
            $stmt = $pdo->prepare("UPDATE $quizcode SET question=:question, questiontype=:questiontype, answer=:answer WHERE qid=:qid");

            // Bind parameters
            $stmt->bindParam(':question', $question);
            $stmt->bindParam(':questiontype', $questiontype);
            $stmt->bindParam(':answer', $answer);
            $stmt->bindParam(':qid', $qid);
            break;
        case "MCQ":
            $answer = $questionData['answerMCQ'];
            $choiceA = $questionData['choiceA'];
            $choiceB = $questionData['choiceB'];
            $choiceC = $questionData['choiceC'];
            $choiceD = $questionData['choiceD'];

            $stmt = $pdo->prepare("UPDATE $quizcode SET question=:question, questiontype=:questiontype, answer=:answer, choiceA=:choiceA, choiceB=:choiceB, choiceC=:choiceC, choiceD=:choiceD WHERE qid=:qid");

            // Bind parameters
            $stmt->bindParam(':question', $question);
            $stmt->bindParam(':questiontype', $questiontype);
            $stmt->bindParam(':answer', $answer);
            $stmt->bindParam(':choiceA', $choiceA);
            $stmt->bindParam(':choiceB', $choiceB);
            $stmt->bindParam(':choiceC', $choiceC);
            $stmt->bindParam(':choiceD', $choiceD);
            $stmt->bindParam(':qid', $qid);

            break;
        case "":
            $answer = $questionData['answerTOF'];
            $stmt = $pdo->prepare("UPDATE $quizcode SET question=:question, questiontype=:questiontype, answer=:answer WHERE qid=:qid");

            // Bind parameters
            $stmt->bindParam(':question', $question);
            $stmt->bindParam(':questiontype', $questiontype);
            $stmt->bindParam(':answer', $answer);
            $stmt->bindParam(':qid', $qid);
            break;
        default:
            echo "Invalid question type";
    }

    // Execute the statement
    $stmt->execute();

    echo "Record updated successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null; // Close the connection

echo $quizcode;
echo "<br>";
echo $questiontype;
echo "<br>";
echo $answer;

?>
