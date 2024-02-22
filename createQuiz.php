<?php
include "assets/php/dbh_quiz.inc.php";
session_start();
$quizcode = $_SESSION['quizcode'];
$quiztitle = $_SESSION['quiztitle'];

?>

<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<div class="container">
    <!-- title box -->
    <div class="container mt-5 mb-5"></div>
    <form action="" method="post" id="share-form">
        <div class="input-group mb-3 border-light">
            <span class="input-group-text bg-dark text-light border-light" id="inputGroup-sizing-default" style="--bs-bg-opacity: .05; --bs-border-opacity: .2; --bs-text-opacity: .75;">Quiz title</span>
            <input type="text" class="form-control bg-dark text-light border-light me-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="--bs-bg-opacity: .05;  --bs-border-opacity: .2;" value="<?php echo $quiztitle; ?>" name="title-input">
            <button class="btn btn-success text-light border-dark btn-md" type="submit" data-bs-toggle="modal" data-bs-target="#shareModal" name="share-btn">Share</button>
        </div>
    </form>

    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="text" value="<?php echo $quizcode; ?>" id="quizcode-copy" style="display: none;">
                    <h4 class="text-break mb-3" id="title-modal">
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="new-title">
                    <input type="hidden" id="access-option">
                    <label class="fw-medium ms-3 mb-0">General access</label>
                    <div class="mt-0 access-div">
                        <div class="dropdown border border-dark d-flex flex-row align-items-center ms-3" style="--bs-border-opacity: 0;">
                            <div class="text-dark">
                                <i class="fa-solid fa-lock" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>
                            </div>
                            <select class="form-select transparent-btn border border-dark fw-semibold access-option" aria-label="Default select example" style="width: 100px; --bs-border-opacity: 0;">
                                <option selected value="PRIVATE">Private</option>
                                <option value="PUBLIC">Public</option>
                            </select>

                            <p class="mt-3">People can only access with link/code</p>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Public</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-4 mb-3 ms-3 me-3">
                        <label for="formFile" class="form-label fw-medium" accept=".jpeg, .jpg, .png">Quiz Thumbnail (Optional)</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-outline-secondary me-auto border border-dark" style="--bs-border-opacity: 0;" id="copy-code" onclick="buttonC()" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                        <i class="fa-regular fa-copy"></i> Copy code
                    </button>

                    <button type="button" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <hr class="border border-light">

    <!-- div pang append sa questions -->
    <div class="row justify-content-center">
        <div class="col" id="questions">
            <?php

            // Prepare the SQL query
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
                    echo "<div class='bg-black rounded p-3 mt-3 shadow shadow-4 border border-light text-light container-fluid' style='--bs-bg-opacity: .2; --bs-border-opacity: .2; --bs-text-opacity: .70;' id='question-{$row['qid']}'>";

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
                    <button class="btn btn-warning me-md-1 border border-light" type="submit" name="edit-' . $row['qid'] . '" id="edit-' . $row['qid'] . '" style="--bs-border-opacity: 0;">
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



            ?>
        </div>
    </div>


    <div class="form" id="questionform-div">
        <form class="needs-validation" method="post" id="questionform" name="questionform">
            <div class="shadow bg-black border border-light p-3 rounded-4 mt-3" style="--bs-bg-opacity: .2; --bs-border-opacity: .2;">

                <!-- select option element (quiztype) -->
                <div class="input-group mb-3">
                    <label class="input-group-text bg-dark text-light border-light" style="--bs-border-opacity: .2; --bs-text-opacity: .70;">Question Type</label>
                    <select onchange="changeQuizType()" class="form-select bg-dark text-light border-light" id="questiontype" style="--bs-border-opacity: .2;  --bs-text-opacity: .75; width:10rem;" name="questiontype">
                        <option selected value="IDEN">Identification</option>
                        <option value="MCQ">Multiple Choice Question</option>
                        <option value="TOF">True or False</option>
                    </select>

                </div>

                <!-- for question text area -->
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label text-light" style="--bs-text-opacity: .7;">Question:</label>
                    <textarea type="text" class="form-control bg-dark text-light border-light" id="exampleFormControlTextarea1" rows="3" style="--bs-border-opacity: .2;" name="question" required></textarea>
                    <div class="invalid-feedback text-danger">
                        Please enter a question.
                    </div>
                </div>


                <!-- changing div based on the question type -->
                <div id="questiontype_gui">
                    <input class="form-control bg-dark text-light border-light" type="text" placeholder="Answer" aria-label="default input example" style="--bs-border-opacity: .2;" name="answerIden" required>
                    <div class="invalid-feedback text-danger">
                        Please enter the answer.
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <button class="btn btn-warning text-dark border-dark btn-md" type="submit" name="save-btn" id="save-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-light add-btn mb-3" id="add-question" name="add-question">
                <img src="assets/img/icons/plus-circle.svg" alt="Add Question" style="width: 24px; height: 24px; fill: white;"> <label class="ms-2">Add Question</label>
            </button>
        </div>
    </div>
    <script>
        // pag send data sa database
        const questionFormDiv = document.getElementById('questionform-div');

        $(document).ready(function() {

            $('#share-form').submit(function(e) {
                e.preventDefault();
                var title = $('input[name="title-input"]').val();
                var pubtxt = "Publish \"" + title + "\""; // Get the value of title-input
                $('#title-modal').text(pubtxt);
                $('#new-title').val(title);
                $('#publishModal').modal('show');
            });

            $('#questionform').submit(function(e) {
                e.preventDefault();
                let questionform = $('#questionform').serialize();
                questionform += '&quizcode=<?php echo $quizcode; ?>';
                saveQuestion(questionform);

                $('#questionform-div').hide();

                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 'fast');

            });

            $('#add-question').click(function(e) {
                e.preventDefault();
                let questionform = $('#questionform').serialize();
                questionform += '&quizcode=<?php echo $quizcode; ?>';

                saveQuestion(questionform);
                if (questionFormDiv.style.display === 'none') {
                    questionFormDiv.style.display = 'block';
                }
                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 'fast');
            });
        });

        function saveQuestion(questionform) {
            $.ajax({
                type: "POST",
                url: "assets/ajax/questionform_dbh.php",
                data: questionform,
                success: function(response) {
                    console.log('addque-pressed success');
                    console.log(response);
                    if (isFormFilled()) {
                        clearForm();
                        loadQuestions();
                    }
                    window.scrollTo({
                        top: document.body.scrollHeight,
                        behavior: 'smooth' // Smooth scrolling
                    });



                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // loads saved questions
        function loadQuestions() {
            $('#questions').load("assets/ajax/loadquestions.php", {
                quizcode: '<?php echo $quizcode; ?>'
            });
        }

        function removeScriptElement(scriptID) {
            var scriptElement = document.getElementById(scriptID);
            scriptElement.parentNode.removeChild(scriptElement);
            console.log('removed successfully');
        }

        // Reset the form fields
        function clearForm() {
            var selectElement = document.getElementById("questiontype");
            var currentQuestiontypeIndex = selectElement.selectedIndex;

            $('#questionform')[0].reset();
            selectElement.selectedIndex = currentQuestiontypeIndex;

            $('#questionform').removeClass('was-validated');
        }

        function isFormFilled() {
            var form = document.getElementById("questionform");
            for (var i = 0; i < form.elements.length; i++) {
                var element = form.elements[i];
                if (element.type !== "button" && element.value.trim() === "" && element.type !== "submit") {
                    // If any field is empty, return false
                    return false;
                }
            }
            // If all fields are filled, return true
            return true;
        }

        var text = document.getElementById("quizcode-copy");

        function buttonC() {
            text.select();
            navigator.clipboard.writeText(text.value.trim())
                .then(() => {
                    console.log('Copied')
                })
                .catch(err => {
                    console.log('Something went wrong', err);
                })
            
            var copyBtn = document.querySelector("#copy-code");
            copyBtn.classList.add("active");
            setTimeout(function(){
                copyBtn.classList.remove("active");
            }, 2500);
        }
    </script>
    <script src="./assets/js/createQuiz.js"></script>

    <?php require('assets/php/footer.inc.php'); ?>