<?php
session_start();
require "assets/php/dbh_quiz.inc.php";
include "assets/php/head.inc.php";

$quizcode = $_SESSION['quizcode'];

$sql = "SELECT title,max_attempts FROM quizlisttable WHERE code=:quizcode";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':quizcode', $quizcode);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$title = $result['title'];
$max_attempts = $result['max_attempts'];


$sql = "SELECT * FROM quiz_scores WHERE code=:quizcode ORDER BY score DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':quizcode', $quizcode);
$stmt->execute();

?>

<div class="container">
    <div class="shadow m-5 p-3 rounded">
        <a href="MakeQuiz.php" class="btn btn-info" type="button">
            <i class="fa-solid fa-left-long"></i>
            go back
        </a>
        <br>
        <div class="m-5">
            <h1>
                <?php echo $title; ?>
            </h1>
            <h4>
                <?php echo $quizcode; ?>
            </h4>
            <p class="mt-4 fw-semibold">
                <?php
                if ($max_attempts == -1) {
                    echo "Unlimited attempts allowed.";
                } else {
                    echo "Max attempts: " . $max_attempts;
                }

                ?>
            </p>
            <h5 class="mt-5">
                Results:
            </h5>


            <?php
            if ($stmt->rowCount() > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Score</th>
                            <th scope="col">Remaining Attempts</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($num = 1; $row = $stmt->fetch(PDO::FETCH_ASSOC); $num++) {
                            $number = 1;
                            $username = $row['username'];
                            $score = $row['score'];

                            $query = "SELECT remaining_attempts FROM user_quiz_attempts WHERE quizcode=:quizcode AND username=:username";
                            $attemptstmt = $pdo->prepare($query);
                            $attemptstmt->bindParam(':quizcode', $quizcode);
                            $attemptstmt->bindParam(':username', $username);
                            $attemptstmt->execute();

                            $attemptresult = $attemptstmt->fetch(PDO::FETCH_ASSOC);

                            $remaining_attempts = $attemptresult['remaining_attempts'];

                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $num; ?>
                                </th>
                                <td>
                                    <?php echo $username; ?>
                                </td>
                                <td>
                                    <?php echo $score; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($remaining_attempts == -1) {
                                        echo "Unli attempts";
                                    } else {
                                        echo $remaining_attempts;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php

                        }
            else:
                ?>
                        <div class="alert alert-danger" role="alert">No users have attempted this quiz yet.</div>
                        <?php
            endif;
            ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "assets/php/head.inc.php"; ?>