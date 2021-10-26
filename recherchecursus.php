<?php
include 'functions.php';
session_start();
?>
<?= template_header('Recherche cursus') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";
?>

<h2 class="text-center text-warning mt-5 mb-5">Recherche des cursus</h2>

<!-- <div class="container"> -->
<form action='' method='POST'>
    <div class='container mx-5 px-5 mb-5'>
        <span class='glyphicon glyphicon-search form-control-feedback'></span>
        <input name='recherche' type='text' class='text-center form-control' placeholder="Tapez votre recherche selon le Nom ou l'Année du cursus">
    </div>
</form>
<!-- <div> -->

<?php

// Récupère la recherche
if (isset($_POST['recherche'])) {
    $recherche = $_POST['recherche'];
    $select_stmt = $db->prepare("SELECT matiere, annee, frais FROM p2_g3_cursus WHERE matiere LIKE '%$recherche%' OR annee LIKE '%$recherche%'");
    $select_stmt->execute();

    // affichage du résultat
    echo "<div class='container bg-light'>";
    // echo "<h2>Résultat des recherches</h2>";
    echo "<table class='table table-bordered table-striped table-dark table-hover'>";
    if ($select_stmt->rowCount() < 1) {
        echo '<h3 class="text-center text-danger p-2">Pas de résultat trouvé</h3>';
    } else {
?>
        <tr>
            <td>Matière</td>
            <td>Année scolaire</td>
            <td>Montant des frais de scolarité</td>
        </tr>
<?php
        while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<form action='' method='POST'>";
            echo "<tr>";
            echo "<td>" . $row['matiere'] . "</td>";
            echo "<td>" . $row['annee'] . "</td>";
            echo "<td>" . $row['frais'] . "</td>";
            echo "</tr>";
            echo "</form>";
        }
    }
    echo "</table>";
    echo "</div>";
}

?>
<div class="text-center"> [ <a href="indexadmin.php">Retour</a> ] </div>
<br><br>
</body>

</html>

<?= template_footer() ?>