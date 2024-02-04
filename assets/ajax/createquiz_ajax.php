<?php
if(isset($_GET['count']) && $_GET['count'] != ""){
    // Start output buffering
    ob_start();
    
    // counter to make element ids and names unique from each other in ../php/question_form.inc.php
    $count = $_GET['count'];
    $count++;

    // Include the PHP file
    include('../php/question_form.inc.php');
    // Get the output of the included file
    $content = ob_get_clean();

    header("Content-Type: application/json");

    echo json_encode(["count" => $count, "content" => $content]);
}