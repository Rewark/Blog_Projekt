
<?php

session_start();
require_once("model\\connect.inc.php");
//require_once("model\\function.inc.php");
$db = db_connect();
$db->query("USE blog");

if(isset($_REQUEST["delete_blogid"])){
    $delete_blognummer = $_REQUEST["delete_blogid"];
    $statement = $db->prepare("DELETE FROM blog WHERE eintragid=".$delete_blognummer."");
    // $statement->bind_param("i", $_SESSION['userid']);
    $statement->execute();
    echo "Die Blog wurde erfolgreich gelöcht";

    header("location: userblog.php");
}

?>