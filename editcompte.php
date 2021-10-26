<?php
include 'functions.php';
session_start();
?>
<?= template_header('Modification Compte') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

if (isset($_REQUEST['id'])) {
    try {
        $id = $_REQUEST['id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable
        $select_stmt = $db->prepare('SELECT * FROM p2_g3_comptes WHERE id =:id'); //sql select query
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
    $id = $_POST['delete_id'];    //get delete_id and store in $id variable

    //delete an orignal record from db
    $delete_stmt = $db->prepare('DELETE FROM p2_g3_comptes WHERE id =:id');
    $delete_stmt->bindParam(':id', $id);

    if ($delete_stmt->execute()) {
        $deleteMsg = "Compte supprimé avec succès";    
        session_destroy();
        header("refresh:2;index.php");    //refresh 3 second and redirect to index.php page
    }
}

if (isset($_REQUEST['btn_update'])) {

    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $password = hash('sha256', $_REQUEST['password']);
    $status = $_REQUEST['status'];

    if (empty($username)) {
        $errorMsg = "Entrez votre nom";
    } else if (empty($email)) {
        $errorMsg = "Entrez votre adresse email";
    } else if (empty($password)) {
        $errorMsg = "Entrez votre mot de passe";
    } else {
        try {
            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare('UPDATE p2_g3_comptes SET username=:uusername, email=:uemail, password=:upassword, status=:ustatus WHERE id=:uid'); //sql update query
                $update_stmt->bindParam(':uusername', $username);
                $update_stmt->bindParam(':uemail', $email);
                $update_stmt->bindParam(':upassword', $password);
                $update_stmt->bindParam(':uid', $id);
                $update_stmt->bindParam(':ustatus', $status);

                if ($update_stmt->execute()) {
                    $updateMsg = "Compte modifié avec succès";    //record update success message
                    // header("refresh:3;index.php");    //refresh 3 second and redirect to index.php page
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
                        <h3 class="text-warning mt-5">Modification des informations du compte</h3>

                        <br>
                            <form method="post">

                                <label class="col-sm-3 control-label">Statut</label>
                                <div class="col-sm-12">
                                    <select class="mt-3 mb-3" name="status">
                                        <option selected="selected" value=1>Activé</option>
                                        <option value=0>Désactivé</option>
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="col-sm-3 control-label">Nom</label>
                                    <div class="col-sm-12">
                                        <input required type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-12">
                                        <input required type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mot de passe</label>
                                    <div class="col-sm-12">
                                        <input required type="password" name="password" class="form-control" value="">
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
                                            echo "<a href='indexenseignant.php' class='btn btn-primary'>Annuler</a>";
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
                                                        <h4>Veuillez confirmer la suppression du compte</h4>
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