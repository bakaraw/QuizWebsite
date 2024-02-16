<?php
include "../php/dbh_quiz.inc.";
$qucode = $_POST['quizcode'];
$qid = $_POST['qid'];

if (isset($_POST[$qid])) {
    // Prepare the DELETE SQL query
    $stmt = $pdo->prepare("DELETE FROM your_table_name WHERE qid = :qid");

    // Bind the value of $qid to the placeholder :qid
    $stmt->bindValue(':qid', $qid);

    // Execute the query
    $stmt->execute();

    header("Location: ../../createQuiz.php");
}
