<?php

include('include/header.php');
require('vendor/autoload.php');
require('prezlist-connect.php');

$informations = [];
$errors = [];
$author = '';
$title = null;
$duration = null;
$date = false;

if ($_POST) {
  $valid = true;

  if (isset($_POST['title']) && !empty(trim($_POST['title']))) {
    $title = $_POST['title'];
  } else {
    $valid = false;
    $errors['title'] = 'Vous devez spécifier un titre pour la veille';
  }

  if (isset($_POST['duration']) && !empty(trim($_POST['duration']))) {
    $duration = $_POST['duration'];
  }

  if (isset($_POST['author']) && !empty(trim($_POST['author']))) {
    $author = $_POST['author'];
  }

  if (isset($_POST['date']) && !empty(trim($_POST['date']))) {
    $date = $_POST['date'];
  }

  if ($valid) {
    try {
      $count = $conn->insert('presentation', [
        'title' => $title,
        'author' => $author,
        'duration' => $duration,
        'date' => $date,
      ]);

      $lastInsertId = $conn->lastInsertId();
    } catch (Exception $e) {
      // echo $e->getMessage();
      header('Location: error500.html', true, 302);
      exit();
    }

    $informations['form'] = $count . ' veille créée (id : ' . $lastInsertId . ')';
  }
}
?>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div>
        <a class="btn btn-primary" href="prezlist-select-html.php">Retour à la liste des veilles</a>
      </div>

      <h1>Création d'une veille</h1>
      <div>
        <?php
        if (isset($informations['form'])) {
          echo $informations['form'];
        }
        ?>
      </div>

      <form action="<?= basename(__FILE__) ?>" method="post">

        <div>
          <?php
          if (isset($errors['title'])) {
            echo $errors['title'];
          }
          ?>

        </div>
        <input type="text" name="author" value="<?= htmlentities($author) ?>" placeholder="Indiquez l'auteur de la veille" /><br />
        <input type="text" name="title" value="<?= htmlentities($title) ?>" placeholder="titre" /> *<br />
        <input type="text" name="duration" value="<?= htmlentities($duration) ?>" placeholder="duration" /><br />
        <input type="text" name="date" value="<?= htmlentities($date) ?>" placeholder="Indiquez la date de passage" /><br />


        <input type="submit" value="valider" class="btn btn-success" /><br />

      </form>
    </div><!-- /.col-xs-12 -->
  </div><!-- /.row -->
</div><!-- /.container -->
<?php
require('footer.php');
