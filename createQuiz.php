<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<div class="container">
    <!-- title box -->
    <div class="container mt-5 mb-5"></div>
    <div class="input-group mb-3 border-light">
        <span class="input-group-text bg-dark text-light border-light" id="inputGroup-sizing-default" style="--bs-bg-opacity: .05; --bs-border-opacity: .2; --bs-text-opacity: .75;">Quiz Title</span>
        <input type="text" class="form-control bg-dark text-light border-light me-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="--bs-bg-opacity: .05;  --bs-border-opacity: .2;">
        <button class="btn btn-success text-light border-dark btn-md" type="button">Publish</button>
    </div>
    <form action="" method="post">
        <div class="bg-light p-3 rounded-4 mt-3" style="--bs-bg-opacity: .05;">

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
            </div>

            <!-- for the save and delete button -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                <button class="btn btn-warning text-dark border-dark btn-md" type="button">Save</button>
                <button class="btn btn-danger bi bi-trash btn-md" type="button">
                    <img src="assets/img/icons/trash-fill.svg" style="fill: white;">
                </button>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-outline-light add-btn"
                data-bs-toggle="tooltip" data-bs-placement="top" 
                data-bs-custom-class="custom-tooltip" 
                data-bs-title="Add Question">
                    <img src="assets/img/icons/plus-square-fill.svg" alt="Add Question" style="width: 24px; height: 24px; fill: white;">
                </button>
            </div>
        </div>
    </form>
</div>

<?php require('assets/php/footer.inc.php'); ?>