<?php
include "dbh_quiz.inc.php";
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
            echo "oten";
        } else {
            echo "img too large";
        }
    } else {
        echo "error in uploading";
    }
} else {
    echo "you cannot";
}
