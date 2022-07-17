<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Interessengebiete</title>
  <link rel="stylesheet" href="css//style1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>
 <body>
  <header>
   <nav id="mynav">
    <ul>
	 <li><a class="nav-link " href="index.php">Home</a></li>
	 <li><a href="userblog.php"></a></li>
   
	 <li><a href="userblog.php? Logaut=<?php    session_start(); $_SESSION['username'];?>" class="btn btn-outline-secondary">LOGAOUT</a>
  
	</ul>
   </nav>
  </header>
<br><br><br>
  <h1>INTERESSENGEBIETE</h1>

  <table class="table thead-dark table-striped table-bordered table-responsive-lg" style=" margin-top:100px;">
        <thead>
            <tr>
            <th class="table-info" style="width:150px">UserId</th>
            <th class="table-info" style="width:600px">Blog</th>
            <th class="table-info" style="width:300px">Datum</th>
            <th class="table-info" style="width:250px">Action</th>
            </tr>
        </thead>
        <tbody>  


  <?php 
    //session_start();
    require_once("model\\connect.inc.php");
    //require_once("model\\function.inc.php");
    $db = db_connect();
    $db->query("USE blog");
    $user = $_SESSION["username"];
    echo "<p id='user'> Willkommen  $user</p>";
    

    echo '<form action="" method="post">
    <textarea type="text" name="blog" class="form-control" id="exampleFormControlTextarea1"  rows="3" style="width:800px"></textarea> <br><br>
    <input type="submit" name="button" value="Abschicken">
    </form>';


// Überprüft, ob das Textfeld leer ist oder nicht
    if(isset($_REQUEST["button"])){
      $text = $_REQUEST['text'];
      if(empty($_POST['text'])){
        echo "<p id ='text'>Bitte text feld ausfühlen</p>";
      }else{
        $statement = $db->prepare("INSERT INTO blog(text ,userid) VALUES (?,?)");
        $statement->bind_param("si", $text,$_SESSION['userid']);
        $statement->execute();
        $text = null;
      }
    }



if(isset($_REQUEST['Logaut'])){
  session_destroy();
    unset($_SESSION['userid']);

    header("location: login.php");

}
    
 
    $statement = $db->prepare("SELECT * FROM blog ORDER BY eintragid DESC");
    if($statement->execute()){
      $result = $statement->get_result();
     
      while($row = $result->fetch_row()){
       
        list($eintragid, $text, $datum, $userid)=$row;
        if($userid==$_SESSION['userid']){
           
            
           // for($i = 0; $i < $length; $i++){
          
                //var_dump($arr_eintragid);
                  //Überprüft, ob der Blog gehört der angemeldete User, damit der User löschen.
                  
                  //   printf("<hr><div> $datum $text  <form method='post'><input type='submit' name='delete' value='".$eintragid."'></from></div></hr>");
                  echo '<tr class="table-info">
                  <td>'.$userid.'</td>
                  <td> '.$text.'</td>
                  <td> '.$datum.'</td> 
                
                <td><a href="delete.php? delete_blogid='.$eintragid.'" class="btn btn-outline-danger">DELETE</a>
                <a href="update.php? update_blog='.$eintragid.'" class="btn btn-outline-primary">UPDATE</a></td>
                  </tr>';
            
        }
            else{
                printf(' 
                        <tr class="table-info">
                        <td>'.$userid.'</td>
                        <td> '.$text.'</td>
                        <td>'.$datum.'</td>
                        <td></td>
                          </tr>
                ');
            }
        
      }
   
    }
 



 

?> 

</tbody>
        </table>
   </body>
</html>