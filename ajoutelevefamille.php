<?php
include 'functions.php';
session_start();
?>
<?= template_header('Ajout élève') ?>

<?php
if (!isset($_SESSION['type'])) {
    header('Location:register.php');
    exit();
}
require_once "connexion.php";

if (isset($_REQUEST['ajouter'])) {
    $famille_id = $_SESSION['famille_id'];
    $username = $_REQUEST['username'];
    $eleve = $_REQUEST['eleve'];
    $frais = $_REQUEST['frais'];
    $email = $_REQUEST['email'];
    $type = $_REQUEST['type'];
    $password = hash('sha256', $_REQUEST['password']);

    if (empty($eleve)) {
        $errorMsg = "Entrez l'élève";
    } else if (empty($password)) {
        $errorMsg = "Entrez le mot de passe de l'élève";
    } else if (empty($frais)) {
        $errorMsg = "Entrez le montant des frais scolaires";
    } else if (empty($email)) {
        $errorMsg = "Entrez l'adresse email de l'élève";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Entrez une adresse email valide";
    } else if (strlen($password) < 5) {
        $errorMsg = "Le mot de passe doit contenir au moins 5 caractères";
    } else {
        try {

            $select_stmt = $db->prepare("SELECT id, username, email FROM comptes WHERE id=:uid OR username=:uusername OR email=:uemail");
            $select_stmt->bindParam(":uid", $id);
            $select_stmt->bindParam(":uusername", $username);
            $select_stmt->bindParam(":uemail", $email);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if (isset($row["username"])) {
                if ($row["username"] == $username) {
                    $errorMsg = "Le nom existe déjà. En choisir un autre.";
                } else if ($row["email"] == $email) {
                    $errorMsg = "L'adresse email existe déjà. En choisir une autre.";
                }
            } else if (!isset($errorMsg)) {

                $insert_stmt = $db->prepare("INSERT INTO eleve (eleve, frais, famille_id) VALUES(:ueleve, :ufrais, :ufamille_id)");
                $insert_stmt->bindParam(":ueleve", $eleve);
                $insert_stmt->bindParam(":ufrais", $frais);
                $insert_stmt->bindParam(":ufamille_id", $famille_id);
                $insert_stmt->execute();

                $currentID = $db->lastInsertId();

                $insert_stmt = $db->prepare("INSERT INTO comptes(username, email, password, type, famille_id) VALUES(:uusername, :uemail, :upassword, :utype, $currentID)");
                $insert_stmt->bindParam(":uusername", $username);
                $insert_stmt->bindParam(":uemail", $email);
                $insert_stmt->bindParam(":upassword", $password);
                $insert_stmt->bindParam(":utype", $type);

                if ($insert_stmt->execute()) {
                    $registerMsg = "Inscription de l'élève validée.";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
<form class="box text-center mt-5 mb-5" action="" method="post">
    <h1 class="box-logo box-title text-warning">Ajouter un élève à la famille</h1>
    <div class="text-center">
        <input type="hidden" class="box-input mb-3" name="type" value="eleve" /><br>
        <input type="hidden" class="box-input mb-3" name="eleve" value="eleve" /><br>

        <input type="text" class="box-input mb-3" name="username" placeholder="Nom de l'élève" required /><br>
        <input type="text" class="box-input mb-3" name="frais" placeholder="Montant frais scolaire" required /><br>
        <input type="text" class="box-input mb-3" name="email" placeholder="Email" required /><br>
        <input type="password" class="box-input mb-3" name="password" placeholder="Mot de passe" required /><br>
        <input type="submit" name="ajouter" value="Ajouter" class="box-button btn-primary btn" />
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