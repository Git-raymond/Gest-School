<?php
include 'functions.php';
session_start();
$famille_id = $_SESSION['famille_id'];
?>
<?= template_header('Liste élèves famille non scolarisés') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

$select_stmt = $db->prepare("SELECT * FROM p2_g3_comptes INNER JOIN p2_g3_eleve ON p2_g3_comptes.eleve_id=p2_g3_eleve.idEleve WHERE cursus_id IS NULL AND p2_g3_eleve.famille_id=$famille_id");
$select_stmt->execute();

?>
<div class="container">
    <h2 class="text-warning text-center mt-5 mb-3">Liste des élèves en attente de scolarisation</h2>
    <br>
    <?php
    if ($select_stmt->rowCount() > 0) {
    ?>
        <table class="table table-bordered table-striped table-dark table-hover bg-light">
            <tr>
                <td>Prénom</td>
                <td>Email</td>
                <td>Statut (1=actif, 0=nul)</td>
                <td width="70px">EDIT</td>
            </tr>
            <?php
            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' value='" . $row['id'] . "' name='userid' />";
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td><a href='editcompte.php?id=" . $row['id'] . "' class='btn btn-info'>Edit</a></td>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </table>
</div>
<br><br>
<?php
    } else {
        echo ".<br><br><div class='text-center text-danger'><p>Aucun élève inscrit !</p></div></div>";
    }
?>
<div class="text-center"> [ <a href="indexfamille.php">Retour</a> ] </div>
<br><br>
</body>

</html>

<?= template_footer() ?>