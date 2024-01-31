<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<div class="container">
    <!-- title box -->
    <div class="container mt-5 mb-5"></div>
    <div class="input-group mb-3 border-light">
        <span class="input-group-text bg-dark text-light border-light" id="inputGroup-sizing-default" style="--bs-bg-opacity: .05; --bs-border-opacity: .2; --bs-text-opacity: .75;">Quiz Title</span>
        <input type="text" class="form-control bg-dark text-light border-light" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="--bs-bg-opacity: .05;  --bs-border-opacity: .2;">
    </div>

    <div class="bg-light p-3 rounded-4 mt-3" style="--bs-bg-opacity: .05;">
        <form action="" method="post">

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
                <textarea class="form-control bg-dark text-light border-light" id="exampleFormControlTextarea1" rows="3" style="--bs-border-opacity: .2;"></textarea>
            </div>

            <!-- changing div based on the quiz type -->
            <div id="questiontype_gui">
                <input class="form-control bg-dark text-light border-light" type="text" placeholder="Answer" aria-label="default input example" style="--bs-border-opacity: .2;">
                <!-- temp -->
                <!-- <div class="form-check form-check-inline mt-3"> -->
                    <!-- <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> -->
                    <!-- <label class="form-check-label text-light" for="inlineRadio1">True</label> -->
                <!-- </div> -->
                <!-- <div class="form-check form-check-inline mt-3"> -->
                    <!-- <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> -->
                    <!-- <label class="form-check-label text-light" for="inlineRadio2">False</label> -->
                <!-- </div> -->
            </div>

            <!-- for the save and delete button -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                <button class="btn btn-warning text-dark border-dark" type="button" style="width: 5rem;">Save</button>
                <button class="btn btn-danger bi bi-trash" type="button">
                    <img src="assets/img/icons/trash-fill.svg" style="fill: white;"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="./assets/js/createQuiz.js"></script>
<?php require('assets/php/footer.inc.php'); ?>