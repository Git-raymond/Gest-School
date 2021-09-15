<?php
include 'functions.php';
// recuperation des paramètres 
$id=$_POST["id"];
$name=$_POST["nom"];
//echo $name;
$pname=$_POST["prenom"];
//echo $pname;
$age=$_POST["age"];
//echo $age;
$adr=$_POST["adresse"];
//echo $adr;
updateUser($id,$name,$pname,$age,$adr);

?>

<?=template_header('Valid Add User')?>

<div class="content update">
    Modification reussie



    
</div>

<?=template_footer()?>
