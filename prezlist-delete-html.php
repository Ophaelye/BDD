<?php

include('include/header.php');
require('vendor/autoload.php');
require('prezlist-connect.php');

$informations = [];
$errors = [];
$id = null;

$valid = true;

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
  $id = $_GET['id'];
} else {
  $valid = false;
  $errors['id'] = 'Vous devez spécifier une tâche à supprimer';
}

if ($valid) {
  try {
    $count = $conn->delete('presentation', ['id' => $id]);
  } catch (Exception $e) {
    // echo $e->getMessage();
    header('Location: error500.html', true, 302);
    exit();
  }

  $informations['delete'] = $count . ' veille supprimée (id: ' . $id . ')';
}

?>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div>

        <a class="btn btn-primary" href="prezlist-select-html.php">Retour à la liste des veilles</a>
      </div>

      <h1>Suppression d'une veille</h1>

      <div>

        <?php
        if (isset($informations['delete'])) {
          echo $informations['delete'];
        }
        ?>

        <div>
          <?php
          if (isset($errors['id'])) {
            echo $errors['id'];
          }
          ?>
        </div>
      </div><!-- /.col-xs-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
  <?php
  require('footer.php');
