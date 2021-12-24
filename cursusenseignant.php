<?php
include 'functions.php';
session_start();
?>
<?= template_header('Choix attribution cursus enseignant') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

$select_stmt = $db->prepare("SELECT * FROM p2_g3_comptes WHERE type= 'enseignant'");
$select_stmt->execute();

?>
<div class="container">
    <h2 class="text-warning text-center mt-5 mb-3">Choisir l'enseignant</h2>
    <br>
    <?php
    if ($select_stmt->rowCount() > 0) {
    ?>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table class="table table-bordered table-striped table-dark table-hover bg-light">
                <tr>
                    <td>Nom</td>
                    <td>Email</td>
                    <td>Statut (1=actif, 0=nul)</td>
                    <td width="200px">ATTRIBUER UN CURSUS</td>
                </tr>
                <?php
                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<form action='' method='POST'>";
                    echo "<input type='hidden' value='" . $row['id'] . "' name='userid' />";
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td><a href='cursusenseignantattribution.php?id=" . $row['id'] . "' class='d-grid gap-2 col-6 mx-auto btn btn-info'>Attribuer</a></td>";
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
<div class="text-center"> [ <a href="indexadmin.php">Retour</a> ] </div>
<br><br>
</body>

</html>

<?= template_footer() ?>