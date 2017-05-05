<?php
include("helpers/settings.php" );

$params = explode("/",stripslashes($_SERVER["REQUEST_URI"]));

$redirect = new url;
$pageUrl = $redirect->getUrl($db_conn, $params[1]);

echo "<!DOCTYPE html><html>";

include($_SERVER['DOCUMENT_ROOT'] . "/views/head.php");

echo "<body>";

include($_SERVER['DOCUMENT_ROOT'] . "/views/header.php");

echo "<div id='wrapper' class='wrapper col-lg-10'>";

if($pageUrl != false){
	
	include("$pageUrl");
	
}else{
	
	include("pages/error/404.php");
	
}

echo "</div>";
include($_SERVER['DOCUMENT_ROOT'] . "/views/footer.php");

echo "</body>";

?>