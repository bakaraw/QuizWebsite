<?php
include "dbh_quiz.inc.php";
$quizcode = $_POST['quizcode'];
$quiztitle = $_POST['new-title'];
$access_option = $_POST['access-option'];

$attempts = "-1";
// Check if the checkbox is checked
if (isset($_POST['is_unli_attempts']) && $_POST['is_unli_attempts'] == 'on') {
    // Checkbox is checked
    $attempts = "-1";
} else {
    // Checkbox is not checked, use the value from the form
    if (isset($_POST['max_attempts'])) {
        $attempts = $_POST['max_attempts'];
    } else {
        echo "somethings wrong with max_attempts input element";
    }
}

// Check if a file is uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
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

                updateQuizWithThmb($pdo, $quiztitle, $access_option, $new_file_name, $quizcode, $attempts);
                echo "successful";
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
    updateQuizAccess($pdo, $quiztitle, $access_option, $quizcode, $attempts);
    echo "successful";
}

function updateQuizWithThmb($pdo, $quiztitle, $access_option, $thumbnail, $quizcode, $max_attempts)
{
    // deletes first the thumbnail in file if the thumbnail is not = 'default_img.jpg'
    // then uploads a new thumbnail image

    try {

        $stmt = $pdo->prepare("SELECT thumbnail FROM quizlisttable WHERE code = ?");
        $stmt->execute([$quizcode]);

        $result = $stmt->fetch();
        if ($result && $result['thumbnail'] !== 'default_img.jpg') {
            $thumbnailFilename = $result['thumbnail'];
            $filePath = '../img/uploads/' . $thumbnailFilename;

            // Check if the file exists before attempting to delete it
            if (file_exists($filePath)) {
                // Attempt to delete the file
                if (unlink($filePath)) {

                } else {
                    echo "Failed to delete file $thumbnailFilename.";
                }
            } else {
                // File does not exist
                echo "File $thumbnailFilename does not exist.";
            }
        }


        $stmt = $pdo->prepare("UPDATE `quizlisttable` SET title=:title, accessibility=:accessibility, thumbnail=:thumbnail, max_attempts=:max_attempts WHERE code=:quizcode");

        // // Bind parameters
        $stmt->bindParam(':title', $quiztitle);
        $stmt->bindParam(':accessibility', $access_option);
        $stmt->bindParam(':thumbnail', $thumbnail);
        $stmt->bindParam(':quizcode', $quizcode);
        $stmt->bindParam(':max_attempts', $max_attempts);
        // Execute the statement
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function updateQuizAccess($pdo, $quiztitle, $access_option, $quizcode, $max_attempts)
{
    try {
        $stmt = $pdo->prepare("SELECT max_attempts FROM `quizlisttable` WHERE code=:quizcode");
        $stmt->bindParam(':quizcode', $quizcode);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $curr_max_attempts = $result['max_attempts'];

        $stmt = $pdo->prepare("UPDATE `quizlisttable` SET title=:title, accessibility=:accessibility, max_attempts=:max_attempts WHERE code=:quizcode");
        // // Bind parameters
        $stmt->bindParam(':title', $quiztitle);
        $stmt->bindParam(':accessibility', $access_option);
        $stmt->bindParam(':quizcode', $quizcode);
        if ($curr_max_attempts != $max_attempts) {

            $stmt->bindParam(':max_attempts', $max_attempts);
            $stmt->execute();

            $stmt = $pdo->prepare("SELECT remaining_attempts FROM `user_quiz_attempts` WHERE quizcode=:quizcode");
            $stmt->bindParam(':quizcode', $quizcode);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $remaining_attempts = $row['remaining_attempts'];


                $updated_remaining_attempts = $max_attempts; // For example, decrementing by 1
                $update_stmt = $pdo->prepare("UPDATE `user_quiz_attempts` SET remaining_attempts = :updated_remaining_attempts WHERE quizcode = :quizcode");
                $update_stmt->bindParam(':updated_remaining_attempts', $updated_remaining_attempts);
                $update_stmt->bindParam(':quizcode', $quizcode);
                $update_stmt->execute();
            }
            return;

        } else {
            $stmt->bindParam(':max_attempts', $max_attempts);
        }

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}