<?php
include "../php/dbh_quiz.inc.php";
$quizcode = $_POST['quizcode'];

// deletes first the uploaded thumbnail of the quiz if thumbnail != 'default_img.jpg'
$stmt = $pdo->prepare("SELECT thumbnail FROM quizlisttable WHERE code = ?");
$stmt->execute([$quizcode]);
$result = $stmt->fetch();

if ($result && $result['thumbnail'] !== 'default_img.jpg') {
    $thumbnailFilename = $result['thumbnail'];
    $filePath = '../img/uploads/' . $thumbnailFilename;

    // Check if the file exists before attempting to delete it
    if (file_exists($filePath)) {
        // Attempt to delete the file
        if (unlink($filePath)) {
        } else {
            echo "Failed to delete file $thumbnailFilename.";
        }
    } else {
        // File does not exist
        echo "File $thumbnailFilename does not exist.";
    }
}

$sql = "DELETE FROM quiz_scores WHERE code = :quizcode";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':quizcode', $quizcode);
$stmt->execute();

$sql = "DELETE FROM user_quiz_attempts WHERE quizcode = :quizcode";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':quizcode', $quizcode);
$stmt->execute();

// then proceeds to delete questions associated with the quizcode in questions table
$sql = "DELETE FROM questions WHERE quizcode = :quizcode";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':quizcode', $quizcode);
$stmt->execute();

// lastly dletes that row associated with the quizcode in quizlisttable
$sql = "DELETE FROM quizlisttable WHERE code = :quizcode";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':quizcode', $quizcode);
$stmt->execute();
