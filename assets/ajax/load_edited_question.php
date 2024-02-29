<?php
include "../php/dbh_quiz.inc.php";
$qid = $_POST['qid'];
$quizcode = $_POST['quizcode'];

$sql = "SELECT * FROM `questions` WHERE qid = :qid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':qid', $qid);

// Execute the SQL statement
$stmt->execute();

// Fetch the result row
$row = $stmt->fetch();

if ($row) {

    switch ($row['questiontype']) {
        case "IDEN":
            echo "<h5><strong>Question type:</strong> Identification</h5>";
            break;
        case "MCQ":
            echo "<h5><strong>Question type:</strong> Multiple Choice Question</h5>";
            echo "<br>";
            break;
        case "TOF":
            echo "<h5><strong>Question type:</strong> True or False</h5>";
            break;
        default:
            echo "<h5>error in question type</h5>";
    }

    echo "<br>";
    echo "<p class='text-break'>";
    echo "<strong>Question:</strong> {$row['question']}";

    if ($row['questiontype'] == "MCQ") {
        echo "<br>";
        echo "A. {$row['choiceA']} ";
        echo "<br>";

        echo "B. {$row['choiceB']}";
        echo "<br>";

        echo "C. {$row['choiceC']}";
        echo "<br>";

        echo "D. {$row['choiceD']}";
    }

    echo "<br>";
    echo "<br>";
    echo "<strong>Answer:</strong> {$row['answer']}";
    echo "</p>";
    echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end">';
    echo '<form method="post" id="question-' . $row['qid'] . '">';
    echo '<input type="hidden"  name="quizcode" value="' . $quizcode . '">';
    echo '<input type="hidden"  name="qid" value="' . $row['qid'] . '">';
    echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end" id="' . 'question' . $row['qid'] . '">';
    echo '<button class="btn btn-info me-md-1 border border-light" type="submit" name="edit-' . $row['qid'] . '" id="edit-' . $row['qid'] . '" style="--bs-border-opacity: 0;">';
    echo "Edit";
    echo '</button>';
    echo '<button class="btn btn-danger" type="submit" name="delete-' . $row['qid'] . '" id="delete-' . $row['qid'] . '">';
    echo '<img src="assets/img/icons/trash-fill.svg" alt="Delete" style="width: 20px; height: 20px; fill: white;">';
    echo '</button>';
    echo '</div>';
    echo '</form>';
    echo '</div>';

    echo "<script>";
    echo '
        $(document).ready(function () {
            $("#delete-' . $row['qid'] . '").click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "assets/ajax/del_question.php",
                    data: {
                        qid: ' . $row['qid'] . ',
                        quizcode: "' . $quizcode . '"
                    },
                    success: function (response) {
                        console.log(response);
                        loadQuestions();
                    }
                });
            });

            $("#edit-' . $row['qid'] . '").click(function (e) { 
                e.preventDefault();
                console.log("idit");
                $("#question-' . $row['qid'] . '").load("assets/ajax/update_question.php", {
                    qid: "' . $row['qid'] . '",
                    quizcode: "' . $quizcode . '",
                    questiontype: "' . $row['questiontype'] . '",
                    question: "' . $row['question'] . '",
                    answer: "' . $row['answer'] . '",
                    choiceA: "' . $row['choiceA'] . '",
                    choiceB: "' . $row['choiceB'] . '",
                    choiceC: "' . $row['choiceC'] . '",
                    choiceD: "' . $row['choiceD'] . '"
                });
            });
        });
        ';
    echo "</script>";
} else {
    echo "Question not found.";
}
