<?php

/*
créez une base de données nommée prezlist qui stock des présentations
insérez-y des présentations fictives

une présentation possède les champs suivants :
- titre
- durée en minutes
- auteur
- date (jour seulement, pas besoin de l'heure)

créez une page web qui affiche la liste des présentations
*/
include('include/header.php');
require('vendor/autoload.php');
require('prezlist-connect.php');

$sql = "SELECT * FROM presentation";

$stmt = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title></title>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div>
          <a class="btn btn-primary" href="prezlist-insert-html.php">Ajouter une nouvelle veille</a>
        </div>
        <div>
          nombre de lignes : <?= $stmt->rowCount() ?>
        </div>

        <table class="table table-striped tanle-hover">
          <thead>
            <tr>
              <th>id</th>
              <th>Titre de la veille</th>
              <th>Son auteur</th>
              <th>Sa durée</th>
              <th>Sa date</th>
              <th>action</th>
            </tr>
          </thead>

        </div>
        <?php

        while ($row = $stmt->fetch()) {
          echo "<tr>\n";
          echo "<td>". $row['id'] . "</td>\n";
          echo "<td>". $row['title'] . "</td>\n";
          echo "<td>". $row['Author'] . "</td>\n";
          echo "<td>". $row['duration'] . "</td>\n";
          echo "<td>". $row['Date'] . "</td>\n";
          echo "<td>\n";
          echo "<a class=\"btn btn-primary\" href=\"prezlist-update-html.php?id=" . $row['id'] . "\">éditer</a>\n";
          echo "<a class=\"btn btn-danger\" href=\"prezlist-delete-html.php?id=" . $row['id'] . "\" onclick=\"return window.confirm(&quot;Voulez vraiment supprimer cet élément ?&quot;);\">supprimer</a>\n";
          echo "</td>\n";
          echo "</tr>\n";
        }
        ?>

      </table>

      <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>


    </body>
    </html>
