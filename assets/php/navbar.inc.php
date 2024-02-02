<section>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container ">
    <a class="navbar-brand" href="index.php">QuizHero</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="MakeQuiz.php">Make a Quiz</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Answer Quiz</a>
        </li>
      </ul>
     
      

<!-- Button to trigger Login Modal -->
<form action="login.php" method="post" class="d-flex" role="search">
    <?php include('assets/php/modalLogin.inc.php'); ?>

    <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</button>
</form>

<!-- Button to trigger Signup Modal -->
<form action="signup.php" method="post" class="d-flex" role="search">
    <?php include('assets/php/modalSignup.inc.php'); ?>

    <button class="btn btn-light me-2" type="button" data-bs-toggle="modal" data-bs-target="#modalSignup">Sign up</button>
</form>











    </div>
  </div>
</nav>
</section>