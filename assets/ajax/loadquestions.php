<?php
include "../php/dbh_quiz.inc.php";

// Assuming $pdo is your PDO database connection

$quizcode = $_POST['quizcode'];

// Prepare the SQL query
$sql = "SELECT * FROM $quizcode";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Execute the statement
$stmt->execute();

// Check if there are rows returned
if ($stmt->rowCount() > 0) {
    // Fetch and display the results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='container ms-auto me-auto'>";
        echo "<div class='bg-black rounded p-3 mt-3 shadow shadow-4 border border-light text-light container-fluid' style='--bs-bg-opacity: .2; --bs-border-opacity: .2; --bs-text-opacity: .70;'>";

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
                <button class="btn btn-warning me-md-1" type="button">
                    Edit
                </button>
                <button class="btn btn-danger" type="button">
                    <img src="assets/img/icons/trash-fill.svg" alt="Add Question" style="width: 18px; height: 18px; fill: white;">
                </button>
            </div>';
        echo "</div>";
        echo "</div>";
    }
}
