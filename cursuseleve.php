<?php
include 'functions.php';
session_start();
?>
<?= template_header('Choix attribution cursus élève') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

$select_stmt = $db->prepare("SELECT * FROM comptes WHERE type= 'eleve'");
$select_stmt->execute();

?>
<div class="container">
    <h2 class="text-warning text-center mt-5 mb-3">Liste de tous les élèves</h2>
    <br>
    <?php
    if ($select_stmt->rowCount() > 0) {
    ?>
        <table class="table table-bordered table-striped table-dark table-hover bg-light">
            <tr>
                <td>Prénom</td>
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
                echo "<td><a href='cursuseleveattribution.php?id=" . $row['id'] . "' class='d-grid gap-2 col-6 mx-auto btn btn-info'>Attribuer</a></td>";
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
</body>
</html>

<?= template_footer() ?>