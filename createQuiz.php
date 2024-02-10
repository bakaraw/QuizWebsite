
<?php

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
    <div class="input-group mb-3 border-light">
        <span class="input-group-text bg-dark text-light border-light" id="inputGroup-sizing-default" style="--bs-bg-opacity: .05; --bs-border-opacity: .2; --bs-text-opacity: .75;">Quiz title</span>
        <input type="text" class="form-control bg-dark text-light border-light me-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="--bs-bg-opacity: .05;  --bs-border-opacity: .2;" value="<?php echo $quiztitle; ?>">
        <button class="btn btn-success text-light border-dark btn-md" type="button">Publish</button>
    </div>

    <!-- div pang append sa questions -->
    <div class="questions">
        <!-- contents here -->

        <div>
            <form action="" method="get" id="questionform" name="questionform">
                <div class="shadow bg-black border border-light p-3 rounded-4 mt-5" style="--bs-bg-opacity: .2; --bs-border-opacity: .2;">

                    <!-- select option element (quiztype) -->
                    <div class="input-group mb-3">
                        <label class="input-group-text bg-dark text-light border-light" style="--bs-border-opacity: .2; --bs-text-opacity: .70;">Question Type</label>
                        <select onchange="changeQuizType()" class="form-select bg-dark text-light border-light" id="questiontype" style="--bs-border-opacity: .2;  --bs-text-opacity: .75; width:10rem;" name="questiontype">
                            <option selected value="iden">Identification</option>
                            <option value="mcq">Multiple Choice Question</option>
                            <option value="tof">True or False</option>
                        </select>

                    </div>

                    <!-- for question text area -->
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label text-light" style="--bs-text-opacity: .7;">Question:</label>
                        <textarea eype="text" class="form-control bg-dark text-light border-light" id="exampleFormControlTextarea1" rows="3" style="--bs-border-opacity: .2;" name="question" require></textarea>
                    </div>

                    <!-- changing div based on the question type -->
                    <div id="questiontype_gui">
                        <input class="form-control bg-dark text-light border-light" type="text" placeholder="Answer" aria-label="default input example" style="--bs-border-opacity: .2;" require>
                    </div>

                    <!-- for the save and delete button -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <button class="btn btn-warning text-dark border-dark btn-md" type="button" name="save-btn" id="save-btn">Save</button>
                    </div>
                </div>

                <div class="container-fluid mt-4">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-light add-btn mb-3" id="add-question" name="add-question">
                            <img src="assets/img/icons/plus-circle.svg" alt="Add Question" style="width: 24px; height: 24px; fill: white;"> <label class="ms-2">Add Question</label>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./assets/js/createQuiz.js"></script>

    <?php require('assets/php/footer.inc.php'); ?>