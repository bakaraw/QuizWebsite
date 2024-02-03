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
        
    </div>
    <!-- question form -->
    <?php include('assets/php/question_form.inc.php'); ?>

    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-outline-light add-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add Question" id="add-question">
                <img src="assets/img/icons/plus-square-fill.svg" alt="Add Question" style="width: 24px; height: 24px; fill: white;">
            </button>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $("#add-question").click( function(e){
            e.preventDefault();
            
            var count = sessionStorage.getItem("count");
            if(count == null){
                count = 1;
            }

            $.ajax({
                type: "GET",
                url: "assets/ajax/createquiz_ajax.php",
                data: {
                    count
                },  
                dataType: "json",
                success: function (response) {

                    count = response.count;
                    sessionStorage.setItem("count", count);
                    $(".questions").append(response.content);
                    console.log('pressed');
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="./assets/js/createQuiz.js"></script>
<?php require('assets/php/footer.inc.php'); ?>