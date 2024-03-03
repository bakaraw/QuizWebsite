<?php
include "../php/dbh_quiz.inc.php";
$quizcode = $_POST['quizcode'];
$new_access = $_POST['access'];

try {
    $stmt = $pdo->prepare("UPDATE `quizlisttable` SET accessibility=:access WHERE code=:quizcode");
    $stmt->bindParam(':access', $new_access); 
    $stmt->bindParam(':quizcode', $quizcode);
    $stmt->execute();

    echo "Record updated successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
