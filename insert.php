<?php

$intervention = ($_POST['intervention']);
$date = ($_POST['date']);
$etage = ($_POST['etage']);

include('connexion.php');

try
{
    foreach($pdo->query("INSERT INTO intervention ( `type_intervention`, `date_intervention`, `etage_intervention`) VALUES ('$intervention','$date','$etage')")as $row){
        
    }
    header("Refresh:0; url=crud.php");
}catch (PDOExeption $e)
{
    print "Erreur : ". $e ->getMessage()."<br/>";
    die;
}

?>