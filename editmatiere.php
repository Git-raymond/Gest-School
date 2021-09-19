<?php
include 'functions.php';
session_start();
?>
<?= template_header('Modification Cursus') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

if (isset($_REQUEST['id'])) {
    try {
        $id = $_REQUEST['id'];
        $select_stmt = $db->prepare('SELECT * FROM cursus WHERE idCursus =:id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_POST['delete_id'])) {
    // select record from db to delete
    $idCursus = $_POST['delete_id'];    //get delete_id and store in $id variable

    //delete an orignal record from db
    $delete_stmt = $db->prepare('DELETE FROM cursus WHERE idCursus =:id');
    $delete_stmt->bindParam(':id', $id);

    if ($delete_stmt->execute()) {
        $deleteMsg = "Cursus supprimé avec succès";
    }
}


if (isset($_REQUEST['btn_update'])) {

    $matiere = $_REQUEST['matiere'];
    $annee = $_REQUEST['annee'];
    $frais = $_REQUEST['frais'];

    if (empty($matiere)) {
        $errorMsg = "Entrez la matière";
    } else if (empty($annee)) {
        $errorMsg = "Entrez la date";
    } else if (empty($frais)) {
        $errorMsg = "Entrez le montant des frais de scolarité";
    } else {
        try {
            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare('UPDATE cursus SET matiere=:umatiere, annee=:uannee, frais=:ufrais WHERE idCursus=:id'); //sql update query
                $update_stmt->bindParam(':umatiere', $matiere);
                $update_stmt->bindParam(':uannee', $annee);
                $update_stmt->bindParam(':ufrais', $frais);
                $update_stmt->bindParam(':id', $id);

                if ($update_stmt->execute()) {
                    $updateMsg = "Cursus modifié avec succès";    //record update success message
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
            if (isset($deleteMsg)) {
            ?>
                <div class="text-center alert alert-success">
                    <strong>DELETE ! <?php echo $deleteMsg; ?></strong>
                </div>
            <?php
            }
            ?>

            <div class="row">
                <div class="col-md-6 col-md-offset-3 mx-auto">
                    <div class="box text-center text-primary mb-5">
                        <h3 class="text-warning mt-5">Modification des informations du cursus</h3>

                            <form method="post">

                                <div class="form-group mt-3">
                                    <label class="col-sm-3 control-label">Matière</label>
                                    <div class="col-sm-12">
                                        <input required type="text" name="matiere" class="form-control" value="<?php echo $matiere; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Année scolaire</label>
                                    <div class="col-sm-12">
                                        <input required type="text" name="annee" class="form-control" value="<?php echo $annee; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Montant des frais de scolarité</label>
                                    <div class="col-sm-12">
                                        <input required type="text" name="frais" class="form-control" value="<?php echo $frais; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="mt-3">
                                        <input type="submit" name="btn_update" class="btn btn-success" value="Modifier">
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
                                            echo "<a href='indexensegnant.php' class='btn btn-primary'>Annuler</a>";
                                        }
                                        ?>

                                        <!-- suppression -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal">
                                            Supprimer
                                        </button>
                                        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content text-dark">
                                                    <div class="">
                                                        <h3 class="modal-title mt-3 text-danger" id="myModalLabel">SUPPRIMER</h3>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h4>Veuillez confirmer la suppression du cursus</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>

                                                        <button type="submit" name='delete_id' value="<?php echo $id; ?>" class="btn btn-danger">Supprimer définitivement</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


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