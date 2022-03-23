<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Interessengebiete</title>
  <link rel="stylesheet" href="css//login.css">
 </head>
 <body>
  <header>
   <nav id="mein-nav">
    <ul>
	 <li><a href="index.php">Home</a></li>
	 <li><a href="login.php">Login</a></li>
	</ul>
   </nav>
  </header>
 
<?php 
  session_start();
  require_once("model\\connect.inc.php");
  $user = "root";
  $pass = "";
  $db = new PDO("mysql:host=localhost;dbname=blog",$user, $pass);
  //$db = db_connect();
  //$db->query("USE blog");
  //überpruft ob der Benutzername frei ist.
  if(isset($_POST["button"])){
      $statement = $db->prepare("SELECT * FROM user WHERE username=:user");
      if(!$statement) {
         die($db->error);
      }
      $statement->bindparam(":user", $_POST['username']);
      $statement->execute();
      $count = $statement->rowCount();
  $pass = $_POST["password"];
    if($count == 1){
       $user = $_SESSION["username"];
        $row = $statement->fetch();
        if(password_verify($pass, $row['password'])){


            $user = $row['username'];

            $_SESSION["username"] = $user;
            $_SESSION["userid"] = $row['userid'];

            header("location: userblog.php");
         }
          else {
             echo "<p class='par'> Passwort ist falsch</p>";
           }
      }else {
         echo "<p class='par'>Benutzername ist nicht vorhanden</p>";
      }
   }    


?>
 <form class="login" action="login.php" method="post">
    <h2> Anmelden</h2>
    <input type="text" name="username" value="" placeholder="Benutzername">
  
    <input type="password" name="password" value="" placeholder="passwort">
   <input type="submit" name="button" value="Anmelden">
   <h3>Sie haben keine Konto<h3><a href="regstrierung.php">Regstrieren Sie sich </a>
  </form>
 </body>
</html>