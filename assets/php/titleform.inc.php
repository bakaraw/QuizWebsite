
<?php
$quiztitle = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['quiztitle'])) {

        $quiztitle = $_POST['quiztitle'];
        $quizcode = "";

        try {
            // include dtabase connector
            require_once "dbh_quiz.inc.php";
            // generate unique code
            $quizcode = generateQuizCode($pdo);

            // inserting Quizcode and title into database
            $query = "INSERT INTO quizlisttable(code, title) VALUE (?, ?);";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$quizcode, $quiztitle]);

            // creating separate table for every quizcode
            $query = "
            CREATE TABLE `$quizcode` (
                `question` text NOT NULL,
                `questiontype` text NOT NULL,
                `answer` text NOT NULL,
                `choiceA` text NOT NULL,
                `choiceB` text NOT NULL,
                `choiceC` text NOT NULL,
                `choiceD` text NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
              COMMIT;
              ALTER TABLE $quizcode
                ADD qid INT AUTO_INCREMENT PRIMARY KEY;

            ";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $pdo = null;
            $stmt = null;

            // passing variable values to create quiz page
            session_start();
            $_SESSION['quizcode'] = $quizcode;
            $_SESSION['quiztitle'] = $quiztitle;

            header("Location: ../../createQuiz.php");
            die();
        } catch (PDOException $e) {
            die("Query failed" . $e->getMessage());
        }
    }
} else {
    header("Location: ../../MakeQuiz.php");
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