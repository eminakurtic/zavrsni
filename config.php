<?php
 
//google biblioteka
require_once 'vendor/autoload.php';
 
//pozivanje google api
$google_client = new Google_Client();
 
//id
$google_client->setClientId('519765326254-iqo1m1o2pnff25qg5rha93v6fv4afb9d.apps.googleusercontent.com');
 
//Secret key
$google_client->setClientSecret('199f_Tm9tr6nN4X9o9hynnFm');
 
//url preusmjeravanje
$google_client->setRedirectUri('http://localhost/zavrsni/page1/');
 

$google_client->addScope('email');
 
$google_client->addScope('profile');
 
//početak rada
session_start();
 
?>