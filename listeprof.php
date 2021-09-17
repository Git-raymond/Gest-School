<?php
include 'functions.php';
session_start();
?>
<?= template_header('Liste enseignants') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

$select_stmt = $db->prepare("SELECT * FROM comptes WHERE type= 'enseignant'");
$select_stmt->execute();

?>
<div class="container">
    <h2 class="text-primary text-center mt-5 mb-3">Liste des enseignants</h2>
    <br>
    <?php
    if ($select_stmt->rowCount() > 0) {
    ?>
        <table class="table table-bordered table-striped table-dark table-hover bg-light">
            <tr>
                <td>Username</td>
                <td>Email</td>
                <td width="70px">EDIT</td>
            </tr>
            <?php
            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' value='" . $row['id'] . "' name='userid' />";
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
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
        echo "<br><br><div class='text-center text-primary'><p>Aucun enseignant inscrit</p></div>";
    }
?>
</body>
</html>

<?= template_footer() ?>