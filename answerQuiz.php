<?php
include "assets/php/dbh_quiz.inc.php";
session_start();

if (isset($_GET['code_for_quiz'])) {
    $quizCode = htmlspecialchars($_GET['code_for_quiz']);

    // Assuming $pdo is your PDO database connection instance

    // Fetch quiz details, including 'views'
    $fetchSql = "SELECT * FROM quizlisttable WHERE code = ?";
    $fetchStmt = $pdo->prepare($fetchSql);
    $fetchStmt->execute([$quizCode]);
    $quizDetails = $fetchStmt->fetch(PDO::FETCH_ASSOC);

    if ($quizDetails) {
        // Increment the 'views' count
        $updateSql = "UPDATE quizlisttable SET views = views + 1 WHERE code = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$quizCode]);

        // Fetch questions related to the quiz
        $fetchSql = "SELECT * FROM `questions` WHERE quizcode = ?";
        $fetchStmt = $pdo->prepare($fetchSql);
        $fetchStmt->execute([$quizCode]);
        $questions = $fetchStmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo 'Quiz not found.';
        exit;
    }
}
?>

<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<div class="container">
    <form action="submit_quiz.php" method="post">
        <?php foreach ($questions as $question): ?>
            <div class="container ms-auto me-auto">
                <div class="bg-black rounded p-3 mt-3 shadow shadow-4 border border-light text-light container-fluid" style="--bs-bg-opacity: .2; --bs-border-opacity: .2; --bs-text-opacity: .70;">
                    <h5><strong>Question:</strong> <?php echo $question['question']; ?></h5>
                    
                    <?php if ($question['questiontype'] == "MCQ"): ?>
                        <div>
                            <input type="radio" name="answer[<?php echo $question['qid']; ?>]" value="A"> A. <?php echo $question['choiceA']; ?><br>
                            <input type="radio" name="answer[<?php echo $question['qid']; ?>]" value="B"> B. <?php echo $question['choiceB']; ?><br>
                            <input type="radio" name="answer[<?php echo $question['qid']; ?>]" value="C"> C. <?php echo $question['choiceC']; ?><br>
                            <input type="radio" name="answer[<?php echo $question['qid']; ?>]" value="D"> D. <?php echo $question['choiceD']; ?><br>
                        </div>
                    <?php elseif ($question['questiontype'] == "TOF"): ?>
                        <div>
                            <input type="radio" name="answer[<?php echo $question['qid']; ?>]" value="True"> True<br>
                            <input type="radio" name="answer[<?php echo $question['qid']; ?>]" value="False"> False<br>
                        </div>
                    <?php elseif ($question['questiontype'] == "IDEN"): ?>
                        <div>
                            <input type="text" name="answer[<?php echo $question['qid']; ?>]" placeholder="Enter your answer" required>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
            <button class="btn btn-success text-light border-dark btn-md" type="submit" name="submit-quiz">Submit Quiz</button>
        </div>
    </form>
</div>

<?php require('assets/php/footer.inc.php'); ?>
