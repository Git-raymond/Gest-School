<?php
include 'functions.php';
session_start();
?>
<?= template_header('Accueil Admin') ?>


<?php

if (!isset($_SESSION['admin_login'])) {
    header("location:login.php");
}
if (isset($_SESSION['famille_login'])) {
    header("location:indexfamille.php");
}
if (isset($_SESSION['eleve_login'])) {
    header("location:indexeleve.php");
}
if (isset($_SESSION['enseignant_login'])) {
    header("location:indexenseignant.php");
}

if (isset($_SESSION['admin_login'])) {


    if (date("H") < 18)
        $bienvenue = "Bonjour et bienvenue <a class='username'>" .
            $_SESSION["admin_login"] .
            "</a> dans votre espace admin";
    else
        $bienvenue = "Bonsoir et bienvenue <a class='username'>" .
            $_SESSION["admin_login"] .
            "</a>  dans votre espace admin";
}
?>

<style>
    * {
        font-family: arial;
    }

    body {
        min-height: 500px;
    }

    a {
        color: #EE6600;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .username {
        color: orange;
        font-size: xx-large;
    }
</style>

<body onLoad="document.fo.login.focus()">
    <br><br><br><br>
    <h2 class="text-center mt-5 mb-5"><?php echo $bienvenue ?></h2>
    <div class="text-center"> [ <a href="logout.php">Se déconnecter</a> ] </div>
    <br><br><br><br><br>
</body>

</html>

<?= template_footer() ?>