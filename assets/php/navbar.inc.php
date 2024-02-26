<?php

if (isset($_GET['logout']) && $_GET['logout'] == '1') {
  session_unset();
  session_destroy();

  header("Location: index.php");
  exit();
}
?>

<section>
  <nav class="navbar navbar-expand-lg navbar-light nav-shadow font-moon-bold">
    <div class="container ">
      <a class="navbar-brand me-4" href="index.php">
        <img src="assets/img/icons/logo.svg" style="width: 110px; height: auto; overflow: visible" alt="QuizHero">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse d-flex justify-content-between align-items-end" id="navbarText">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item me-3">
            <?php if (isset($_SESSION['username'])) : ?>

              <a class="nav-link" href="MakeQuiz.php">Create Quiz</a>
            <?php else : ?>
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalLogin">Create Quiz</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['username'])) : ?>

              <a class="nav-link" href="List.php">Quiz List</a>
            <?php else : ?>
              <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modalLogin">Quiz List</a>
            <?php endif; ?>
          </li>
        </ul>
        <!-- Conditional display based on user login status -->
        <?php if (isset($_SESSION['username'])) : ?>
          <div class="navbar-text">
            Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            <a href="?logout=1" class="btn btn-primary ms-3">Logout</a>
          </div>
        <?php else : ?>
          <!-- Button to trigger Login Modal -->
          <form action="login.php" method="post" class="d-flex" role="search">
            <?php include('assets/php/modalLogin.inc.php'); ?>
            <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</button>
          </form>
          <!-- Button to trigger Signup Modal -->
          <form action="signup.php" method="post" class="d-flex" role="search">
            <?php include('assets/php/modalSignup.inc.php'); ?>
            <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#modalSignup">Sign up</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</section>