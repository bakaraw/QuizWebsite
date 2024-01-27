<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<div class="container">
    <!-- title box -->
    <div class="container mt-5 mb-5"></div>
    <div class="input-group mb-3 border-light">
        <span class="input-group-text bg-light text-light border-light" id="inputGroup-sizing-default" style="--bs-bg-opacity: .05; --bs-border-opacity: .2; --bs-text-opacity: .75;">Quiz Title</span>
        <input type="text" class="form-control bg-light text-light border-light" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="--bs-bg-opacity: .05;  --bs-border-opacity: .2;">
    </div>

    <div class="bg-light p-3 rounded-4 mt-3" style="--bs-bg-opacity: .05;">
        <form action="" method="post">
            <div class="input-group mb-3 border-light ">
                <label class="input-group-text bg-dark text-light border-light" for="questiontype" style="--bs-border-opacity: .2; --bs-text-opacity: .70;">Question Type</label>
                <select class="form-select bg-dark text-light border-light" id="questiontype" style="--bs-border-opacity: .2;  --bs-text-opacity: .75; width:10rem;" name="questiontype">
                    <option selected>Choose...</option>
                    <option value="1">Identification</option>
                    <option value="2">Multiple Choice Question</option>
                    <option value="3">True or False</option>
                </select>
                <label class="text-light" for="questiontype"></label>
            </div>
        </form>

    </div>
</div>

<?php require('assets/php/footer.inc.php'); ?>