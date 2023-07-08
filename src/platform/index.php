<?php
require_once __DIR__ . '/../utils/globals.php';
require_once __DIR__ . '/../connection/conn.php';
require_once __DIR__ . '/../dao/AdminDAO.php';

use dao\AdminDAO;

$adminDAO = new AdminDAO($conn);

$admin = null;

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

  $admin = $adminDAO->findByToken($token);
}

if (!$admin) {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>without bootstrap</title>
  <!-- summernote -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <!-- data tables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
  <!-- bootstrap icons -->
</head>

<body>
  <div class="container">
    <div id="more-options" class="hide">
      <div class="profile">
        <div class="profile-image"></div>
        <h4 class="profile-name"></h4>
      </div>
      <div class="options">
        <ul>
          <li>
            <a href="#">Recipes</a>
          </li>
          <li>
            <a href="#">Categories</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content">
      <nav>
        <div id="nav-options">
          <button id="more">
            <i class="bi bi-list"></i>
          </button>
          <div id="nav-actions">
            <button class="btn logout"><i class="bi bi-box-arrow-right"></i></button>
            <button class="btn add"><i class="bi bi-plus-lg"></i> Add Recipe</button>
          </div>
        </div>
      </nav>
      <div id="recipes-list">
        <h2>Recipes Added:</h2>
        <div id="recipes">
          <table id="recipes-table" class="display compact" style="width:100%">
            <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Rating</th>
                <th>Age</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Rating</th>
                <th>Age</th>
                <th>Actions</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- <div id="summernote"></div> -->
  <script>
    $('#summernote').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });

    $(document).ready(function () {
      $('#recipes-table').DataTable();
    });
  </script>
</body>

</html>