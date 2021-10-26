<?php
$db_host="localhost"; //localhost seerver
$db_user="root"; //database username
$db_password="root"; //database password
$db_name="gestschool1"; //database name
   try{
      $db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
?>
