<?php

	try{
		$pdo=new PDO("mysql:host=localhost;dbname=Conciergerie","root","root");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
?>