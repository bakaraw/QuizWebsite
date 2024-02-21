<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page or show an error
    header("Location: login.php");
    exit;
}



$quiztitle = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quiztitle'])) {

    $quiztitle = $_POST['quiztitle'];
    $creator = $_SESSION['username']; // Assuming the username is stored in the session upon login

    try {
        // Include database connector
        require_once "dbh_quiz.inc.php";

        // Generate unique code
        $quizcode = generateQuizCode($pdo);

        // Inserting Quizcode, title, and username into database
        $query = "INSERT INTO quizlisttable(code, title, creator) VALUES (?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$quizcode, $quiztitle, $creator]);

        // Creating separate table for every quizcode
        // Note: Dynamically creating tables like this is generally not recommended. Consider storing all questions in a single table with a reference to the quiz code instead.
        $query = "CREATE TABLE `$quizcode` (
                    `qid` INT AUTO_INCREMENT PRIMARY KEY,
                    `question` TEXT NOT NULL,
                    `questiontype` TEXT NOT NULL,
                    `answer` TEXT NOT NULL,
                    `choiceA` TEXT NOT NULL,
                    `choiceB` TEXT NOT NULL,
                    `choiceC` TEXT NOT NULL,
                    `choiceD` TEXT NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Passing variable values to create quiz page
        $_SESSION['quizcode'] = $quizcode;
        $_SESSION['quiztitle'] = $quiztitle;

        header("Location: ../../createQuiz.php");
        exit;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../MakeQuiz.php");
    exit;
}

// for generating random string
function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// returns unique quizcode
function generateQuizCode($pdo)
{
    do {
        $quizcode = "$" . generateRandomString(7);
        $stmt = $pdo->prepare("SELECT * FROM quizlisttable WHERE code = ?");
        $stmt->execute([$quizcode]);
    } while ($stmt->rowCount() > 0);

    return $quizcode;
}

?>