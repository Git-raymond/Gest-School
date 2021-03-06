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

$stmt = $db->prepare("SELECT count(*) FROM p2_g3_comptes WHERE type='famille'");
$stmt->execute();
$nombreFamille = $stmt->fetchColumn();
?>
<br>
<h2 class="text-center text-warning">STATISTIQUES</h2><br>
<h4 class="text-center text-primary">Nombre de familles inscrites sur le site : <span class="text-danger"><?= $nombreFamille; ?></span></h4>

<div class="container">
    <h4 class="text-center text-primary mt-5 mb-3">Liste des familles</h4>
    <?php
    $select_stmt = $db->prepare("SELECT * FROM p2_g3_comptes WHERE type='famille'");
    $select_stmt->execute();

    if ($select_stmt->rowCount() > 0) {
    ?>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table class="table table-bordered table-striped table-dark table-hover bg-light">
                <tr>
                    <td>Nom</td>
                    <td>Email</td>
                    <td>Rôle</td>
                </tr>
                <?php
                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<form action='' method='POST'>";
                    echo "<input type='hidden' value='" . $row['id'] . "' name='userid' />";
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['type'] . "</td>";
                    echo "</tr>";
                    echo "</form>";
                }
                ?>
            </table>
        </div>
</div>
<?php
    } else {
        echo ".<br><br><div class='text-center text-danger'><p>Aucune famille ni élève inscrit !</p></div></div>";
    }
?>


<div class="container">
    <h4 class="text-center text-primary mt-5 mb-3">Liste des profils de leurs enfants</h4>
    <?php
    $select_stmt = $db->prepare("SELECT username, email, type,  matiere, annee, frais FROM p2_g3_comptes JOIN p2_g3_eleve ON p2_g3_comptes.eleve_id=p2_g3_eleve.idEleve JOIN p2_g3_cursus ON p2_g3_eleve.cursus_id=p2_g3_cursus.idCursus");
    $select_stmt->execute();

    if ($select_stmt->rowCount() > 0) {
    ?>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
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
                    // echo "<input type='hidden' value='" . $row['id'] . "' name='userid' />";
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
</div>
<?php
    } else {
        echo ".<br><br><div class='text-center text-danger'><p>Aucune famille ni élève inscrit !</p></div></div>";
    }
?>

<?php
$select_stmt = $db->prepare("SELECT * FROM p2_g3_comptes JOIN p2_g3_enseignant ON p2_g3_comptes.enseignant_id=idEnseignant JOIN p2_g3_cursus ON p2_g3_enseignant.idEnseignant=p2_g3_cursus.enseignant_id ORDER BY p2_g3_cursus.idCursus ASC");
$select_stmt->execute();
?>

<div class="container">
    <h4 class="text-primary text-center mt-5 mb-3">Liste des enseignants par cursus</h4>
    <?php
    if ($select_stmt->rowCount() > 0) {
    ?>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
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