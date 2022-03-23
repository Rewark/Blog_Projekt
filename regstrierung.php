<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Interessengebiete</title>
  <link rel="stylesheet" href="css//login.css">
 </head>
 <body>
  <header>
   <nav id="meinnav">
    <ul>
	 <li><a href="index.php">Home</a></li>
	 <li><a href="login.php">Login</a></li> 
	</ul>
   </nav>
  </header>
  
  <?php
   session_start();
   require_once("model\\connect.inc.php");
   $db = db_connect();
   //var_dump($db);
   /*$user = "root";
   $pass = "";
   $db = new PDO("mysql:host=localhost;dbname=blog",$user, $pass);*/

   if(isset($_POST["button"])){
      $db->query("USE blog");
      $statement = $db->prepare("SELECT * FROM user WHERE username=?");
      $statement->bind_param("s", $_POST["username"]);
      $statement->execute();
      $statement->store_result();
      $count = $statement->num_rows();
      $statement->close();

      if($count == 0) {
        if($_POST["password"] == $_POST["password1"]){
            $statement = $db->prepare("INSERT INTO user(username, password) VALUES (?, ?)");


            $hash = password_hash($_POST["password"], PASSWORD_BCRYPT);

            $statement->bind_param("ss", $_POST["username"], $hash);
           // $statement->bind_param(":pass", $hash);
            $statement->execute();
            echo "<b> Dein Benutzer wurde angelegt</p>";

            }else {
                echo "<b class='par'> Die Passwörte stimmen nicht ueberein</p>";
            }
            
        }else {
            echo "<p class='par'> Der Benutzername  ist schon vergeben</p>";
        }
    }

   
  ?>
  <form class="login" action="regstrierung.php" method="post">
  <h2>Regstrieren</h2>
    <input type="text" name="username" value="" placeholder="Benutzername">
    <input type="password" name="password" value="" placeholder="passwort">
    <input type="password" name="password1" placeholder="passwort widerholen">
   <input type="submit" name="button" value="Regstrieren">
   <h3> Sie haben bereit einen Konto<h3>
       <a href="login.php">Melden sie sich here</a>
  </form>
</body> 
