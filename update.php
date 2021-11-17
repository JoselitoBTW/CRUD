<?php
session_start();

$dsn = 'mysql:dbname=conciergerie;host=localhost';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

//$stmt = $dbh->prepare("UPDATE intervention ( `type_intervention`, `date_intervention`, `etage_intervention`) VALUES ('$textInputVal','$dateInputVal','$etageInputVal' WHERE id_intervention=:num LIMIT 1");

$stmt = $dbh->prepare("UPDATE `intervention` SET type_intervention=':type_intervention' , date_intervention=':date_intervention' , etage_intervention=':etage_intervention' WHERE id_intervention=':num' LIMIT 1");


$stmt->bindValue(':num', $_GET['id_intervention'], PDO::PARAM_INT);
$stmt->bindValue(':type_intervention', $_GET['type_intervention'], PDO::PARAM_STR);
$stmt->bindValue(':date_intervention', $_GET['date_intervention'], PDO::PARAM_STR);
$stmt->bindValue(':etage_intervention', $_GET['etage_intervention'], PDO::PARAM_STR);

$message = $stmt->execute();

if($message){
    $message = "L'intervention a été modifié";
} else{
    $message = "Echec de la modification";
}
header("Refresh:1; url=crud.php");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Modification</title>
</head>
<body>
    <h1>Modification</h1>
    <p><?= $message ?></p>
    
</body>
</html>