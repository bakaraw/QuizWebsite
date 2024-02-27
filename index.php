<?php
session_start();
?>

<!-- header -->
<?php require('assets/php/head.inc.php'); ?>

<!-- navbar -->
<?php include('assets/php/navbar.inc.php'); ?>
<div class="container">
  <div class="container mt-5 pt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <!-- Your existing content here -->
        <div class="card bg-transparent border-dark" style="width: 38rem; --bs-border-opacity: 0; margin-top:4rem ;">
          <div class="pt-5">
            <h1 class="card-title h1 font-moon-bold mb-5 text-orange">Create quiz with just a few clicks</h1>
            <p class="card-text font-roboto-light h5 mb-5" style="width: 35rem;">
              QuizHero is a website that lets you create fun and engaging quizzes for any topic or occasion. Whether you want to test your knowledge, challenge your friends, or spice up your classroom, QuizHero has you covered.
            </p>
            <a href="#" class="btn btn-primary btn-lg text-dark border-dark">Start now</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 ms-auto">
        <!-- Image positioned at the very right -->
        <img src="assets/img/art/314.jpg" class="img-fluid" alt="Image" style="max-width: 100%; height: auto;">
      </div>
    </div>
  </div>
</div>

<img src="assets/img/icons/curve1.svg" alt="">

<div style="background-color: #fcbf49; width: 100%;">

  <div class="container">
    <img class="me-auto img-shadow" src="assets/img/art/brain-art.png" alt="" style="float: left; width:380px; height: auto;">
    <div class="card border-dark ms-auto bg-orange" style="width: 37rem; --bs-border-opacity: 0;">
      <div class="pt-5">
        <h5 class="card-title h1 pb-4 d-flex justify-content-end font-moon-bold">Test your knowledge</h5>
        <p class="card-text text-end font-roboto-light mb-4 font-roboto-light  ">Immerse yourself in a diverse range of quizzes created by fellow enthusiasts. From brain teasers to fun facts, QuizHero is your playground for endless learning and entertainment. Answer with flair, share your insights, and embark on a journey of discovery with QuizHero - where every quiz is a chance to showcase your brilliance!</p>
        <form class="d-flex justify-content-end mt-4 mb-5" role="search" id="search-form">
          <input class="form-control me-2 rounded ms-auto" style="width: 15rem;" type="search" placeholder="Quiz Code" aria-label="Search" id="quizcode-search">
          <button class="btn btn-info border-dark" type="submit" id="search-btn">Search</button>
        </form>
      </div>
    </div>
  </div>

</div>
<img src="assets/img/icons/curve2.svg" alt="">


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