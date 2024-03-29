<?php ob_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizHero - Browse</title>
    <link rel="icon" href="assets/img/icons/page-icon.ico" type="image/x-icon">
    <!-- Add these lines to include Bootstrap and jQuery -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


    <style>
        .card {
            padding: 20px;
            margin: 20px auto;
            border: 1px solid #bd1717;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: purple;
            color: #2f11f2;
            text-align: left;
            cursor: pointer;
            width: 100%;
            max-width: 600px;

        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #FFFFFF;
            background-color: #dddddd;
            transition: transform 0.05s linear, box-shadow 0.5s ease;
        }

        .card-body {

            padding: 20px;
            display: flex;
            align-items: center;
        }

        .left-content {
            display: flex;
            align-items: center;
        }

        .right-content {
            text-align: right;
        }

        .card-title,
        .card-subtitle,
        .card-text {
            margin: 5px 0;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #A020F0;
        }

        .card-subtitle {
            font-size: 1rem;
            color: #FFFFFF;
        }

        .card-text {
            font-size: 1rem;
            color: #000000;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #FFFFFF;
        }

        nav[aria-label="page nav"] {
            display: flex;
            justify-content: center;
        }

        .pagination .page-link {
            color: #fcbf49;
            background-color: #ffffff;
            border-color: #fcbf49;
            font-size: 12px;
            padding: 8px 13px;
            border-width: px;

        }

        .pagination .page-item.active .page-link {
            color: #ffffff;
            background-color: #fcbf49;
        }

        .img-container {
            flex: 0 0 50px;
            height: 100px;
            overflow: hidden;
            margin-right: 15px;
        }

        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .text-content {
            flex: 1;
        }

        .html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex-grow: 1;
            overflow: auto;
        }

        .footer-content {
            width: 100%;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .card-body {
                flex-direction: column;
            }

            .card {
                margin: 20px;
            }

            .card-title {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <?php
    session_start();

    if (isset($_GET['logout']) && $_GET['logout'] == '1') {
        session_unset();
        session_destroy();

        header("Location: index.php");
        exit();
    }

    $servername = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $database_name = 'web';
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $database_name);

    ?>

    <?php require('assets/php/head.inc.php'); ?>

    <?php include('assets/php/navbar.inc.php'); ?>

    <?php include('assets/php/ModalStartQ.php'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quizCards = document.querySelectorAll('.card.quiz-card');
            quizCards.forEach(function(card) {
                card.addEventListener('click', function() {
                    // Remove 'active' class from all cards
                    quizCards.forEach(function(c) {
                        c.classList.remove('active');
                    });

                    // Add 'active' class to the clicked card
                    this.classList.add('active');

                    // Show the modal
                    $('#modalStartQuiz').modal('show');
                });
            });
        });
    </script>

    <br>

    <form class="d-flex justify-content-center" role="search" method="post">
        <input class="form-control me-2" style="width: 15rem;" type="search" name="search" placeholder="Title/Code" aria-label="Search">
        <button class="btn btn-primary border-dark" type="submit">Search</button>
    </form>

    <?php


    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];

        $stmt = $conn->prepare("SELECT * FROM quizlisttable WHERE (title LIKE '%$search%' OR code LIKE '%$search%') AND accessibility <> 'PRIVATE'");
        $stmt->execute();
        $result = $stmt->get_result();

        echo '<div class="container mt-4">';
        echo '<div class="row">';
        if ($result->num_rows > 0) {
            echo '<h5 class="card-subtitle" style="color: black;">Quiz found with ' . $search . '</h5>';
            while ($row = $result->fetch_assoc()) {
                $thumbnailPath = 'assets/img/uploads/' . htmlspecialchars($row["thumbnail"]);
                if ($row["thumbnail"] === 'default_img.jpg' || !file_exists($thumbnailPath)) {
                    $thumbnailPath = 'assets/img/uploads/default_img.jpg';
                }


                echo '<div class="col-xl-4 col-lg-6 mb-4">';
                echo '<div class="card quiz-card" data-quiz-code="' . htmlspecialchars($row["code"]) . '">'
                    . '<div class="card-body d-flex align-items-center">'
                    . '<div class="img-container me-3">'
                    . '<img src="' . $thumbnailPath . '" alt="Quiz Thumbnail" style="width: 100%; height: auto;">'
                    . '</div>'
                    . '<div class="flex-grow-1 d-flex flex-column">'
                    . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
                    . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
                    . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
                    . '</div>'
                    . '<div class="ms-auto text-md-end">'
                    . '<p class="views-text">Views: ' . htmlspecialchars($row["views"]) . '</p>'
                    . '</div>'
                    . '</div>'
                    . '</div>';
                echo '</div>';


                unset($_POST['search']);
            }
        } else {
            echo '<div class="col-12 text-center mb-5">'
                . '<h5 class="card-subtitle" style="color: black;">No quiz found with ' . $search . '</h5>'
                . '</div>';
            unset($_POST['search']);
        }

        echo '</div>';
        echo '</div>';
    }

    ?>

    <?php

    $itemsPerPage = 4;
    $sql = "SELECT COUNT(*) as count FROM quizlisttable WHERE accessibility <> 'PRIVATE'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalItems = $row['count'];
    $totalPages = ceil($totalItems / $itemsPerPage);


    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = (int) $_GET['page'];
    } else {
        $currentPage = 1;
    }

    $offset = ($currentPage - 1) * $itemsPerPage;
    $sql = "SELECT * FROM quizlisttable WHERE accessibility != 'PRIVATE' LIMIT $itemsPerPage OFFSET $offset";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<br>';
        echo '<div class="d-flex justify-content-center"><h5 class="card-title text-dark">Quiz List</h5></div>';
        echo '<div class="container mt-4 text-center">';
        echo '<div class="row justify-content-center">';
        while ($row = $result->fetch_assoc()) {
            $thumbnailPath = 'assets/img/uploads/' . htmlspecialchars($row["thumbnail"]);
            if ($row["thumbnail"] === 'default_img.jpg' || !file_exists($thumbnailPath)) {
                $thumbnailPath = 'assets/img/uploads/default_img.jpg';
            }

            echo '<div class="col-lg-6 col-md-6 mb-2">';
            echo '<div class="card quiz-card" data-quiz-code="' . htmlspecialchars($row["code"]) . '">'
                . '<div class="card-body d-flex align-items-center">'
                . '<div class="col-6 col-md-5 col-lg-4  img-container me-3">'
                . '<img src="' . $thumbnailPath . '" alt="Quiz Thumbnail" class="img-fluid">'
                . '</div>'
                . '<div class="flex-grow-1 d-flex flex-column">'
                . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
                . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
                . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
                . '</div>'
                . '<div class="ms-auto text-md-end">'
                . '<p class="views-text">Views: ' . htmlspecialchars($row["views"]) . '</p>'
                . '</div>'
                . '</div>'
                . '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="col-12">';
        echo '<div class=" text-center">'
            . ''
            . '<h5 class="card-title text-muted mt-5 mb-5">No Quizzes available</h5>'
            . ''
            . ''
            . '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '<nav aria-label="page nav">';
    echo '<ul class="pagination pagination-lg">';

    // Previous button
    if ($currentPage > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a></li>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo '<li class="page-item active" aria-current="page">';
            echo '<span class="page-link">' . $i . '</span>';
            echo '</li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Next button
    if ($currentPage < $totalPages) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';



    $conn->close();
    ?>


    <div class="footer-content">
        <div>
            <img src="assets/img/icons/curve1.svg" alt="" style="display: block; width: 100%;">
        </div>

        <div style="background-color: #fcbf49; width: 200%; height: 500px;">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>