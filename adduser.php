<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

   // $msg = 'Created Successfully!';

?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Ajout Famille</h2>
    
    <form action="adduser.php" method="post">
    <label for="name">Nom</label>
        <input type="text" name="name" placeholder="" id="name" required>
        
        <label for="prenom">Prenom</label>
        <input type="text" name="pname" placeholder="" id="pname" required>
        
        <label for="age">Age</label>
        <input type="text" name="age" placeholder="" id="age" required>
        <label for="adresse">adresse</label>
        <input type="text" name="adr" placeholder="" id="adr" required>
        
    <input type="submit" value="Ajouter">
    </form>

    <?php
          //1- recup data depuis adduser.php

         //$name=isset($_POST["name"]);
   
         $name=$_POST["name"];
  // echo $name;

         $pname=$_POST["pname"];
       // echo $pname;
         $age=$_POST["age"];
        //echo $age;
         $adr=$_POST["adr"];
       // echo $adr;
    
        //2- connexion et insertion 
        createUser($name,$pname,$age,$adr);
         // echo "Ajout reussi";
       
          // 3- Recup tous les utilisateurs 
              $users = getAllUsers();
              //print_r($users);
     ?>
         
         <div class="content read">
	<table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Age</td>
                <td>Adresse</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?=$user['id']?></td>
                <td><?=$user['nom']?></td>
                <td><?=$user['prenom']?></td>
                <td><?=$user['age']?></td>
                <td><?=$user['adresse']?></td>  
            <td class="actions">
                    <a href="updateUser.php?id=<?=$user['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="deleteUser.php?id=<?=$user['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
            </form>

    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
