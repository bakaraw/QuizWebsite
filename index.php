<?php
session_start();
?>

<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<div class="container mt-2 pt-5">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6">
      <div class="card bg-transparent border-dark" style="--bs-border-opacity: 0;">
        <div class="card-body">
          <h1 class="card-title h1 font-moon-bold mb-4 text-orange">Create quiz with just a few clicks</h1>
          <p class="card-text font-roboto-light h5 mb-4">
            QuizHero is a website that lets you create fun and engaging quizzes for any topic or occasion. Whether you
            want to test your knowledge, challenge your friends, or spice up your classroom, QuizHero has you covered.
          </p>
          <a id="start-now" class="btn btn-primary btn-lg text-dark border-dark">Start now</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <img src="assets/img/art/314.jpg" class="img-fluid" alt="Image">
    </div>
  </div>
</div>

<img src="assets/img/icons/curve1.svg" alt="" style="--bs-border-opacity: 0;">
<div class="bg-orange" style="--bs-border-opacity: 0;">
  <div class="container pt-5 pb-5">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img class="img-fluid mb-4" src="assets/img/art/brain-art.png" alt="Brain Art">
      </div>
      <div class="col-md-6">
        <div class="card border-dark bg-transparent" style="--bs-border-opacity: 0;">
          <div class="card-body">
            <h5 class="card-title h1 pb-4 font-moon-bold text-end">Test your knowledge</h5>
            <p class="card-text font-roboto-light mb-4 text-end">
              Immerse yourself in a diverse range of quizzes created by fellow enthusiasts. From brain teasers to fun
              facts, QuizHero is your playground for endless learning and entertainment. Answer with flair, share your
              insights, and embark on a journey of discovery with QuizHero - where every quiz is a chance to showcase
              your brilliance!
            </p>
            <form class="d-flex justify-content-end mt-4 mb-4" role="search" id="search-form">
              <input class="form-control me-2 rounded" style="max-width: 15rem;" type="search" placeholder="Quiz Code"
                aria-label="Search" id="quizcode-search">
              <button class="btn btn-info border-dark" type="submit" id="search-btn">Search</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="no-quiz-found" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header bg-orange">
      <strong class="me-auto">QuizHero</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Quiz not found :\
    </div>
  </div>
</div>

<?php include('assets/php/modalLogin.inc.php'); ?>
<footer>
  <div class="bg-dark d-flex justify-content-center align-items-center" style="height: 200px;">
    <div class="text-center">
      <img src="assets/img/icons/logo-white.png" alt="logo" style="width:150px; height: auto;">
      <div class="text-light mt-3">
        <small>
          &copy;
          <?php
          $currentYear = date("Y");
          echo $currentYear; // Output: 2024 (or whatever the current year is)
          ?> QuizHero. All rights reserved.
        </small>
        <small>
          Arts from freepik.com
        </small>


      </div>
    </div>
  </div>



  </div>
</footer>
<script>
  $(document).ready(function () {
    $('#search-form').submit(function (e) {
      e.preventDefault();
      var quizcode = $('#quizcode-search').val();
      var session_username = '<?php if (isset($_SESSION['username'])) {
        echo $_SESSION['username'];
      } ?>';

      // Send an AJAX request to check if the quizcode exists
      if (session_username !== "") {
        if (quizcode !== "") {

          $.ajax({
            type: "POST",
            url: "assets/ajax/checkQuizCode.php", // PHP file to handle the AJAX request
            data: {
              quizcode: quizcode
            },
            success: function (response) {
              if (response === 'exists') {
                var url = "answerQuiz.php?code_for_quiz=" + quizcode;
                window.location.href = url;
              } else {
                $('.toast-body').text('Quiz not found :(');
                $('#no-quiz-found').toast('show');
              }
            }
          });

        } else {
          $('.toast-body').text('Please input code');
          $('#no-quiz-found').toast('show');
        }
      } else {

        $('#modalLogin').modal('show');
      }
    });

    $('#start-now').click(function (e) {
      e.preventDefault();
      var session_username = '<?php if (isset($_SESSION['username'])) {
        echo $_SESSION['username'];
      } ?>';
      if (session_username != "") {
        window.location.href = 'MakeQuiz.php';
      } else {
        $('#modalLogin').modal('show');
      }
    });
  });
</script>

<!-- footer -->
<?php require('assets/php/footer.inc.php'); ?>