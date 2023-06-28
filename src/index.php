<?php
require_once __DIR__ . '/utils/globals.php';

$categoriesBg = [
  'rice_and_risotto.jpg',
  'birds.jpg',
  'meat.jpg',
  'pastas.jpg',
  'cakes.jpg',
  'sweets_and_desserts.jpg',
  'salads.jpg',
  'snacks_and_snacks.jpg',
  'starters_and_snacks.jpg',
  'breads.jpg',
  'fishes_and_sea_food.jpg',
  'drinks.jpg',
  'sauces_and_pâtés.jpg',
  'soups_and_broths.jpg',
  'special.jpg'
];
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
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Satisfy&display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- js scipts -->
  <script src="<?= $BASE_URL ?>js/scripts.js" defer></script>
</head>

<body>
  <div class="container">
    <header>
      <nav id="navbar">
        <div class="container-wrapper">
          <div class="logo">
            <a href="<?= $BASE_URL ?>index.php"><span class="material-symbols-rounded">restaurant_menu</span> Recipes Of
              The Day</a>
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
                <a href="#">more <span class="material-symbols-rounded">arrow_drop_down</span></a>
              </li>
            </ul>
          </div>
          <div id="search">
            <form action="">
              <input type="search" name="search" id="search" placeholder="search recipe">
              <button type="submit" class="btn"><span class="material-symbols-rounded">search</span></button>
            </form>
          </div>
          <a href="#" class="btn login"><span class="material-symbols-rounded">person</span> enter</a>
        </div>
      </nav>
      <div id="banner">
        <?php foreach ($categoriesBg as $categoryBg): ?>
          <div class="category-bg" style="background-image: url('assets/imgs/categories/<?= $categoryBg ?>');"></div>
        <?php endforeach; ?>
      </div>
    </header>
    <div id="most-searched-recipes">
      <div class="most-searched-recipes container-wrapper">
        <h3>Most searched recipes</h3>
        <div class="most-searched-recipes-card"></div>
        <div class="most-searched-recipes-card"></div>
        <div class="most-searched-recipes-card"></div>
        <div class="most-searched-recipes-card"></div>
      </div>
    </div>
    <div id="top-rated">
      <div class="top-rated container-wrapper">
        <h3>Top rated</h3>
        <div class="top-rated-card"></div>
        <div class="top-rated-card"></div>
        <div class="top-rated-card"></div>
        <div class="top-rated-card"></div>
      </div>
    </div>
    <div id="special">
      <div class="special container-wrapper">
        <h3>Special</h3>
        <div class="special-card"></div>
        <div class="special-card"></div>
        <div class="special-card"></div>
        <div class="special-card"></div>
      </div>
    </div>
    <div id="new-recipes">
      <div class="new-recipes container-wrapper">
        <h3>New recipes</h3>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
        <div class="new-recipe-card"></div>
      </div>
    </div>
    <footer id="footer">
      <div id="social-media">
        <div class="logo">
          <a href="<?= $BASE_URL ?>index.php"><span class="material-symbols-rounded">restaurant_menu</span> Recipes Of
            The Day</a>
        </div>
        <div class="social">
          <a href="#" class="social-btn"></a>
          <a href="#" class="social-btn"></a>
          <a href="#" class="social-btn"></a>
          <a href="#" class="social-btn"></a>
        </div>
      </div>
      <div id="reserved-rights"></div>
    </footer>
  </div>
</body>

</html>