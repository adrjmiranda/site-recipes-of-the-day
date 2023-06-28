<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="assets/recipesoftheday_icon.svg" type="image/x-icon">
  <title>Recipes Of The Day</title>
  <!-- style sheet -->
  <link rel="stylesheet" href="css/styles.css">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Satisfy&display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
  <div class="container-expanded">
    <div class="container">
      <header>
        <nav id="navbar">
          <div class="logo">
            <a href="#"><span class="material-symbols-rounded">restaurant_menu</span> Recipes Of The Day</a>
          </div>
        </nav>
      </header>
    </div>
  </div>
</body>

</html>
=======
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
<?php require_once __DIR__ . '/templates/navbar.php' ?>
<div id="banner">
  <?php foreach ($categoriesBg as $categoryBg): ?>
    <div class="category-bg container-wrapper"
      style="background: linear-gradient(rgba(0, 0, 0, .1), rgba(0, 0, 0, .1)), url('assets/imgs/categories/<?= $categoryBg ?>') no-repeat center; background-size: cover;">
    </div>
  <?php endforeach; ?>
</div>
</header>
<div id="most-searched-recipes">
  <div class="most-searched-recipes container-wrapper">
    <h3 class="title">Most searched recipes</h3>
    <div class="most-searched-recipes-card">
      <div class="most-searched-image">
        <div class="most-searched-time"><i class="bi bi-clock"></i> 20min</div>
      </div>
      <div class="most-searched-title">
        <h4>Lorem Ipsum is simply dummy</h4>
      </div>
    </div>
    <div class="most-searched-recipes-card">
      <div class="most-searched-image">
        <div class="most-searched-time"><i class="bi bi-clock"></i> 20min</div>
      </div>
      <div class="most-searched-title">
        <h4>Lorem Ipsum is simply dummy</h4>
      </div>
    </div>
    <div class="most-searched-recipes-card">
      <div class="most-searched-image">
        <div class="most-searched-time"><i class="bi bi-clock"></i> 20min</div>
      </div>
      <div class="most-searched-title">
        <h4>Lorem Ipsum is simply dummy</h4>
      </div>
    </div>
    <div class="most-searched-recipes-card">
      <div class="most-searched-image">
        <div class="most-searched-time"><i class="bi bi-clock"></i> 20min</div>
      </div>
      <div class="most-searched-title">
        <h4>Lorem Ipsum is simply dummy</h4>
      </div>
    </div>
  </div>
</div>
<div id="top-rated">
  <div class="top-rated container-wrapper">
    <h3 class="title">Top rated</h3>
    <div class="top-rated-card">
      <div class="top-rated-image">
        <div class="top-rated-title">
          <h4>Lorem Ipsum is simply dummy</h4>
        </div>
        <div class="top-rated-rating"><i class="bi bi-star-fill"></i> 5</div>
      </div>
    </div>
    <div class="top-rated-card">
      <div class="top-rated-image">
        <div class="top-rated-title">
          <h4>Lorem Ipsum is simply dummy</h4>
        </div>
        <div class="top-rated-rating"><i class="bi bi-star-fill"></i> 5</div>
      </div>
    </div>
    <div class="top-rated-card">
      <div class="top-rated-image">
        <div class="top-rated-title">
          <h4>Lorem Ipsum is simply dummy</h4>
        </div>
        <div class="top-rated-rating"><i class="bi bi-star-fill"></i> 5</div>
      </div>
    </div>
    <div class="top-rated-card">
      <div class="top-rated-image">
        <div class="top-rated-title">
          <h4>Lorem Ipsum is simply dummy</h4>
        </div>
        <div class="top-rated-rating"><i class="bi bi-star-fill"></i> 5</div>
      </div>
    </div>
  </div>
</div>
<div id="special">
  <div class="special container-wrapper">
    <h3 class="title">Special</h3>
    <div class="special-card">
      <div class="special-card-image"></div>
      <div class="special-info">
        <div class="special-title">
          <h4>Lorem Ipsum is simply dummy</h4>
        </div>
        <div class="special-time">
          <span><i class="bi bi-clock-fill"></i> 15min</span>
        </div>
      </div>
    </div>
    <div class="special-card">
      <div class="special-card-image"></div>
      <div class="special-info">
        <div class="special-title">
          <h4>Lorem Ipsum is simply dummy</h4>
        </div>
        <div class="special-time">
          <span><i class="bi bi-clock-fill"></i> 15min</span>
        </div>
      </div>
    </div>
    <div class="special-card">
      <div class="special-card-image"></div>
      <div class="special-info">
        <div class="special-title">
          <h4>Lorem Ipsum is simply dummy</h4>
        </div>
        <div class="special-time">
          <span><i class="bi bi-clock-fill"></i> 15min</span>
        </div>
      </div>
    </div>
    <div class="special-card">
      <div class="special-card-image"></div>
      <div class="special-info">
        <div class="special-title">
          <h4>Lorem Ipsum is simply dummy</h4>
        </div>
        <div class="special-time">
          <span><i class="bi bi-clock-fill"></i> 15min</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="new-recipes">
  <div class="new-recipes container-wrapper">
    <h3 class="title">New recipes</h3>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
    <div class="recipe-card">
      <div class="recipe-image">
        <h4>Lorem Ipsum is simply dummy</h4>
        <div class="recipe-time"><i class="bi bi-stopwatch"></i> 20min</div>
        <span class="rating"><i class="bi bi-star-fill"></i> 4</span>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/templates/footer.php' ?>
>>>>>>> home
