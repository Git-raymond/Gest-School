<?php
require_once 'connexion.php';
include 'functions.php';
session_start();
?>

<?= template_header('Login') ?>

<body>
    <?php

    if (isset($_SESSION["admin_login"])) {
        header("location: indexadmin.php");
    }
    if (isset($_SESSION["famille_login"])) {
        header("location: indexfamille.php");
    }
    if (isset($_SESSION["eleve_login"])) {
        header("location: indexeleve.php");
    }
    if (isset($_SESSION["enseignant_login"])) {
        header("location: indexenseignant.php");
    }

    if (isset($_REQUEST['valider'])) {
        $username = $_REQUEST['username'];
        $type = $_REQUEST['type'];
        $password = $_REQUEST['password'];

        if (empty($username)) {
            $errorMsg = "Entrez votre nom";
        } else if (empty($password)) {
            $errorMsg = "Entrez votre mot de passe";
        } else if (empty($type)) {
            $errorMsg = "Sélectionner votre rôle";
        } else if ($username and $password and $type) {
            try {
                $select_stmt = $db->prepare("SELECT username, type, password FROM comptes WHERE username=:uusername AND type=:utype AND password=:upassword");
                $select_stmt->bindParam(":uusername", $username);
                $select_stmt->bindParam(":utype", $type);
                $select_stmt->bindParam(":upassword", $password);
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dbusername = $row["username"];
                    $dbtype = $row["type"];
                    $dbpassword = $row["password"];
                }
                if ($username != null and $password != null and $type != null) {
                    if ($select_stmt->rowCount() > 0) {
                        if ($username == $dbusername and $password == $dbpassword and $type == $dbtype) {
                            switch ($dbtype) {
                                case "admin":
                                    $_SESSION["admin_login"] = $username;
                                    $_SESSION['type'] = $type;
                                    // $_SESSION['id'] = $id;
                                    $loginMsg = "Redirection vers compte Admin";
                                    header("refresh:1;indexadmin.php");
                                    break;

                                case "famille":
                                    $_SESSION["famille_login"] = $username;
                                    $_SESSION['type'] = $type;
                                    $loginMsg = "Redirection vers compte Famille";
                                    header("refresh:1;indexfamille.php");
                                    break;

                                case "eleve":
                                    $_SESSION["eleve_login"] = $username;
                                    $_SESSION['type'] = $type;
                                    $loginMsg = "Redirection vers compte Elève";
                                    header("refresh:1;indexeleve.php");
                                    break;

                                case "enseignant":
                                    $_SESSION["enseignant_login"] = $username;
                                    $_SESSION['type'] = $type;
                                    $loginMsg = "Redirection vers compte Enseignant";
                                    header("refresh:2;indexenseignant.php");
                                    break;

                                default:
                                    $errorMsg= "Le nom ou le mot de passse est incorrect";
                            }
                        } else {
                            $errorMsg= "Le nom ou le mot de passse est incorrect";
                        }
                    } else {
                        $errorMsg= "Le nom ou le mot de passse est incorrect";
                    }
                } else {
                    $errorMsg= "Le nom ou le mot de passse est incorrect";
                }
            } catch (PDOException $e) {
                $e->getMessage();
            }
        } else {
            $errorMsg[] = "Le nom ou le mot de passse est incorrect";
        }
    }
    ?>
    <div class="container">
        <div class="jumbotron text-center">
            <form class="box text-primary" action="" method="post" name="login">
                <h1 class="box-logo box-title mt-5 mb-4">AUTHENTIFICATION</h1>
                <h1 class="box-title mb-3 text-secondary">Connexion</h1>
                <div class="margin-input">
                    <select class="mt-3 mb-3" name="type">
                        <option value="" selected="selected">- Select Rôle -</option>
                        <option value="admin">Admin</option>
                        <option value="famille">Famille</option>
                        <option value="eleve">Elève</option>
                        <option value="enseignant">Enseignant</option>
                    </select>
                </div>
                <div class="margin-input">
                    <input type="text" class="box-input mb-3 rounded" name="username" required placeholder="Nom de famille">
                </div>
                <div class="margin-input">
                    <input type="password" class="box-input mb-3 rounded" name="password" required placeholder="Mot de passe">
                </div>
                <div class="margin-input">
                    <input type="submit" name="valider" value="Se connecter" name="submit" class="box-button mb-3 rounded shadow">
                </div>
                <p class="box-register p-3 rounded mx-auto">Vous êtes nouveau ici ? <a href="register.php">S'inscrire</a></p>
                <?php if (!empty($errorMsg)) { ?>
                    <p class="text-danger errorMessage"><?php echo $errorMsg; ?></p>
                <?php } ?>
                <?php if (!empty($loginMsg)) { ?>
                    <p class="text-success errorMessage"><?php echo $loginMsg; ?></p>
                <?php } ?>
            </form>
        </div>
    </div>
    <br><br>
</body>

</html>


<?= template_footer() ?>