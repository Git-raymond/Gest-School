<?php
include 'functions.php';
session_start();
?>

<?= template_header('Inscription') ?>

<body>

    <?php

    if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])) {
        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn, $email);
        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        // $query = "INSERT into `comptes` (username, email, type, password)
        // 		VALUES ('$username', '$email', 'user', '" . hash('sha256', $password) . "')";
        $query = "SELECT email FROM comptes WHERE email='" . $email . "'";
        $response = mysqli_query($conn, $query);

        if ($response == true) {
            if (mysqli_num_rows($response) == 1) {
                echo "<div class='text-center text-primary mt-5'><h3>L'utilisateur existe déjà !</h3>
				<p class='text-center'>Vous êtes nouveau ici ? <a href='register.php'>S'inscrire</a></p></div>";
            } else {
                $query = "INSERT into `comptes` (username, email, type, password)
							VALUES ('$username', '$email', 'user', '" . hash('sha256', $password) . "')";
                $response = mysqli_query($conn, $query);

                echo "<div class='text-center text-primary mt-5'>
						 <h3>Vous êtes inscrit avec succès.</h3>
						 <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
						 </div>";
            }
        } else {
            $message = "La requête n'a pas abouti !";
        }
    } else {
    ?>
        <div class="container">
            <div class="jumbotron text-center">
                <form class="box text-primary" action="" method="post" name="login">
                    <h1 class="box-logo box-title mt-5 mb-4">REJOIGNEZ NOUS</h1>
                    <h1 class="box-title mb-3 text-secondary">Inscription</h1>
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
                        <input type="submit" value="S'inscrire" name="submit" class="box-button mb-3 rounded shadow">
                    </div>
                    <p class="box-register p-3 rounded mx-auto">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
                    <?php if (!empty($message)) { ?>
                        <p class="errorMessage"><?php echo $message; ?></p>
                    <?php } ?>
                </form>
            </div>
        </div>
        <br>
    <?php } ?>
</body>

</html>

<?= template_footer() ?>