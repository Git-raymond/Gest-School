<?php
include 'functions.php';
session_start();
?>

<?= template_header('Login') ?>

<body>
    <?php

    if (isset($_POST['username'])) {
        /*stripslashes() supprime les barres obliques inverses ajoutées par la fonction addlashes() .*/
        /*addslashes : ajoute des barre obliques devant des caractères spéciaux*/
        /*$_REQUEST = La variable de requête HTTP $_REQUEST est un tableau associatif qui contient par défaut 
	le contenu des variables $_GET, $_POST et $_COOKIE.*/

        $username = stripslashes($_REQUEST['username']);
        /*mysqli_real_escape_string = La fonction real_escape_string() / mysqli_real_escape_string() échappe des caractères spéciaux dans une chaîne à utiliser dans une requête SQL, 
	en tenant compte du jeu de caractères courant de la connexion. */
        $username = mysqli_real_escape_string($conn, $username);
        $_SESSION['username'] = $username;

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $query = "SELECT * FROM `comptes` WHERE username='$username' and password='" . hash('sha256', $password) . "'";
        $result = mysqli_query($conn, $query) or die(mysqli_connect_error()); // mysql_error()

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $user['id'];
            $_SESSION['type'] = $user['type'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];
            // vérifier si l'utilisateur est un administrateur ou un utilisateur
            if ($user['type'] == 'admin') {
                header('location: indexadmin.php');
            } else if ($user['type'] == 'enseignant') 
                header('location: indexenseignant.php');
            } else if ($user['type'] == 'eleve') 
                header('location: indexeleve.php');
            else {
                header('location: indexfamille.php');
            }
        } else {
            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
    
    ?>
    <div class="container">
        <div class="jumbotron text-center">
            <form class="box text-primary" action="" method="post" name="login">
                <h1 class="box-logo box-title mt-5 mb-4">AUTHENTIFICATION</h1>
                <h1 class="box-title mb-3 text-secondary">Connexion</h1>
                <div class="margin-input">
                    <input type="text" class="box-input mb-3 rounded" name="username" placeholder="Nom de famille">
                </div>
                <div class="margin-input">
                    <input type="password" class="box-input mb-3 rounded" name="password" placeholder="Mot de passe">
                </div>
                <div class="margin-input">
                    <input type="submit" value="Se connecter" name="submit" class="box-button mb-3 rounded shadow">
                </div>
                <p class="box-register p-3 rounded mx-auto">Vous êtes nouveau ici ? <a href="register.php">S'inscrire</a></p>
                <?php if (!empty($message)) { ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                <?php } ?>
            </form>
        </div>
    </div>
    <br><br>
</body>

</html>


<?= template_footer() ?>