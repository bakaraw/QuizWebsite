<?php
session_start();
?>

<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>

<div class="container m-5"></div>
<div class="container">
  <div class="card bg-dark text-light border-dark" style="width: 30rem;">
    <div class="pt-5" ">
    <h1 class=" card-title h1 pb-3 font-moon-bold">Create quiz with just a few clicks</h1>
      <p class="card-text " style="width: 30rem;">
        QuizHero is a website that lets you create fun and engaging quizzes for any topic or occasion. Whether you want to test your knowledge, challenge your friends, or spice up your classroom, QuizHero has you covered.
      </p>
      <a href="#" class="btn btn-warning text-dark border-dark">Start now</a>
    </div>
  </div>
</div>

<div class="container m-5"></div>
<div class="container">
  <div class="card bg-dark text-light border-dark ms-auto " style="width: 37rem;">
    <div class="pt-5 " ">
    <h5 class=" card-title h1 pb-3 d-flex justify-content-end " >Test your knowledge</h5>
    <p class=" card-text text-end">Immerse yourself in a diverse range of quizzes created by fellow enthusiasts. From brain teasers to fun facts, QuizHero is your playground for endless learning and entertainment. Answer with flair, share your insights, and embark on a journey of discovery with QuizHero - where every quiz is a chance to showcase your brilliance!</p>
      <form class="d-flex justify-content-end" role="search" id="search-form">
        <input class="form-control me-2" style="width: 15rem;" type="search" placeholder="Quiz Code" aria-label="Search" id="quizcode-search">
        <button class="btn btn-primary border-dark" type="submit" id="search-btn">Search</button>
      </form>
    </div>
  </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="no-quiz-found" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">QuizHero</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Quiz not found :\
    </div>
  </div>
</div>

<?php include('assets/php/modalLogin.inc.php'); ?>

<script>
  $(document).ready(function() {
    $('#search-form').submit(function(e) {
      e.preventDefault();
      var quizcode = $('#quizcode-search').val();
      var session_username = '<?php if (isset($_SESSION['username'])){echo $_SESSION['username'];} ?>';

      // Send an AJAX request to check if the quizcode exists
      if (session_username !== "") {
        if (quizcode !== "") {

          $.ajax({
            type: "POST",
            url: "assets/ajax/checkQuizCode.php", // PHP file to handle the AJAX request
            data: {
              quizcode: quizcode
            },
            success: function(response) {

             

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
        console.log('uten');
        $('#modalLogin').modal('show');
      }
    });
  });
</script>
<!-- footer -->
<?php require('assets/php/footer.inc.php'); ?>