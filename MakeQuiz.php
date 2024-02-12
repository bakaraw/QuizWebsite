<?php 
session_start();
?>
<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>
<div class="container">
    <p class="h1 text-light align-middle">Diri ma view ang mga quiz na nahimo sa user</p>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Create Quiz
    </button>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="assets/php/titleform.inc.php" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Quiz Title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Title here" aria-label="default input example" name="quiztitle" id="quiztitle">
                        <p class="text-danger mt-3" id="message"></p> 
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="create-btn" id="create-btn">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php require('assets/php/footer.inc.php'); ?>