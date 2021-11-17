<?php
session_start();

$dsn = 'mysql:dbname=conciergerie;host=localhost';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

$stmt = $dbh->prepare('SELECT * FROM intervention WHERE id_intervention=:num LIMIT 1');

$stmt->bindValue(':num', $_GET['id_intervention'],PDO::PARAM_INT);

$message = $stmt->execute();

$intervention = $stmt->fetch();
var_dump($intervention);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <h1>Modifier une tâche</h1>
        <form method="get" action="update.php">
            <input type="hidden" name="id_intervention" value=" <?= $intervention['id_intervention']; ?>">
            <label for="intervention">Intervention</label>
            <input type="text" name="textInput" value=" <?= $intervention['type_intervention']; ?>">
            <label for="date">Date</label>
            <input type="date" name="dateInput" value=" <?= $intervention['date_intervention']; ?>">
            <label for="etage">Etage</label>
            <input type="number" name="numberInput" value=" <?= $intervention['etage_intervention']; ?>">
            <input type="submit" name="modif" value="Modifier">
        </form>
    </div>


</body>

</html>