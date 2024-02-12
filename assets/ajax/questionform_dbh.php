<?php
include('../php/dbh_quiz.inc.php');

$question = $_POST['question'];
$question_type = $_POST['questiontype'];
$quizcode = $_POST['quizcode'];
$answer = null;
$choices = null;
$query = null;

// save question and answer based on the question type
switch ($question_type) {
    case "IDEN":
        $answer = $_POST['answerIden'];
        $query = "INSERT INTO $quizcode (question,questiontype,answer) VALUES (:question, :questiontype, :answer)";
        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':questiontype', $question_type);
        $stmt->bindParam(':answer', $answer);
        break;

    case "MCQ":
        $answer = $_POST['answerMCQ'];
        $choices = [
            "A" => $_POST['choiceA'],
            "B" => $_POST['choiceB'],
            "C" => $_POST['choiceC'],
            "D" => $_POST['choiceD']
        ];

        $query = "
            INSERT INTO $quizcode (question, questiontype, answer, choiceA, choiceB, choiceC, choiceD) 
            VALUES (:question, :questiontype, :answer, :choiceA, :choiceB, :choiceC, :choiceD)
        ";
        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':questiontype', $question_type);
        $stmt->bindParam(':answer', $answer);
        $stmt->bindParam(':choiceA', $choices['A']);
        $stmt->bindParam(':choiceB', $choices['B']);
        $stmt->bindParam(':choiceC', $choices['C']);
        $stmt->bindParam(':choiceD', $choices['D']);

        break;

    case "TOF";
        $answer = $_POST['answerTOF'];
        $query = "INSERT INTO $quizcode (question,questiontype,answer) VALUES (:question, :questiontype, :answer)";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':questiontype', $question_type);
        $stmt->bindParam(':answer', $answer);

        break;

    default:
        echo "iror";
        break;
}

if ($question != "" && $answer != null) {
    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . $stmt->errorInfo()[2];
    }
}
