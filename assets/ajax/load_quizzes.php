<?php
session_start();
include "../php/dbh_quiz.inc.php";
$sql = "SELECT * FROM quizlisttable WHERE creator=:creator";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':creator', $_SESSION['username']);
$stmt->execute();

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
        <a class="my-quiz my-quiz<?php echo $row['code']; ?> list-group-item list-group-item-action border border-dark text-dark d-flex align-items-center" aria-current="true" style="--bs-border-opacity: 0.15;">
            
            <div class="image-container rounded-1 me-3" style="background-image: url('assets/img/uploads/<?php echo $row['thumbnail'] ?>');"></div>
            <div>
                <h5 class="mb-1 text-dark text-break"><?php echo $row['title'] ?></h5>
            </div>
            <div class="ms-auto d-flex align-items-center text-dark">
                <div class="me-3" id="access-icon<?php echo $row['code'] ?>">
                    <?php if ($row['accessibility'] == 'PRIVATE') : ?>
                        <i class="fa-solid fa-lock fa-lg" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>
                    <?php else : ?>
                        <i class="fa-solid fa-earth-americas" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>
                    <?php endif; ?>
                </div>
                <select class="form-select bg-transparent border border-dark fw-semibold access-option me-3 text-dark" aria-label="Default select example" style="width: 100px; --bs-border-opacity: 0;" id="access-option<?php echo $row['code'] ?>" name="access-option" onclick="event.stopPropagation();" data-bs-dismiss="toast" data-bs-target="#access-toast">
                    <option <?php echo $select_private; ?> value="PRIVATE">Private</option>
                    <option <?php echo $select_public; ?> value="PUBLIC">Public</option>
                </select>
                <button type="button" class="btn btn-danger" onclick="event.stopPropagation();" id="delete-<?php echo $row['code']; ?>" data-bs-toggle="modal" data-bs-target="#delete-confirm">
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

                $('#delete-<?php echo $row['code']; ?>').click(function(e) {
                    e.preventDefault();
                    var quizcode = '<?php echo $row['code']; ?>';
                    $('#quizcode-confirm').val(quizcode);
                    $('#delete-msg').text('Are you sure you want to delete "' + '<?php echo $row['title'] ?>' + '" ?');
                });

                $('#access-option<?php echo $row['code'] ?>').change(function(e) {
                    e.preventDefault();
                    var selected = $('#access-option<?php echo $row['code'] ?>').val();
                    var privateIcon = '<i class="fa-solid fa-lock" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>';
                    var publicIcon = '<i class="fa-solid fa-earth-americas" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fa-solid fa-circle"></i>';

                    if (selected == 'PRIVATE') {
                        $('#access-icon<?php echo $row['code'] ?>').html(privateIcon);
                    } else {
                        $('#access-icon<?php echo $row['code'] ?>').html(publicIcon);
                    }

                    $.ajax({
                        type: "POST",
                        url: "assets/ajax/update_quiz_access.php",
                        data: {
                            access: selected,
                            quizcode: '<?php echo $row['code'] ?>'
                        },
                        success: function(response) {
                            console.log(response);
                            $('#liveToast').toast('show');
                        }
                    });

                });
            });
        </script>
    <?php
    endwhile;
else :
    ?>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <h3 class="text-dark" style="--bs-text-opacity: 0.5;">No quizzes created</h3>
    </div>

<?php
endif;
?>