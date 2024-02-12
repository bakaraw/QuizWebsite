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
    <h5 class="card-title h1 pb-3">Create quiz with just a few clicks</h5>
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
    <h5 class="card-title h1 pb-3 d-flex justify-content-end " >Test your knowledge</h5>
    <p class="card-text text-end">Immerse yourself in a diverse range of quizzes created by fellow enthusiasts. From brain teasers to fun facts, QuizHero is your playground for endless learning and entertainment. Answer with flair, share your insights, and embark on a journey of discovery with QuizHero - where every quiz is a chance to showcase your brilliance!</p>
    <form class="d-flex justify-content-end" role="search">
        <input class="form-control me-2" style="width: 15rem;" type="search" placeholder="Quiz Code" aria-label="Search">
        <button class="btn btn-primary border-dark" type="submit">Search</button>
      </form>
  </div>
</div>
</div>

<!-- footer -->
<?php require('assets/php/footer.inc.php'); ?>

