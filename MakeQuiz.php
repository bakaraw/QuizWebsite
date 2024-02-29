<?php
session_start();
include "assets/php/dbh_quiz.inc.php";
?>
<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<?php
$sql = "SELECT * FROM quizlisttable WHERE creator=:creator";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':creator', $_SESSION['username']);
$stmt->execute();

$quiz_per_page = 10;
?>
<style></style>
<div class="container mt-5">

    <!-- Modal for quiz title-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="assets/php/titleform.inc.php" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Name your Quiz</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Title here" aria-label="default input example" name="quiztitle" id="quiztitle">
                        <p class="text-danger mt-3" id="message"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="create-btn" id="create-btn">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-4 mb-4">
        <div class="row align-items-center">
            <div class="col">
                <p class="h3 text-dark font-moon-bold">My Quizzes</p>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fa-solid fa-plus me-2"></i>
                    New Quiz
                </button>
            </div>
        </div>
    </div>

    <!-- modal for delete confirmation -->
    <div class="modal fade" id="delete-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-break" id="delete-msg">Are you sure you want to delete "Math quiz" ?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="quizcode-confirm">
                    You <strong>CANNOT</strong> retrieve deleted quiz.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="confirm-delete-btn">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->

    <div class="container">
        <div class="row rounded-3">
            <div class="col rounded-3">
                <div class="scroll-div scrollable-div rounded-3 border border-dark shadow" style="height: 700px; overflow-y: auto; --bs-border-opacity: 0.15; --bs-text-opacity: 0.01;">
                    <div class="list-group" id="quizzes">

                        <!-- Other list items -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-orange">

                <strong class="me-auto">QuizHero</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Quiz access saved!
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {

        $('#quizzes').load('assets/ajax/load_quizzes.php');

        $('#confirm-delete-btn').click(function(e) {
            e.preventDefault();
            var quizcode = $('#quizcode-confirm').val();
            $.ajax({
                type: "POST",
                url: "assets/ajax/del_quiz.php",
                data: {
                    quizcode: quizcode
                },
                success: function(response) {
                    console.log(response);
                    $('#quizzes').load('assets/ajax/load_quizzes.php');
                }
            });
        });
    });
</script>
<script src="./assets/js/makeQuiz.js"></script>
<?php require('assets/php/footer.inc.php'); ?>