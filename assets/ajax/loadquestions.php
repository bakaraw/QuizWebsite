<?php
include "../php/dbh_quiz.inc.php";

// Assuming $pdo is your PDO database connection

$quizcode = $_POST['quizcode'];

$sql = "SELECT * FROM `questions` WHERE quizcode = :quizcode";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Bind the parameter
$stmt->bindParam(':quizcode', $quizcode);

$stmt->execute();

// Check if there are rows returned
if ($stmt->rowCount() > 0) {
    // Fetch and display the results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='container ms-auto me-auto'>";
        echo "<div class=' rounded p-3 mt-3 shadow shadow-4 container-fluid' id='question-{$row['qid']}'>";

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
        echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <form method="post" id="question-' . $row['qid'] . '">
                    <input type="hidden"  name="quizcode" value="' . $quizcode . '">
                    <input type="hidden"  name="qid" value="' . $row['qid'] . '">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end" id="' . 'question' . $row['qid'] . '">
                    <button class="btn btn-info me-md-1 border border-light" type="submit" name="edit-' . $row['qid'] . '" id="edit-' . $row['qid'] . '" style="--bs-border-opacity: 0;">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="submit" name="delete-' . $row['qid'] . '" id="delete-' . $row['qid'] . '">
                        <img src="assets/img/icons/trash-fill.svg" alt="Delete" style="width: 20px; height: 20px; fill: white;">
                    </button>
                    </div>
                </form>
            </div>';
        echo "</div>";
        echo "</div>";
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
    }
}
