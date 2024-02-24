<?php
session_start();
if (isset($_POST['quizcode'])) {
    // Retrieve the quiz code from the POST data
    $quizcode = $_POST['quizcode'];

    // Set the session variable
    $_SESSION['quizcode'] = $quizcode;

    // Optionally, you can respond with a success message
    echo "Session variable 'quizCode' set successfully.";
} else {
    // If quizCode is not provided in the POST data, respond with an error message
    echo "Quiz code not provided.";
}
