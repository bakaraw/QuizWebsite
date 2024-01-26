<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<div class="container">
    <div class="container mt-5 mb-5"></div>
    <div class="input-group mb-3 border-dark">
        <span class="input-group-text bg-light text-light border-dark" id="inputGroup-sizing-default" style="--bs-bg-opacity: .05;">Title</span>
        <input type="text" class="form-control bg-light text-light border-dark" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="--bs-bg-opacity: .05;">
    </div>
    <div class="bg-light p-3 rounded-4 mt-3" style="--bs-bg-opacity: .05;">
        <div class="input-group mb-3 border-light " style="-bs-border-opacity: .06;">
            <label class="input-group-text bg-dark text-light " for="inputGroupSelect01"  style="-bs-border-opacity: .06;">Options</label>
            <select class="form-select bg-dark text-light me-auto" id="inputGroupSelect01"  style="-bs-border-opacity: .06;  width:10rem;">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
    </div>
</div>



<?php require('assets/php/footer.inc.php'); ?>