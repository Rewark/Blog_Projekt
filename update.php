<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>UPDATE_Blog</title>       
        <link rel="stylesheet" href="css//style1.css">       
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <header>
   <nav id="mynav">
    <ul>
	 <li><a class="nav-link " href="index.php">Home</a></li>
	 <li><a href="userblog.php"></a></li>
   
	 
  
	</ul>
   </nav>
  </header><br><br><br>

    <h1>INTERESSENGEBIETE</h1>
        <form method="post">
    <div class="mx-auto" style="width: 800px; margin-top: 20px;"btn>
        <label for="exampleFormControlTextarea1" class="form-label">NEW BLOG</label>
        <textarea type="text" name="neu_Blog" value="" class="form-control" id="exampleFormControlTextarea1"  rows="3"></textarea>
        <button type="submit" name="neu_Blog_senden" class="btn btn-secondary" style="margin-top: 10px;">neu Blog senden</button>
    </div>
    </form>
<?php
    require_once("model\\connect.inc.php");
    //require_once("model\\function.inc.php");
    $db = db_connect();
    $db->query("USE blog");

    if(isset($_REQUEST['update_blog']))
{
    if(isset($_REQUEST['neu_Blog_senden']))
    {
        if(!empty($_REQUEST['neu_Blog']))
        {
            //$text=$_REQUEST['update_blog_text'];
            $update_blog_nummer=$_REQUEST['update_blog'];
            $neu_blog=$_REQUEST['neu_Blog'];
            $statement = $db->prepare("UPDATE blog SET text=(?) WHERE eintragid=(?)");
            $statement->bind_param("si",$neu_blog,$update_blog_nummer);
            $statement->execute();
            
            //echo "Das Blog mit den Nummer:".$update_blog_nummer." wurde erfolglich korrigiert";
            //header('location:index4.php');
            
            header("Location: userblog.php");
        }
    }
}
else{
    echo '<div class="alert alert-danger" role="alert" style="z-index:10;">Bitte Blog eingeben!</div>';
}
?>

</body>
</html>