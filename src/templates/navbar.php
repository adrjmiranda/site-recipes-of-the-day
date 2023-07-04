<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= $BASE_URL ?>assets/recipesoftheday_icon.svg" type="image/x-icon">
  <title>Recipes Of The Day</title>
  <!-- style sheet -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Pacifico&display=swap"
    rel="stylesheet">
  <!-- bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- js scipts -->
  <script src="<?= $BASE_URL ?>js/scripts.js" defer></script>
  <script src="<?= $BASE_URL ?>js/selected-rate.js" defer></script>
</head>

<body>
  <div class="container">
    <header>
      <nav id="navbar">
        <div class="nav container-wrapper">
          <div class="logo">
            <a href="<?= $BASE_URL ?>index.php"><img src="<?= $BASE_URL ?>assets/recipesoftheday_logo.svg"
                alt="Logo - Recipes Of The Day">
              Recipes Of The Day</a>
          </div>
          <div id="menu">
            <ul>
              <li>
                <a href="#">birds</a>
              </li>
              <li>
                <a href="#">meat</a>
              </li>
              <li>
                <a href="#">pastas</a>
              </li>
              <li>
                <a href="#">cakes</a>
              </li>
              <li>
                <a href="#">more <i class="bi bi-caret-down-fill"></i></a>
              </li>
            </ul>
          </div>
          <div id="search">
            <form action="">
              <input type="search" name="search" id="search" placeholder="search recipe">
              <button type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div>
          <?php if ($user): ?>
            <a href="<?= $BASE_URL ?>logout.php" class="btn login"><i class="bi bi-box-arrow-left"></i> logout</a>
          <? else: ?>
            <a href="<?= $BASE_URL ?>login.php" class="btn login"><i class="bi bi-person-fill"></i> enter</a>
          <?php endif; ?>
        </div>
      </nav>