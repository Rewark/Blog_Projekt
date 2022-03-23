<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Interessengebiete</title>
  <link rel="stylesheet" href="css//style.css">
 </head>
 <body>
  <header>
   <nav id="meinnav">
    <ul>
	 <li><a href="index.php">Home</a></li>
	 <li><a href="login.php">Login</a></li>
	 <li><a href=""></a></li> 
	</ul>
   </nav>
  </header>
  <br><br>
  <h1>Interessengebiete</h1>
  <?php 
   session_start();
    require_once("model\\connect.inc.php");
	require_once("model\\function.inc.php");
	$db = db_connect();
	$db->query("use blog");

	$db->query('CREATE TABLE IF NOT EXISTS user(userid INT(10) NOT NULL AUTO_INCREMENT,
		username VARCHAR(50), password VARCHAR(150), PRIMARY KEY(userid))');

$db->query('CREATE TABLE IF NOT EXISTS blog(eintragid INT(10) NOT NULL AUTO_INCREMENT,
 text VARCHAR(500) NOT NULL, datum DATE NOT NULL DEFAULT CURRENT_TIMESTAMP, userid INT(10), PRIMARY KEY(eintragid),
 FOREIGN KEY(userid) REFERENCES user(userid) ON UPDATE CASCADE ON DELETE SET NULL )');
if(!$db) {
	echo "Fehler im SQL Syntax: " . $db->error;
}

	scholiste($db);
	/*$statement = ('SELECT * FROM blog');
	if ($db -> query($statement)) {
		while ($obj = $statement -> fetch_object()) {
		  printf("%s (%s)\n", $obj->titel, $obj->text);
		}
		$statement -> free_result();
	  }
	  
	  $db-> close();*/

	?>
 </body>
</html>


