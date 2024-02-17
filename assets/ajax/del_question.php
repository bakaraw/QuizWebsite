<?php
include "../php/dbh_quiz.inc.php";

$qid = $_POST['qid'];
$quizcode = $_POST['quizcode'];
$sql = "DELETE FROM $quizcode WHERE qid = :qid";

// Prepare the SQL statement
$stmt = $pdo->prepare($sql);

// Bind the qid value to the place holder
$stmt->bindValue(':qid', $qid);

// Execute the SQL statement
$stmt->execute();

// Close the database connection
$pdo = null;