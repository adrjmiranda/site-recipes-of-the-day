<?php
$categories = $categoryDAO->findAll();
?>
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
  <script src="<?= $BASE_URL ?>js/toggle-menu-hidden.js" defer></script>
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
              <?php foreach (array_slice($categories, 0, 4) as $category): ?>
                <li>
                  <a href="<?= $BASE_URL ?>category.php?id=<?= $category->getId() ?>">
                    <?= $category->getCategoryName() ?>
                  </a>
                </li>
              <?php endforeach; ?>
              <li class="more">
                <a href="#" class="more-recipes">more <i class="bi bi-caret-down-fill"></i></a>
                <div class="drop-more">
                  <ul>
                    <?php foreach (array_slice($categories, 4) as $category): ?>
                      <li>
                        <a href="<?= $BASE_URL ?>category.php?id=<?= $category->getId() ?>">
                          <?= $category->getCategoryName() ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
          <div id="search">
            <form action="search.php" method="post">
              <input type="search" name="search" id="search" placeholder="search recipe">
              <button type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div>
          <?php if ($user): ?>
            <a href="<?= $BASE_URL ?>logout.php" class="btn login"><i class="bi bi-box-arrow-left"></i> logout</a>
            <a href="<?= $BASE_URL ?>user_profile.php" class="btn login"><i class="bi bi-person-square"></i></a>
          <? else: ?>
            <a href="<?= $BASE_URL ?>login.php" class="btn login"><i class="bi bi-person-fill"></i> enter</a>
          <?php endif; ?>
          <div id="toggle-menu">
            <button type="button"><i class="bi bi-list"></i></button>
          </div>
          <div id="menu-hidden" class="hidden">
            <div class="main logo">
              <a href="<?= $BASE_URL ?>index.php"><img src="<?= $BASE_URL ?>assets/recipesoftheday_logo.svg"
                  alt="Logo - Recipes Of The Day">
                Recipes Of The Day</a>
            </div>
            <h3>Menu: <div id="close-menu">
                <button type="button"><i class="bi bi-x-lg"></i></button>
              </div>
            </h3>
            <ul>
              <?php foreach ($categories as $category): ?>
                <li>
                  <a href="<?= $BASE_URL ?>category.php?id=<?= $category->getId() ?>">
                    <?= $category->getCategoryName() ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </nav>