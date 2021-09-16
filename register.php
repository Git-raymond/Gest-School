<?php
require_once 'connexion.php';
include 'functions.php';
session_start();
?>

<?= template_header('Inscription') ?>

<body>

    <?php
    if (isset($_REQUEST['valider'])) {
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $type = $_REQUEST['type'];
        $password = hash('sha256', $_REQUEST['password']);

        if (empty($username)) {
            $errorMsg = "Entrez votre nom";
        } else if (empty($password)) {
            $errorMsg = "Entrez votre mot de passe";
        } else if (empty($email)) {
            $errorMsg = "Entrez votre email";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = "Entrez une adresse email valide";
        } else if (strlen($password) < 5) {
            $errorMsg = "Le mot de passe doit contenir au moins 5 caractères";
        } else {
            try {
                $select_stmt = $db->prepare("SELECT username, email FROM comptes WHERE username=:uusername OR email=:uemail");
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
                    $insert_stmt = $db->prepare("INSERT INTO comptes(username, email, password, type) VALUES(:uusername, :uemail, :upassword, :utype)");
                    $insert_stmt->bindParam(":uusername", $username);
                    $insert_stmt->bindParam(":uemail", $email);
                    $insert_stmt->bindParam(":upassword", $password);
                    $insert_stmt->bindParam(":utype", $type);

                    if ($insert_stmt->execute()) {
                        $registerMsg = "Inscription validée. Redirection vers la page Connexion.";
                        header("refresh:2; login.php");
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


    ?>
    <div class="container">
        <div class="jumbotron text-center">
            <form class="box text-primary" action="" method="post" name="login">
                <h1 class="box-logo box-title mt-5 mb-4">REJOIGNEZ NOUS</h1>
                <h1 class="box-title mb-3 text-secondary">Inscription</h1>
                <div class="margin-input">
                    <input type="hidden" class="box-input mb-3 rounded" name="type" placeholder="Type" value="famille">
                    </select>
                </div>
                <div class="margin-input">
                    <input type="text" class="box-input mb-3 rounded" name="username" placeholder="Nom de famille">
                </div>
                <div class="margin-input">
                    <input type="text" class="box-input mb-3 rounded" name="email" placeholder="Email" required />
                </div>
                <div class="margin-input">
                    <input type="password" class="box-input mb-3 rounded" name="password" placeholder="Mot de passe">
                </div>
                <div class="margin-input">
                    <input type="submit" name="valider" value="S'inscrire" name="submit" class="box-button mb-3 rounded shadow">
                </div>
                <p class="box-register p-3 rounded mx-auto">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
                <?php if (!empty($errorMsg)) { ?>
                    <p class="text-danger"><?php echo $errorMsg; ?></p>
                <?php } ?>
                <?php if (!empty($registerMsg)) { ?>
                    <p class="text-success"><?php echo $registerMsg; ?></p>
                <?php } ?>
            </form>
        </div>
    </div>
    <br>
</body>

</html>

<?= template_footer() ?>