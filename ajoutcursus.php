<?php
include 'functions.php';
session_start();
?>
<?= template_header('Ajout cursus') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

if (isset($_REQUEST['ajouter'])) {
    $matiere = $_REQUEST['matiere'];
    $annee = $_REQUEST['annee'];


    if (empty($matiere)) {
        $errorMsg = "Entrez le nom de la matière";
    } else if (empty($annee)) {
        $errorMsg = "Entrez la date";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT matiere, annee FROM cursus WHERE matiere=:umatiere OR annee=:uannee");
            $select_stmt->bindParam(":umatiere", $matiere);
            $select_stmt->bindParam(":uannee", $annee);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare("INSERT INTO cursus(matiere, annee) VALUES(:umatiere, :uannee)");
                $insert_stmt->bindParam(":umatiere", $matiere);
                $insert_stmt->bindParam(":uannee", $annee);

                if ($insert_stmt->execute()) {
                    $registerMsg = "Inscription du cursus validée.";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
<form class="box text-center mt-5 mb-5" action="" method="post">
    <h1 class="box-logo box-title text-primary">AJOUTER UN CURSUS</h1>
    <div class="text-center">
        <br>
        <input type="text" class="box-input mb-3" name="matiere" placeholder="Matière" required /><br>
        <input type="text" class="box-input mb-3" name="annee" placeholder="Année scolaire" required /><br>
        <input type="submit" name="ajouter" value="Ajouter" class="box-button btn-primary" />
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