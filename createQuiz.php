<?php
include "assets/php/dbh_quiz.inc.php";
session_start();
$quizcode = $_SESSION['quizcode'];

$sql = "SELECT * FROM `quizlisttable` WHERE code = :quizcode";

$private_selected = "";
$public_selected = "";
$unli_attempts_checked = "";
$attempts_input_disbled = "";
$max_attempts = "";
// for access option
// Prepare the statement
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':quizcode', $quizcode);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $access_option = $row['accessibility'];
    $quiztitle = $row['title'];


    if ($access_option == "PRIVATE") {
        $private_selected = "selected";
    } else {
        $public_selected = "selected";
    }

    if ($row['max_attempts'] == -1) {
        $unli_attempts_checked = 'checked';
        $attempts_input_disbled = 'disabled';
    } else {
        $max_attempts = $row['max_attempts'];
    }
}


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
            <span class="input-group-text solid-shadow-orange bg-orange fw-medium" id="inputGroup-sizing-default ">Quiz
                title</span>
            <input type="text" class="form-control me-3 solid-shadow" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-default" value="<?php echo $quiztitle; ?>" name="title-input">
            <button class="btn btn-success text-light border-dark btn-md" type="submit" data-bs-toggle="modal"
                data-bs-target="#shareModal" name="share-btn">
                Share
            </button>
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
                <form action="assets/php/quiz_finalization.php" method="post" enctype="multipart/form-data"
                    id="quiz-settings-form">
                    <div class="modal-body">

                        <label class="fw-medium ms-3 mb-0">General access</label>
                        <div class="mt-0 access-div mb-4">
                            <div class="dropdown border border-dark d-flex flex-row align-items-center ms-3"
                                style="--bs-border-opacity: 0;">
                                <div class="text-dark" id="access-icon">
                                    <?php
                                    if ($access_option == "PRIVATE") {
                                        echo '<i class="fa-solid fa-lock" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>';
                                    } else {
                                        echo '<i class="fa-solid fa-earth-americas" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>';
                                    }

                                    ?>
                                </div>

                                <select class="form-select transparent-btn border border-dark fw-semibold access-option"
                                    aria-label="Default select example" style="width: 100px; --bs-border-opacity: 0;"
                                    onchange="changeAccess()" id="access-option" name="access-option">
                                    <option <?php echo $private_selected; ?> value="PRIVATE">Private</option>
                                    <option <?php echo $public_selected; ?> value="PUBLIC">Public</option>
                                </select>

                                <?php
                                if ($access_option == "PRIVATE") {
                                    echo '<p class="mt-3" id="access-desc">Only people with link/code can access</p>';
                                } else {
                                    echo '<p class="mt-3" id="access-desc">Anyone can access</p>';
                                }

                                ?>
                            </div>
                        </div>
                        <div class="mb-4">
                            <input type="hidden" id="new-title" name="new-title">
                            <label class="fw-medium ms-3 mb-0">Set Attempts</label>
                            <div class="access-div pb-2 pt-2">
                                <div class="form-check form-switch ms-3 mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" <?php echo $unli_attempts_checked; ?>
                                        name="is_unli_attempts">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Unlimited
                                        Attempts</label>
                                </div>
                                <div class="ms-3 me-3">
                                    <input class="form-control form-control-sm" type="text" id="attemptsInput"
                                        value="<?php echo $max_attempts; ?>" name="max_attempts"
                                        placeholder="Specify max attempts" aria-label=".form-control-sm example"
                                        pattern="\d+" title="Please enter a positive integer" <?php echo $attempts_input_disbled; ?>>
                                </div>
                            </div>
                        </div>


                        <div class="mt-4 mb-3 ms-3 me-3">
                            <label for="formFile" class="form-label fw-medium">Quiz Thumbnail (Optional)</label>
                            <input class="form-control" type="file" id="file" name="file" accept=".jpeg, .jpg, .png">
                            <label class="text-danger mt-2" id="upload-status"></label>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline-secondary me-auto border border-dark"
                            style="--bs-border-opacity: 0;" id="copy-code" onclick="buttonC()" data-bs-container="body"
                            data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copied">
                            <i class="fa-regular fa-copy"></i> Copy code
                        </button>

                        <button type="submit" class="btn btn-success" id="save-changes" name="save-changes">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- alerting he user when share settings is saved -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa-solid fa-floppy-disk"></i>
                <strong class="ms-2 me-auto">QuizHero</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Share settings saved!
            </div>
        </div>
    </div>


    <hr class="border border-light">

    <!-- div pang append sa questions -->
    <div class="row justify-content-center">
        <div class="col" id="questions">
            <?php

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


            ?>
        </div>
    </div>


    <div class="form" id="questionform-div">
        <form class="needs-validation" method="post" id="questionform" name="questionform">
            <div class="shadow p-3 rounded-4 mt-3 bg-orange">

                <!-- select option element (quiztype) -->
                <div class="input-group mb-3">
                    <label class="input-group-text fw-medium solid-shadow-orange">Question Type</label>
                    <select onchange="changeQuizType()" class="form-select fw-medium solid-shadow-orange"
                        id="questiontype" style="width:10rem;" name="questiontype">
                        <option selected value="IDEN">Identification</option>
                        <option value="MCQ">Multiple Choice Question</option>
                        <option value="TOF">True or False</option>
                    </select>

                </div>

                <!-- for question text area -->
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-medium">Question:</label>
                    <textarea type="text" class="form-control solid-shadow-orange" id="exampleFormControlTextarea1"
                        rows="3" name="question" required></textarea>
                    <div class="invalid-feedback text-danger">
                        Please enter a question.
                    </div>
                </div>


                <!-- changing div based on the question type -->
                <div id="questiontype_gui">
                    <input class="form-control solid-shadow-orange" type="text" placeholder="Answer"
                        aria-label="default input example" name="answerIden" required>
                    <div class="invalid-feedback text-danger">
                        Please enter the answer.
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <button class="btn btn-info text-dark border-dark btn-md" type="submit" name="save-btn"
                        id="save-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary add-btn mb-5" id="add-question" name="add-question">
                <img src="assets/img/icons/plus-circle.svg" alt="Add Question"
                    style="width: 24px; height: 24px; fill: white;"> <label class="ms-2">Add Question</label>
            </button>
        </div>
    </div>
    <script>
        // pag send data sa database
        const questionFormDiv = document.getElementById('questionform-div');

        $(document).ready(function () {
            $('#quiz-settings-form').submit(function (e) {
                e.preventDefault(); // prevent the default form submission behavior

                // get the form data
                var formData = new FormData(this);
                formData.append('quizcode', '<?php echo $quizcode; ?>');

                $.ajax({
                    url: 'assets/php/quiz_finalization.php', // path to your PHP file
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'post',
                    success: function (response) {
                        console.log(response);
                        if (response == "successful") {
                            $('#shareModal').modal('hide');
                            $('#liveToast').toast('show');
                        } else {
                            $('#upload-status').text(response);
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });


            $('#share-form').submit(function (e) {
                e.preventDefault();

                var title = $('input[name="title-input"]').val();
                var pubtxt = "Share \"" + title + "\""; // Get the value of title-input
                $('#title-modal').text(pubtxt);
                $('#new-title').val(title);
                $('#publishModal').modal('show');
            });

            $('#questionform').submit(function (e) {
                e.preventDefault();
                let questionform = $('#questionform').serialize();

                questionform += '&quizcode=<?php echo $quizcode; ?>';
                saveQuestion(questionform);

                $('#questionform-div').hide();

                $('html, body').animate({
                    scrollTop: $(document).height()
                }, 'fast');

            });

            $('#add-question').click(function (e) {
                e.preventDefault();
                let questionform = $('#questionform').serialize();
                questionform += '&quizcode=<?php echo $quizcode; ?>';

                
                if (questionFormDiv.style.display === 'none') {
                    questionFormDiv.style.display = 'block';
                } else {
                    saveQuestion(questionform);
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

                success: function (response) {
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
                error: function (xhr, status, error) {
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
            var isValid = true;
            for (var i = 0; i < form.elements.length; i++) {
                var element = form.elements[i];
                if (element.type !== "button" && element.type !== "submit") {
                    if (element.value.trim() === "") {
                        // Mark the field as invalid using Bootstrap's validation styles
                        element.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        // Remove the invalid class if the field is filled
                        element.classList.remove('is-invalid');
                    }
                }
            }
            // Return the validation result
            return isValid;
        }


        var text = document.getElementById("quizcode-copy");

        function buttonC() {
            text.select();
            navigator.clipboard.writeText(text.value.trim())
                .catch(err => {
                    console.log('Something went wrong', err);
                })
        }

        function changeAccess() {
            var selectedOption = document.getElementById('access-option').value;
            // Perform action based on the selected option
            if (selectedOption == 'PRIVATE') {
                document.getElementById('access-icon').innerHTML = '<i class="fa-solid fa-lock" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>';
                document.getElementById('access-desc').innerHTML = "Only people with link/code can access";
            } else {
                document.getElementById('access-desc').innerHTML = "Anyone can access";
                document.getElementById('access-icon').innerHTML = '<i class="fa-solid fa-earth-americas" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>';
            }
        }

        document.getElementById("attemptsInput").addEventListener("input", function () {
            var value = this.value.trim();
            if (!/^\d+$/.test(value) || parseInt(value) <= 0) {
                this.setCustomValidity("Please enter a positive integer");
            } else {
                this.setCustomValidity("");
            }
        });

        // Get references to the checkbox and text input
        var checkbox = document.getElementById("flexSwitchCheckChecked");
        var input = document.getElementById("attemptsInput");

        // Add event listener to the checkbox
        checkbox.addEventListener("change", function () {
            // Disable or enable the text input based on the checkbox state
            input.disabled = this.checked;
            input.value = "";
        });

    </script>
    <script src="./assets/js/createQuiz.js"></script>

    <?php require('assets/php/footer.inc.php'); ?>