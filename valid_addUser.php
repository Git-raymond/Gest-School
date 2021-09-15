<?php
include 'functions.php';


   // $msg = 'Created Successfully!';

?>

<?=template_header('Valid Add User')?>

<div class="content update">
    <?php
          //1- recup data depuis adduser.php

         $name=$_POST["name"];
   //echo $name;

         $pname=$_POST["pname"];
        // echo $pname;
         $age=$_POST["age"];
        // echo $age;
         $adr=$_POST["adr"];
        // echo $adr;
    
        //2- connexion et insertion 
        createUser($name,$pname,$age,$adr);
          echo "Ajout reussi";
     ?>



    
</div>

<?=template_footer()?>
