<?php
require_once __DIR__ . '/utils/globals.php';
?>
<?php
require_once __DIR__ . '/templates/navbar.php';
?>
<div id="recipe-container" class="container-wrapper">
  <div id="recipe">
    <div id="recipe-image">
      <div class="recipe-photo">
        <div class="title">
          <h1>Lorem ipsum</h1>
        </div>
      </div>
      <div class="info">
        <div class="portions-and-time">
          <div class="portions"><i class="bi bi-circle-half"></i> 4 portions</div>
          <div class="time"><i class="bi bi-clock-fill"></i> 20min</div>
        </div>
        <div class="rating">
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star"></i>
        </div>
      </div>
    </div>
    <div id="recipe-body">
      <div id="ingredients">
        <h4 class="title">Ingredients:</h4>
        <ul>
          <li><i class="bi bi-check-lg"></i> 3 eggs</li>
          <li><i class="bi bi-check-lg"></i> 2 tea cups of wheat flour</li>
          <li><i class="bi bi-check-lg"></i> 2 tea cups of milk</li>
          <li><i class="bi bi-check-lg"></i> 1/2 tea cup of oil</li>
          <li><i class="bi bi-check-lg"></i> 1 tablespoon of butter</li>
          <li><i class="bi bi-check-lg"></i> salt to taste</li>
          <li><i class="bi bi-check-lg"></i> 1 teaspoon baking soup</li>
          <li><i class="bi bi-check-lg"></i> Shredded chicken seasoned to taste with corn, peas and curd cheese (for the
            filling)</li>
        </ul>
      </div>
      <div id="method-of-preparation">
        <h4 class="title">Methods of preparation:</h4>
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
          standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
          make a type specimen book. It has survived not only five centuries, but also the leap into electronic
          typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
        </p>
      </div>
      <div id="tips">
        <h4 class="title">Tips:</h4>
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
          standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
          make a type specimen book. It has survived not only five centuries, but also the leap into electronic
          typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
        </p>
      </div>
    </div>
  </div>
  <div id="others-recipes">
    <h4 class="title">you might also like...</h4>
    <div class="others">
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
</div>
<div id="comments-container" class="container-wrapper">
  <h4>Comments:</h4>
  <form action="#" id="comment-form">
    <label for="comment">
      <i class="bi bi-chat-text-fill"></i>
    </label>
    <input type="text" name="comment" id="comment" placeholder="What did you think of this recipe?">
    <button class="btn">comment</button>
  </form>
  <div id="comments">
    <div class="comment">
      <div class="user-profile">
        <div class="profile-image">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="profile-name">
          <h5>User name</h5>
        </div>
      </div>
      <div class="user-comment">
        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking
          at its layout. The poin.</p>
      </div>
    </div>
  </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
?>