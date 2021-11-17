<?php
include("connexion.php");

$stmt = $pdo->prepare('DELETE FROM intervention WHERE id_intervention=:num LIMIT 1');

$stmt->bindValue(':num', $_GET['id_intervention'], PDO::PARAM_INT);

$message = $stmt->execute();

if($message){
    $message = "L'intervention a été supprimé";
} else{
    $message = "Echec de la suppression";
}
header("Refresh:1; url=http://localhost:8888/pdo/crud.php");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Suppression</title>
</head>
<body>
    <h1>Suppression<h1>
        <p><?= $message ?></p>
    
</body>
</html>