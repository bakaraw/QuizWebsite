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
            <div class="input-group mb-3">
                <label class="input-group-text bg-dark text-light border-light" style="--bs-border-opacity: .2; --bs-text-opacity: .70;">Question Type</label>
                <select onchange="changeQuizType()" class="form-select bg-dark text-light border-light" id="questiontype" style="--bs-border-opacity: .2;  --bs-text-opacity: .75; width:10rem;" name="questiontype">
                    <option selected value="iden">Identification</option>
                    <option value="mcq">Multiple Choice Question</option>
                    <option value="tof">True or False</option>
                </select>
            </div>
            <div id="questiontype_gui">
                <div class="form-floating">
                    <textarea class="form-control bg-dark text-light border-light" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px; --bs-border-opacity: .2;"></textarea>
                    <label class="text-light" for="floatingTextarea2">Question</label>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="assets/js/createQuiz.js"></script>
<?php require('assets/php/footer.inc.php'); ?>