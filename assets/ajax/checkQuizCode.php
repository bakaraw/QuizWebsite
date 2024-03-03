<?php
include "../php/dbh_quiz.inc.php";
$quizcode = $_POST['quizcode'];

try {
    // Prepare a PDO statement to select rows with the given quizcode
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM quizlisttable WHERE code = :quizcode");
    $stmt->bindParam(':quizcode', $quizcode);
    $stmt->execute();

    // Fetch the result (number of rows with the given quizcode)
    $rowCount = $stmt->fetchColumn();

    // Check if any row with the given quizcode exists
    if ($rowCount > 0) {
        // Quizcode exists, return a success message or any other indication
        echo "exists";
    } else {
        // Quizcode does not exist, return an appropriate response
        echo "not_exists";
    }
} catch (PDOException $e) {
    // Handle any potential errors
    echo "Error: " . $e->getMessage();
}
