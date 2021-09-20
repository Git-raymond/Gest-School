<?php
include 'functions.php';
session_start();
?>
<?= template_header('statistiques') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

$stmt = $db->prepare("SELECT count(*) FROM comptes WHERE type='famille'");
$stmt->execute();
$nombreFamille = $stmt->fetchColumn();

$select_stmt = $db->prepare("SELECT * FROM comptes JOIN famille ON comptes.famille_id=famille.idFamille JOIN eleve ON famille.idFamille=eleve.famille_id JOIN cursus ON eleve.cursus_id=cursus.idCursus");
$select_stmt->execute();



?>
<br>
<h2 class="text-center text-warning">STATISTIQUES</h2><br>
<h4 class="text-center text-primary">Nombre de familles inscrites sur le site : <span class="text-danger"><?= $nombreFamille; ?></span></h4>

<div class="container">
    <h4 class="text-center text-primary mt-5 mb-3">Liste des familles avec les profils de leurs enfants</h4>
    <?php
    if ($select_stmt->rowCount() > 0) {
    ?>
        <table class="table table-bordered table-striped table-dark table-hover bg-light">
            <tr>
                <td>Nom</td>
                <td>Email</td>
                <td>Rôle</td>
                <td>Matière</td>
                <td>Année scolaire</td>
                <td>Frais de scolarité</td>
            </tr>
            <?php
            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' value='" . $row['id'] . "' name='userid' />";
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['matiere'] . "</td>";
                echo "<td>" . $row['annee'] . "</td>";
                echo "<td>" . $row['frais'] . "</td>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </table>
</div>
<?php
    } else {
        echo ".<br><br><div class='text-center text-danger'><p>Aucune famille ni élève inscrit !</p></div></div>";
    }
?>

<?php
$select_stmt = $db->prepare("SELECT * FROM comptes JOIN enseignant ON comptes.enseignant_id=idEnseignant JOIN cursus ON enseignant.idEnseignant=cursus.enseignant_id ORDER BY cursus.idCursus ASC");
$select_stmt->execute();
?>

<div class="container">
    <h4 class="text-primary text-center mt-5 mb-3">Liste des enseignants par cursus</h4>
    <?php
    if ($select_stmt->rowCount() > 0) {
    ?>
        <table class="table table-bordered table-striped table-dark table-hover bg-light">
            <tr>
                <td>Matière</td>
                <td>Année</td>
                <td>Nom</td>
                <td>Email</td>
                <td>Rôle</td>
            </tr>
            <?php
            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' value='" . $row['id'] . "' name='userid' />";
                echo "<tr>";
                echo "<td>" . $row['matiere'] . "</td>";
                echo "<td>" . $row['annee'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </table>
</div>
<br><br>
<?php
    } else {
        echo ".<br><br><div class='text-center text-danger'><p>Aucun enseignant inscrit !</p></div></div>";
    }
?>
<br><br>
<div class="text-center"> [ <a href="indexadmin.php">Retour</a> ] </div>
<br><br>
</body>

</html>

<?= template_footer() ?>