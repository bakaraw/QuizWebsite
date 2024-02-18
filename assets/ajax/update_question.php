<?php
$qid = $_POST['qid'];
$quizcode = $_POST['quizcode'];
$questiontype = $_POST['questiontype'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$choiceA = $_POST['choiceA'];
$choiceB = $_POST['choiceB'];
$choiceC = $_POST['choiceC'];
$choiceD = $_POST['choiceD'];

$checkTrue = "";
$checkFalse = "";

$checkA = "";
$checkB = "";
$checkC = "";
$checkD = "";
?>
<form class="needs-validation" method="post" id="questionform<?php echo $qid ?>" name="questionform">
    <!-- select option element (quiztype) -->
    <div class="input-group mb-3">
        <label class="input-group-text bg-dark text-light border-light" style="--bs-border-opacity: .2; --bs-text-opacity: .70;">Question Type</label>
        <select onchange="changeQuizType<?php echo $qid; ?>()" class="form-select bg-dark text-light border-light" id="questiontype<?php echo $qid; ?>" style="--bs-border-opacity: .2;  --bs-text-opacity: .75; width:10rem;" name="questiontype<?php echo $qid; ?>">
            <option <?php
                    if ($questiontype == "IDEN") {
                        echo "selected";
                    }
                    ?> value="IDEN">Identification</option>
            <option <?php
                    if ($questiontype == "MCQ") {
                        echo "selected";
                    }
                    ?> value="MCQ">Multiple Choice Question</option>
            <option <?php
                    if ($questiontype == "TOF") {
                        echo "selected";
                    }
                    ?> value="TOF">True or False</option>
        </select>

    </div>

    <!-- for question text area -->
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label text-light" style="--bs-text-opacity: .7;">Question:</label>
        <textarea type="text" class="form-control bg-dark text-light border-light" rows="3" style="--bs-border-opacity: .2;" name="question<?php echo $qid ?>" id="question<?php echo $qid ?>" required><?php echo $question; ?></textarea>
        <div class="invalid-feedback text-danger">
            Please enter a question.
        </div>
    </div>


    <!-- changing div based on the question type -->
    <div id="questiontype_gui<?php echo $qid; ?>">
        <?php
        switch ($questiontype) {
            case "IDEN":
                echo '
                <input class="form-control bg-dark text-light border-light" type="text" placeholder="Answer" aria-label="default input example" style="--bs-border-opacity: .2;" name="answerIden" value="' . $answer . '" required>
                <div class="invalid-feedback text-danger">
                    Please enter the answer.
                </div>
                ';
                break;
            case "MCQ":
                if ($answer == "choiceA") {
                    $checkA = "checked";
                } elseif ($answer == "choiceB") {
                    $checkB =  "checked";
                } elseif ($answer == "choiceC") {
                    $checkC =  "checked";
                } elseif ($answer == "choiceD") {
                    $checkD =  "checked";
                }
                echo '
                <p class="text-light" style="--bs-text-opacity: .7;">Input choices then select the answer</p>
                <div class="input-group mt-3">
                    <div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">
                        <input class="form-check-input mt-0" type="radio" value="choiceA" aria-label="Radio button for following text input" name="answerMCQ" ' . $checkA . ' required>
                    </div>
                    <input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice A" name="choiceA" value="' . $choiceA . '" required>
                </div>

                <div class="input-group mt-3">
                    <div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">
                        <input class="form-check-input mt-0" type="radio" value="choiceB" aria-label="Radio button for following text input" name="answerMCQ" ' . $checkB . ' required>
                    </div>
                    <input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice B" name="choiceB" value="' . $choiceB . '" required>
                </div>

                <div class="input-group mt-3">
                    <div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">
                        <input class="form-check-input mt-0" type="radio" value="choiceC" aria-label="Radio button for following text input" name="answerMCQ" ' . $checkC . ' required>
                    </div>
                    <input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice C" name="choiceC" value="' . $choiceC . '" required>
                </div>

                <div class="input-group mt-3">
                    <div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">
                        <input class="form-check-input mt-0" type="radio" value="choiceD" aria-label="Radio button for following text input" name="answerMCQ" ' . $checkD . ' required>
                    </div>
                    <input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice D" name="choiceD" value="' . $choiceD . '" required>
                </div>';

                break;
            case "TOF":

                if ($answer == "TRUE") {
                    $checkTrue = "checked";
                } else {
                    $checkFalse = "checked";
                }
                echo '
                <p class="text-light" style="--bs-text-opacity: .7;">Answer:</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="answerTOF" id="inlineRadio1" value="TRUE" ' . $checkTrue . ' required>
                    <label class="form-check-label text-light" for="inlineRadio1">True</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="answerTOF" id="inlineRadio2" value="FALSE" ' . $checkFalse . ' required>
                    <label class="form-check-label text-light" for="inlineRadio2">False</label>
                </div>';
                break;
        }


        ?>

    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
        <button class="btn btn-warning text-dark border-dark btn-md" type="submit" name="save-btn" id="save-btn">Save</button>
    </div>
</form>
<script>
    var identHtml<?php echo $qid; ?> = [
        '<input class="form-control bg-dark text-light border-light" type="text" placeholder="Answer" aria-label="default input example" style="--bs-border-opacity: .2;" name="answerIden" value="<?php echo $answer; ?>" required>',
        '<div class="invalid-feedback text-danger">',
        'Please enter a question.',
        '</div>'
    ];

    //html for mcq
    var mcqHtml<?php echo $qid; ?> = [
        '<p class="text-light" style="--bs-text-opacity: .7;">Input choices then select the answer</p>',
        '<div class="input-group mt-3">',
        '<div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">',
        '<input class="form-check-input mt-0" type="radio" value="choiceA" aria-label="Radio button for following text input" name="answerMCQ" <?php echo $checkA; ?> required>',
        '</div>',
        '<input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice A" name="choiceA" value="<?php echo $choiceA ?>" required>',
        '</div>',

        '<div class="input-group mt-3">',
        '<div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">',
        '<input class="form-check-input mt-0" type="radio" value="choiceB" aria-label="Radio button for following text input" name="answerMCQ" <?php echo $checkB; ?> required>',
        '</div>',
        '<input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice B" name="choiceB" value="<?php echo $choiceB ?>" required>',
        '</div>',

        '<div class="input-group mt-3">',
        '<div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">',
        '<input class="form-check-input mt-0" type="radio" value="choiceC" aria-label="Radio button for following text input" name="answerMCQ" <?php echo $checkC; ?> required>',
        '</div>',
        '<input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice C" name="choiceC" value="<?php echo $choiceC ?>" required>',
        '</div>',

        '<div class="input-group mt-3">',
        '<div class="input-group-text bg-dark border-light" style="--bs-border-opacity: .2;">',
        '<input class="form-check-input mt-0" type="radio" value="choiceD" aria-label="Radio button for following text input" name="answerMCQ" <?php echo $checkD; ?> required>',
        '</div>',
        '<input type="text" class="form-control bg-dark border-light text-light" aria-label="Text input with radio button" style="--bs-border-opacity: .2;" placeholder="Choice D" name="choiceD" value="<?php echo $choiceD ?>" required>',
        '</div>',
    ];

    // html for true or false
    var tofHtml<?php echo $qid; ?> = [
        '<p class="text-light" style="--bs-text-opacity: .7;">Answer:</p>',
        '<div class="form-check form-check-inline">',
        '<input class="form-check-input" type="radio" name="answerTOF" id="inlineRadio1" value="TRUE" <?php echo $checkTrue ?> required>',
        '<label class="form-check-label text-light" for="inlineRadio1">True</label>',
        '</div>',

        '<div class="form-check form-check-inline">',
        '<input class="form-check-input" type="radio" name="answerTOF" id="inlineRadio2" value="FALSE" <?php echo $checkFalse ?> required>',
        '<label class="form-check-label text-light" for="inlineRadio2">False</label>',
        '</div>',
    ];


    function strCat(strArr) {
        let result = "";
        for (let i = 0; i < strArr.length; i++) {
            result += strArr[i];
        }
        return result;
    }


    function changeQuizType<?php echo $qid; ?>() {
        var selectElement = document.getElementById("questiontype<?php echo $qid; ?>");
        var selectedValue = selectElement.value;
        var elementToChange = document.getElementById("questiontype_gui<?php echo $qid; ?>");

        switch (selectedValue) {
            case "IDEN":
                elementToChange.innerHTML = strCat(identHtml<?php echo $qid; ?>);
                break;
            case "MCQ":
                elementToChange.innerHTML = strCat(mcqHtml<?php echo $qid; ?>);
                break;
            case "TOF":
                elementToChange.innerHTML = strCat(tofHtml<?php echo $qid; ?>);
                break;
            default:
                elementToChange.innerHTML = "<p class=\"text-light\">Something went wrong</p>";
        }
        return false;
    }

    // for form validation (kung dili butngan value ang mga textarea sa form kay mag warning)
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)

            form.addEventListener('click', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()

    $(document).ready(function() {
        $('#questionform<?php echo $qid; ?>').submit(function(e) {
            e.preventDefault();
            let questionform<?php echo $qid; ?> = $("#questionform<?php echo $qid; ?>").serialize();

            $.ajax({
                type: "POST",
                url: "assets/ajax/update_save_question.php",
                data: {
                    qid: '<?php echo $qid; ?>',
                    quizcode: '<?php echo $quizcode; ?>',
                    questionform: questionform<?php echo $qid; ?>
                    //answer: ,
                },
                success: function(response) {

                    $('#question-<?php echo $qid; ?>').load("assets/ajax/load_edited_question.php", {
                        qid: '<?php echo $qid ?>',
                        quizcode: '<?php echo $quizcode; ?>',
                    });
                }
            });
        });
    });
</script>