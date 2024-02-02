// make code generator

<?php
$quiztitle = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['quiztitle'])) {
        $quiztitle = $_POST['quiztitle'];
        $quizcode = "";
        
        echo $quiztitle;
        try {
           require_once "dbh_quiz.inc.php";
           $quizcode = generateQuizCode($pdo);
           
           $query = "INSERT INTO quizlisttable(code, title) VALUE (?, ?);";
           $stmt = $pdo->prepare($query);
           $stmt->execute([$quizcode, $quiztitle]);
           $pdo = null;
           $stmt = null;
           header("Location: ../../createQuiz.php");
           die();

        } catch (PDOException $e) {
            die("Query failed" . $e->getMessage());
        }
    } else {
        $quiztitle = "holy";
    }
    
} else {
    header("Location: ../../MakeQuiz.php");
}

// for generating random string
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// returns unique quizcode
function generateQuizCode($pdo){
    do{
        $quizcode = generateRandomString(7);
        $stmt = $pdo->prepare("SELECT * FROM quizlisttable WHERE code = ?");
        $stmt->execute([$quizcode]);
    }while ($stmt->rowCount() > 0);

    return $quizcode;
}

?>