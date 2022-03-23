<?php 


require_once("model\\connect.inc.php");
$db= db_connect();
function scholiste($db){
	$statement = $db->prepare("SELECT * FROM blog ORDER BY eintragid DESC");
	if($statement->execute()){
		$result = $statement->get_result();

		while($row = $result->fetch_row()){
            
			list($eintragid, $text, $datum, $userid)=$row;
			printf("<hr>$datum <div>  $text </div></hr>");
		
			
		}
	}
}

?>