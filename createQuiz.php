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
            <div class="input-group mb-3">
                <label class="input-group-text bg-dark text-light border-light" style="--bs-border-opacity: .2; --bs-text-opacity: .70;">Question Type</label>
                <select onchange="updateLabel()" class="form-select bg-dark text-light border-light" id="questiontype" style="--bs-border-opacity: .2;  --bs-text-opacity: .75; width:10rem;" name="questiontype">
                    <option seelected value="iden">Identification</option>
                    <option value="mcq">Multiple Choice Question</option>
                    <option value="tof">True or False</option>
                </select>
            </div>
            <div>
                <label class="  text-light" id="questiontype_label">Selected value: iden</label>
            </div>
        </form>
    </div>
</div>

<script>
function updateLabel() {
    var selectedValue = document.getElementById("questiontype").value;
    document.getElementById("questiontype_label").innerText = "Selected value: " + selectedValue;
    return false; // Prevent form submission (we'll handle it with JavaScript)
}
</script>
<?php require('assets/php/footer.inc.php'); ?>