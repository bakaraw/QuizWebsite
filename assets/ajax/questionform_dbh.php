<?php
include('../php/dbh_quiz.inc.php');

$question = $_POST['question'];
$question_type = $_POST['questiontype'];
$quizcode = $_POST['quizcode'];

if ($question != ""){
    $query = "INSERT INTO $quizcode (question,questiontype) VALUES (:question, :questiontype)";
    $stmt = $pdo->prepare($query);

    // Bind parameters
    $stmt->bindParam(':question', $question);
    $stmt->bindParam(':questiontype', $question_type);

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . $stmt->errorInfo()[2];
    }
}

