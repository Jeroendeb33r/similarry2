<?php

ini_set('display_errors', 1);

$siteUrl = "localhost";
$fileStream = 'C:/xampp/htdocs/similarry/';
chdir($fileStream);
$rootName = ''; //Use this to test website in diffrent map in root

$m_host = 'localhost';
$m_user = 'root';
$m_database = 'similarry';
$m_pw = '';

$db_conn = ["$m_host", "$m_user", "$m_pw", "$m_database"];
$d = ["$m_host", "$m_user", "$m_pw", "$m_database"];
$l = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

function input($text_id, $lan, $db_conn) {
    return new input($text_id, $lan, $db_conn);
}

if(isset($_SERVER['HTTPS'])) {
	
   $hostName = 'https://' . $_SERVER['HTTP_HOST'];
   $url = $hostName . $_SERVER['REQUEST_URI'];
   
} else {
	
	$hostName = 'http://' . $_SERVER['HTTP_HOST'];
	$url = $hostName . $_SERVER['REQUEST_URI'];
	
}

//======================================================================
// INCLUDE ALL HELPERS
//======================================================================

include( $_SERVER['DOCUMENT_ROOT'] . $rootName . '/lib/session.php' );
include( $_SERVER['DOCUMENT_ROOT'] . $rootName . '/lib/db.php' ); //functions to do simple database calls
include( $_SERVER['DOCUMENT_ROOT'] . $rootName . '/lib/random.php' ); //generate random string
include( $_SERVER['DOCUMENT_ROOT'] . $rootName . '/lib/Mobile_Detect.php' );

include( $_SERVER['DOCUMENT_ROOT'] . $rootName . '/helpers/upload.php' ); //generate emails
include( $_SERVER['DOCUMENT_ROOT'] . $rootName . '/helpers/url.php' );


$session = Session::getInstance();
//======================================================================
// CHECK FOR DEVICE
//======================================================================

$detect = new Mobile_Detect;

$device = 'desktop';

// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
	
	$device = 'mobile';
 
}
 
// Any tablet device.
if( $detect->isTablet() ){
	
	$device = 'tablet';
 
}

//======================================================================
// START / CHECK FOLLOW SESSION
//======================================================================

if(!isset( $session->id )){
	
	$session->id = time() . rand(0, 99999);
	$session->firstVisit = time();
	$session->device = $device;
	$session->page = 0; //Hier moet pagina nummer komen
	
}

//$session->__unset('history');

$historyArr = $session->history;

//HistoryArr is saved in views/head.php

$total = count($historyArr);
$count = 0;
$lastVisitedPage = "";

if($total > 0){

	foreach($historyArr as $time => $val){
		
		$count++;

		if($val['url'] != $url && $count < $total){
		
			$lastVisitedPage = $val['url'];
		
		}		
	}

	if($lastVisitedPage == ""){
		
		$lastVisitedPage = $url;
		
	}
	
}else{
	
	$lastVisitedPage = $url;
	
}

//======================================================================
// SET IP ADRESS
//======================================================================

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}


?>