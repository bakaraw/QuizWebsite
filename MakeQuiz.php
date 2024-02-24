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
$stmt->execute()
?>
<style></style>
<div class="container">

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

    <div class="container mt-4 mb-4">
        <div class="row align-items-center">
            <div class="col">
                <p class="h3 text-light">My Quizzes</p>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fa-solid fa-plus me-2"></i>
                    New Quiz
                </button>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->

    <div class="container">
        <div class="row rounded-3">
            <div class="col rounded-3">
                <div class="scrollable-div rounded-3 border border-light" style="height: 700px; overflow-y: auto; --bs-border-opacity: 0.15; --bs-text-opacity: 0.01;">
                    <div class="list-group">
                        <?php
                        if ($stmt->rowCount() > 0) :
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                                $select_private = "";
                                $select_public = "";
                                if ($row['accessibility'] == 'PRIVATE') {
                                    $select_private = "selected";
                                } else {
                                    $select_public = "selected";
                                }
                        ?>
                                <a href="#" class="my-quiz my-quiz<?php echo $row['code']; ?> list-group-item list-group-item-action bg-black border border-light text-light d-flex align-items-center" aria-current="true" style="--bs-bg-opacity: 0.3; --bs-border-opacity: 0.15;">
                                    <div class="image-container rounded-1 me-3" style="background-image: url('assets/img/uploads/<?php echo $row['thumbnail'] ?>');"></div>
                                    <div>
                                        <h5 class="mb-1 text-light text-break"><?php echo $row['title'] ?></h5>

                                    </div>
                                    <div class="ms-auto d-flex align-items-center text-light">
                                        <div class="me-3" id="access-icon<?php echo $row['code'] ?>">
                                            <?php if ($row['accessibility'] == 'PRIVATE') : ?>
                                                <i class="fa-solid fa-lock fa-lg" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>
                                            <?php else : ?>
                                                <i class="fa-solid fa-earth-americas" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>
                                            <?php endif; ?>
                                        </div>
                                        <select class="form-select bg-dark border border-dark fw-semibold access-option me-3 text-light" aria-label="Default select example" style="width: 100px; --bs-border-opacity: 0;" onchange="changeAccess<?php echo $row['code'] ?>()" id="access-option<?php echo $row['code'] ?>" name="access-option">
                                            <option <?php echo $select_private; ?> value="PRIVATE">Private</option>
                                            <option <?php echo $select_public; ?> value="PUBLIC">Public</option>
                                        </select>
                                        <button type="button" class="btn btn-danger">
                                            <img src="assets/img/icons/trash-fill.svg" alt="Delete" style="width: 20px; height: 20px; fill: white;">
                                        </button>
                                    </div>
                                </a>
                                <script>
                                    $(document).ready(function() {
                                        $(".my-quiz<?php echo $row['code']; ?>").click(function(event) {
                                            event.preventDefault(); // Prevent default link behavior
                                            var quizcode = '<?php echo $row['code']; ?>';
                                            $.ajax({
                                                type: "POST",
                                                url: "assets/ajax/quizcode_session.php", // Path to your PHP script
                                                data: {
                                                    quizcode: quizcode
                                                }, // Data to be sent to the server
                                                success: function(response) {
                                                    // Redirect to the next page after session is set
                                                    window.location.href = "createQuiz.php";
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(xhr.responseText);
                                                }
                                            });
                                        });
                                    });

                                    function changeAccess<?php echo $row['code'] ?>() {
                                        var selectedOption = document.getElementById('access-option<?php echo $row['code'] ?>').value;
                                        // Perform action based on the selected option
                                        if (selectedOption == 'PRIVATE') {
                                            document.getElementById('access-icon<?php echo $row['code'] ?>').innerHTML = '<i class="fa-solid fa-lock" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>';
                                        } else {
                                            document.getElementById('access-icon<?php echo $row['code'] ?>').innerHTML = '<i class="fa-solid fa-earth-americas" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>';
                                        }
                                    }
                                </script>
                        <?php
                            endwhile;
                        endif;
                        ?>
                        <!-- Other list items -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="Page navigation example" class="mt-4 d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>





</div>

<script src="./assets/js/makeQuiz.js"></script>
<?php require('assets/php/footer.inc.php'); ?>