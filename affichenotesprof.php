<?php
include 'functions.php';
require_once "connexion.php";
session_start();

?>
<?= template_header('Affichage notes') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}

$eleve_id = $_REQUEST['id']; 
$select_stmt = $db->prepare("SELECT * FROM p2_g3_controle WHERE eleve_id=$eleve_id");
$select_stmt->execute();

?>
<div class="container">
    <h2 class="text-warning text-center mt-5 mb-3">Liste des notes</h2>
    <br>
    <?php
    if ($select_stmt->rowCount() > 0) {
    ?>
        <table class="table table-bordered table-striped table-dark table-hover bg-light">
            <tr>
                <td>Intitulé</td>
                <td>Notes</td>
                <td>Commentaires</td>
                <td>Date</td>
            </tr>
            <?php
            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' value='" . $row['idControle'] . "' name='userid' />";
                echo "<tr>";
                echo "<td>" . $row['intitule'] . "</td>";
                echo "<td>" . $row['note'] . "</td>";
                echo "<td>" . $row['commentaire'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </table>
</div>
<br>
<?php
    } else {
        echo ".<div class='text-center text-danger'><p>Aucune note enregistrée !</p></div></div>";
    }
?>
<div class="text-center"> [ <a href="listeelevecursusprof.php">Retour</a> ] </div>
<br><br>

</body>
</html>

<?= template_footer() ?>