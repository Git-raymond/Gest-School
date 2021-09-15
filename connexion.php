<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2 class="text-center">Connexion</h2>
    <form action="authentification.php" method="post">
       
        <label for="name">Login</label>
        <input type="text" name="login" placeholder="" value="" id="login">
      
        <label for="email">Password</label>
        <input type="password" name="mdp" placeholder="" id="password">
        
        <input type="submit" value="Connectez-vous">
		
    </form>
	 <label for="email"><a href=""> | Mot de passe oublié | </a><a href="create.php">Inscrivez-vous |</a></label>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<br><br>

<?=template_footer()?>
