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
	 <li><a href="userblog.php"></a></li>
   
	 <li><a href=""><?php   echo '<form method="post">
  <input type="submit" name="abmelden" value="abmelden">
  </form>';  ?></a></li> 
	</ul>
   </nav>
  </header>
<br><br>
  <h1>Interessengebiete</h1>

  <?php 
    session_start();
    require_once("model\\connect.inc.php");
    //require_once("model\\function.inc.php");
    $db = db_connect();
    $db->query("USE blog");
    $user = $_SESSION["username"];
    echo "<p id='user'> Willkommen  $user</p>";
    

    echo '<form action="" method="post">
    <textarea name="text" rows="5" cols="60"></textarea> <br><br>
    <input type="submit" name="button" value="Abschicken">
    <select name="blog" size="1">
    <option name= blog value=alle>Alle</option>
    <option name= meinblog value=mein>Meine Blog</option>
    <input type="submit" name="anzeigen" value="Anzeigen"><br><br>
    </form>';



    if(isset($_POST["button"])){
      if(empty($_POST['text'])){
        echo "<p id ='text'>Bitte text feld ausfühlen</p>";
      }else{
        $statement = $db->prepare("INSERT INTO blog(text ,userid) VALUES (?,?)");
        $statement->bind_param("si", $_POST["text"],$_SESSION['userid']);
        $statement->execute();
      
      }
    }

  

    if(isset($_POST["delete"])){
      $statement = $db->prepare("DELETE FROM blog WHERE eintragid=".$_POST['delete']."");
      $statement->execute();

  }

	$statement = $db->prepare("SELECT * FROM blog ORDER BY eintragid DESC");
	if($statement->execute()){
		$result = $statement->get_result();

		while($row = $result->fetch_row()){
     
			list($eintragid, $text, $datum, $userid)=$row;
      
		    printf("<hr><div> $datum $text  </div><form method='post'>Delet <input type='submit' name='delete' value='".$eintragid."'></from></hr>");
    }
 
 }
 


if(isset($_POST['abmelden'])){
  session_destroy();
    unset($_SESSION['userid']);

    header("location: login.php");
}
 

?> 