<?php
include 'functions.php';
session_start();
$enseignant_id = $_SESSION['enseignant_id'];
?>
<?= template_header('Ajout controle') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

if (isset($_REQUEST['valider'])) {
    $intitule = $_REQUEST['intitule'];
    $note = $_REQUEST['note'];
    $commentaire = $_REQUEST['commentaire'];
    $date = $_REQUEST['date'];
    $eleve_id = $_REQUEST['eleve_id'];

    if (empty($intitule)) {
        $errorMsg = "Entrez l'intitulé'";
    } else if (empty($note)) {
        $errorMsg = "Entrez la note";
    } else if (empty($commentaire)) {
        $errorMsg = "Entrez le commentaire";
    } else if (empty($date)) {
        $errorMsg = "Entrez la date";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT intitule, note, commentaire FROM controle WHERE intitule=:uintitule OR note=:unote OR commentaire=:ucommentaire OR date=:udate");
            $select_stmt->bindParam(":uintitule", $intitule);
            $select_stmt->bindParam(":unote", $note);
            $select_stmt->bindParam(":ucommentaire", $commentaire);
            $select_stmt->bindParam(":udate", $date);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare("INSERT INTO controle (intitule, note, commentaire, date, enseignant_id, eleve_id) VALUES(:uintitule, :unote, :ucommentaire, :udate, $enseignant_id, $eleve_id)");
                $insert_stmt->bindParam(":uintitule", $intitule);
                $insert_stmt->bindParam(":unote", $note);
                $insert_stmt->bindParam(":ucommentaire", $commentaire);
                $insert_stmt->bindParam(":udate", $date);

                if ($insert_stmt->execute()) {
                    $registerMsg = "Inscription du contrôle validée.";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
<form class="box text-center text-primary mt-5 mb-5" action="" method="post">
    <h1 class="box-logo box-title text-warning">Ajouter un contrôle</h1>
    <div class="text-center">
        <br>
        <input type="text" class="box-input mb-3" name="intitule" placeholder="Intitule" required /><br>
        <input type="text" class="box-input mb-3" name="note" placeholder="Note" required /><br>
        <textarea class="box-input mb-3" name="commentaire" placeholder="Commentaires" required></textarea><br>
        <input type="date" class="box-input mb-3" name="date" placeholder="Date" required /><br>
        
    </div>
    <div class="col-sm-12">
        <label>Elève inscrit au cursus</label>
        <div class="col-sm-12">
            <select name="eleve_id">
                <?php
                $stmt = $db->prepare("SELECT * FROM comptes JOIN eleve ON comptes.eleve_id=eleve.idEleve JOIN cursus ON eleve.cursus_id=cursus.idCursus WHERE cursus.enseignant_id=$enseignant_id");
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                ?>
                    <option value="<?php echo $row['eleve_id']; ?>"><?php echo $row['username']; ?>, <?php echo $row['matiere']; ?>, <?php echo $row['annee']; ?> </option>
                <?php
                }
                // $stmt->closeCursor();
                ?>
            </select>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="mt-3">
            <input type="submit" name="valider" class="btn btn-success" value="Valider">
            <?php
            if ($_SESSION['type'] == 'admin') {
                echo "<a href='indexadmin.php' class='btn btn-primary'>Annuler</a>";
            }

            if ($_SESSION['type'] == 'famille') {
                echo "<a href='indexfamille.php' class='btn btn-primary'>Annuler</a>";
            }

            if ($_SESSION['type'] == 'eleve') {
                echo "<a href='indexeleve.php' class='btn btn-primary'>Annuler</a>";
            }

            if ($_SESSION['type'] == 'enseignant') {
                echo "<a href='indexenseignant.php' class='btn btn-primary'>Annuler</a>";
            }
            ?>
        </div>
    </div>
</form>
<?php if (!empty($errorMsg)) { ?>
    <p class="text-center text-danger"><?php echo $errorMsg; ?></p>
<?php } ?>
<?php if (!empty($registerMsg)) { ?>
    <p class="text-center text-success"><?php echo $registerMsg; ?></p>
<?php } ?>

</body>

</html>

<?= template_footer() ?>