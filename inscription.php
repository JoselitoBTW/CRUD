<?php
	$nom=$_POST["nom"];
	$prenom=$_POST["prenom"];
	$login=$_POST["login"];
	$pass=$_POST["pass"];
	$repass=$_POST["repass"];
	$valider=$_POST["valider"];
	$message="";
	if(isset($valider)){
		if(empty($nom)) $message="<li>NoM invalide!</li>";
		if(empty($prenom)) $message.="<li>Prénom invalide!</li>";
		if(empty($login)) $message.="<li>Login invalide!</li>";
		if(empty($pass)) $message.="<li>Mot de passe invalide!</li>";
		if($pass!=$repass) $message.="<li>Mots de passe non identiques!</li>";	
		if(empty($message)){
			include("connexion.php");
			$req=$pdo->prepare("select id from users where login=? limit 1");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$req->execute(array($login));
			$tab=$req->fetchAll();
			if(count($tab)>0){
				$message="<li>Login existe déjà!</li>";
			}
			else{
				$ins=$pdo->prepare("INSERT INTO users(date,nom,prenom,login,password) values(now(),?,?,?,?)");
				$ins->execute(array($nom,$prenom,$login,md5($pass)));
				header("location:login.php");
			}
		}
	}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Document</title>
</head>

<body>
    <header class="register">
        Inscription
        <a href="login.php">Déja inscrit</a>
    </header>
    <form name="fo" method="post" action="" enctype="multipart/form-data">
        <div class="label">Nom</div>
        <input type="text" name="nom" value="<?php echo $nom?>" />
        <div class="label">Prénom</div>
        <input type="text" name="prenom" value="<?php echo $prenom?>" />
        <div class="label">Nom d'utilisateur</div>
        <input type="text" name="login" value="<?php echo $login?>" />
        <div class="label">Mot de passe</div>
        <input type="password" name="pass" />
        <div class="label">Confirmation du mot de passe</div>
        <input type="password" name="repass" />
        <input type="submit" name="valider" value="S'inscrire" />
    </form>
    <?php if(!empty($message)){ ?>
    <div id="message"><?php echo $message ?></div>
    <?php } ?>
</body>

</html>