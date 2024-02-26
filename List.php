<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <style>
        .card {
            width: 20rem;
            padding: 5px;
            border: 1px solid #bd1717;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: purple;
            color: #2f11f2;
            text-align: left;
            cursor: pointer;
            margin: 20px auto;
            width: 58%;
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

        .img-container {
            flex: 0 0 50px;
            height: 50px;
            overflow: hidden;
            margin-right: 15px;
        }

        .img-container img {
            width: 100%;
            height: auto;
        }

        .text-content {
            flex: 1;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    $servername = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $database_name = 'web';

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $database_name);
    ?>

    <!-- header -->
    <?php require('assets/php/head.inc.php'); ?>
    <!-- navbar -->
    <?php include('assets/php/navbar.inc.php'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var quizCards = document.querySelectorAll('.card.quiz-card');
            quizCards.forEach(function (card) {
                card.addEventListener('click', function () {
                    var code_for_quiz = this.getAttribute('data-quiz-code');
                    window.location.href = 'answerQuiz.php?code_for_quiz=' + code_for_quiz;
                });
            });
        });
    </script>

    <br>

    <form class="d-flex justify-content-center" role="search" method="post">
        <input class="form-control me-2" style="width: 15rem;" type="search" name="quizCode" placeholder="Quiz Code"
            aria-label="Search">
        <button class="btn btn-primary border-dark" type="submit">Search</button>
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quizCode'])) {
        $_SESSION['quizCode'] = $_POST['quizCode'];
    }

    if (isset($_SESSION['quizCode'])) {
        $quizCode = $_SESSION['quizCode'];

        $stmt = $conn->prepare("SELECT * FROM quizlisttable WHERE code = ? AND accessibility <> 'PRIVATE'");
        $stmt->bind_param("s", $quizCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<hr style="border-top: 2px solid #ff4500; width: 73%; margin: auto;">';
                echo '<div class="d-flex justify-content-center"><h5 class="card-title" style="color: white;">Quiz found</h5></div>';
                $thumbnailPath = 'assets/img/uploads/' . htmlspecialchars($row["thumbnail"]);
                if ($row["thumbnail"] === 'default_img.jpg' || !file_exists($thumbnailPath)) {
                    $thumbnailPath = 'assets/img/uploads/default_img.jpg';
                }
                echo '<div class="card quiz-card" data-quiz-code="' . htmlspecialchars($row["code"]) . '">'
                    . '<div class="card-body d-flex align-items-center justify-content-between">'
                    . '<div class="left-content d-flex align-items-center">'
                    . '<div class="img-container me-3">'
                    . '<img src="' . $thumbnailPath . '" alt="Quiz Thumbnail" style="width: 100%; height: auto;">'
                    . '</div>'
                    . '<div>'
                    . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
                    . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
                    . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
                    . '</div>'
                    . '</div>'
                    . '<div class="right-content">'
                    . '<p class="views-text">Views: ' . htmlspecialchars($row["views"]) . '</p>'
                    . '</div>'
                    . '</div>'
                    . '</div>';
                echo '<hr style="border-top: 2px solid #ff4500; width: 60%; margin: auto;">';
                unset($_SESSION['quizCode']);
            }
        } else {
            unset($_SESSION['quizCode']);
            echo '<hr style="border-top: 2px solid #ff4500; width: 73%; margin: auto;">';
            echo '<br>';
            echo '<div data-quiz-code class="d-flex justify-content-center"><h5 class="card-subtitle" style="color: white;">No quiz found with code: ' . $quizCode . '</h5></div>';
            echo '<br>';
            echo '<hr style="border-top: 2px solid #ff4500; width: 73%; margin: auto;">';
        }
    }
    ?>

    <?php

    $itemsPerPage = 4;
    $sql = "SELECT COUNT(*) as count FROM quizlisttable";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalItems = $row['count'];
    $totalPages = ceil($totalItems / $itemsPerPage);
    echo '<div class="d-flex justify-content-center"><h5 class="card-title" style="color: white;">Quiz List</h5></div>';

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = (int) $_GET['page'];
    } else {
        $currentPage = 1;
    }

    $offset = ($currentPage - 1) * $itemsPerPage;
    $sql = "SELECT * FROM quizlisttable WHERE accessibility != 'PRIVATE' LIMIT $itemsPerPage OFFSET $offset";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $thumbnailPath = 'assets/img/uploads/' . htmlspecialchars($row["thumbnail"]);
            if ($row["thumbnail"] === 'default_img.jpg' || !file_exists($thumbnailPath)) {
                $thumbnailPath = 'assets/img/uploads/default_img.jpg';
            }

            echo '<div class="card quiz-card" data-quiz-code="' . htmlspecialchars($row["code"]) . '">'
                . '<div class="card-body d-flex align-items-center justify-content-between">'
                . '<div class="left-content d-flex align-items-center">'
                . '<div class="img-container me-3">'
                . '<img src="' . $thumbnailPath . '" alt="Quiz Thumbnail" style="width: 100%; height: auto;">'
                . '</div>'
                . '<div>'
                . '<h5 class="card-title">Quiz Title: ' . htmlspecialchars($row["title"]) . '</h5>'
                . '<h6 class="card-subtitle mb-2 text-muted">Quiz Code: ' . htmlspecialchars($row["code"]) . '</h6>'
                . '<p class="card-text">Creator: ' . htmlspecialchars($row["creator"]) . '</p>'
                . '</div>'
                . '</div>'
                . '<div class="right-content">'
                . '<p class="views-text">Views: ' . htmlspecialchars($row["views"]) . '</p>'
                . '</div>'
                . '</div>'
                . '</div>';
        }
    } else {
        echo '<div class="card quiz-card">'
            . '<div class="card-body d-flex align-items-center justify-content-between">'
            . '<div class="left-content d-flex align-items-center">'
            . '<p>No quiz found.</p>'
            . '</div>'
            . '</div>'
            . '</div>';
    }
    echo '<div class="pagination-container">';
    echo '<div class="card-body d-flex justify-content-center">';

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo "<b>$i</b> ";
        } else {
            echo "<a href='?page=$i'>$i</a> ";
        }
    }
    echo '</div>';
    echo '</div>';
    $conn->close();
    ?>

    <?php require('assets/php/footer.inc.php'); ?>
</body>

</html>
