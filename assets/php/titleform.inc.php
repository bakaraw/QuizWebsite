// make code generator

<?php
$quiztitle = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['quiztitle'])) {
        $quiztitle = $_POST['quiztitle'];
        
        // echo $quiztitle;
        try {
           require_once "dbh_quiz.inc.php";

           $query = "INSERT INTO quizlisttable(code, title) VALUE (?, ?);";
           
           $stmt = $pdo->prepare($query);
           
           $stmt->execute(["zzzz", $quiztitle]);
           
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
?>