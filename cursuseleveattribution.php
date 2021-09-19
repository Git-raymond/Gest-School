<?php
include 'functions.php';
session_start();
?>
<?= template_header('Attribution cursus élève') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

if (isset($_REQUEST['id'])) {
    try {
        $id = $_REQUEST['id'];
        $select_stmt = $db->prepare('SELECT * FROM comptes WHERE id =:id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        $idUser = $row["eleve_id"];
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_REQUEST['btn_update'])) {

    $idCursus = $_REQUEST['idCursus'];
    if (empty($idCursus)) {
        $errorMsg = "choisissez un cursus";
    } else {
        try {
            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare('UPDATE eleve SET cursus_id=:ucursus_id WHERE idEleve=:uidEleve');
                $update_stmt->bindParam(':ucursus_id', $idCursus);
                $update_stmt->bindParam(':uidEleve', $idUser);

                if ($update_stmt->execute()) {
                    $updateMsg = "Attribution effectuée avec succès";
                    // header("refresh:3;indexadmin.php");  
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>

<body>

    <div class="container-fluid">

        <div class="col-lg-12">

            <div class="container-fluid">

                <div class="col-lg-12">

                    <?php
                    if (isset($errorMsg)) {
                    ?>
                        <div class="text-center alert alert-danger">
                            <strong>WRONG ! <?php echo $errorMsg; ?></strong>
                        </div>
                    <?php
                    }
                    if (isset($updateMsg)) {
                    ?>
                        <div class="text-center alert alert-success">
                            <strong>UPDATE ! <?php echo $updateMsg; ?></strong>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 mx-auto">
                            <div class="box text-center text-primary mb-5">
                                <h3 class="text-warning mt-5">Attribution des cursus de formation</h3>
                                <form method="post">
                                    <div class="text-center form-group mt-3">
                                        <label class="col-sm-3 control-label">Prénom</label>
                                        <div class="col-sm-12">
                                            <input class="text-center" required type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <label>Choisissez un cursus à attribuer</label>
                                            <div class="col-sm-12">
                                                <select name="idCursus">
                                                    <?php
                                                    $stmt = $db->prepare("SELECT * FROM cursus");
                                                    $stmt->execute();
                                                    while ($row = $stmt->fetch()) {
                                                    ?>
                                                        <option value="<?php echo $row['idCursus']; ?>"><?php echo $row['matiere']; ?> (<?php echo $row['annee'] ?>) Frais de scolarité: <?php echo $row['frais']; ?> </option>
                                                    <?php
                                                    }
                                                    // $stmt->closeCursor();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="mt-3">
                                            <input type="submit" name="btn_update" class="btn btn-success" value="Valider">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</body>

</html>


<?= template_footer() ?>