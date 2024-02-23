<?php
include "dbh_quiz.inc.php";
$quizcode = $_POST['quizcode'];
$quiztitle = $_POST['new-title'];
$access_option = $_POST['access-option'];

// Check if a file is uploaded
if(isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
    $thmb_img = $_FILES['file'];

    $thmb_name = $_FILES['file']['name'];  // get the original file name of thumnail image.
    $thmb_tmp = $_FILES['file']['tmp_name'];   // get temporary source of thumbnail image.
    $thmb_type = $_FILES['file']['type'];
    $thmb_size = $_FILES['file']['size'];
    $thmb_error = $_FILES['file']['error'];

    $thmb_ext = explode('.', $thmb_name);
    $thmb_actual_ext = strtolower(end($thmb_ext));

    $allowed_ext = array(
        'jpg',
        'jpeg',
        'png'
    );

    if (in_array($thmb_actual_ext, $allowed_ext)) {
        if ($thmb_error === 0) {
            if ($thmb_size < 1000000) {
                $new_file_name = uniqid('', true) . '.' . $thmb_actual_ext;
                $file_destination = '../img/uploads/' . $new_file_name;
                move_uploaded_file($thmb_tmp, $file_destination);

                updateQuizWithThmb($pdo, $quiztitle, $access_option, $new_file_name, $quizcode);
                
            } else {
                echo "Image too large";
            }
        } else {
            echo "Something went wrong in uploading";
        }
    } else {
        echo "Invalid file extension";
    }
} else {
    //if file input is empty
    updateQuizAccess($pdo, $quiztitle ,$access_option, $quizcode);
}

function updateQuizWithThmb($pdo, $quiztitle, $access_option, $thumbnail, $quizcode)
{
    try {
        $stmt = $pdo->prepare("UPDATE `quizlisttable` SET title=:title, accessibility=:accessibility, thumbnail=:thumbnail WHERE code=:quizcode");

        // // Bind parameters
        $stmt->bindParam(':title', $quiztitle);
        $stmt->bindParam(':accessibility', $access_option);
        $stmt->bindParam(':thumbnail', $thumbnail);
        $stmt->bindParam(':quizcode', $quizcode);
        // Execute the statement
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function updateQuizAccess($pdo, $quiztitle, $access_option, $quizcode)
{
    try {
        $stmt = $pdo->prepare("UPDATE `quizlisttable` SET title=:title, accessibility=:accessibility WHERE code=:quizcode");

        // // Bind parameters
        $stmt->bindParam(':title', $quiztitle);
        $stmt->bindParam(':accessibility', $access_option);
        $stmt->bindParam(':quizcode', $quizcode);
        // Execute the statement
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
