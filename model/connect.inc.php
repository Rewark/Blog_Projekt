<?php   
function db_connect(){
   $db = new mysqli("localhost","root" ,"","");
     if($db->connect_error){
		 die("Fehler beim verbindungsaufbau: ". $db->connect_error);
	 }		 
    $sql ="CREATE DATABASE IF NOT EXISTS Blog";
	if($db->query($sql)=== TRUE){
		//echo "datenbank erstellt";
	}
	else{
		echo "Fehler beim erstellen der datenbank: ". $db->error;
	}

	return $db;
}
//andere datei
	//$db = new mysqli("localhost","root","",);
	//die("fehler beimverbindung")
	?>