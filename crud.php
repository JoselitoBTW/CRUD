<?php
session_start();

include('connexion.php');

try {

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  } catch(PDOException $e) {
    echo "DB Connection Failed: " . $e->getMessage();
  }

  $stmt = $pdo->query('SELECT * FROM intervention');

?>
<!DOCYTPE html>
    <html>

    <head>
        <title>Conciergerie</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>

    <body>
        <header class="link">
            Espace privé
            <a href="deconnexion.php">Quitter la session</a>
        </header>
        <h1 class="goodmessage">
            <?php 
			echo (date("H")<18)?("Bonjour "):("Bonsoir ");
		?>
            <span>
                <?=$_SESSION["Prenom"]?>
            </span>
        </h1>

        <div class="formulaire">
            <form method="post" action="insert.php">
                <div class="d-flex justify-content-center champs">
                    <input type="text" name="intervention" placeholder="Ajoutez une intervention">
                    <input type="date" name="date">
                    <input type="number" name="etage" placeholder="Étage de l'intervention">
                    <input type="submit" name="submit">
                </div>
            </form>
        </div>
        <div class="container">
            <table class="table ">
                <thead>
                    <th>Tache</th>
                    <th>Date</th>
                    <th>Etage</th>

                </thead>

                <tbody>

                    <?php      while($row = $stmt->fetch())
                {?> <tr>
                        <td><?php echo $row->type_intervention;?></td>
                        <td><?php echo $row->date_intervention;?></td>
                        <td><?php echo $row->etage_intervention;?> </td>

                        <td>
                            <a class="modif" href="modification.php?id_intervention=<?php echo $row->id_intervention;?>" class="btn">modifier
                            </a>
                            <a class="suppr" href="delete.php?id_intervention=<?php echo $row->id_intervention;?>" class="btn">
                                supprimer </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </body>

    </html>