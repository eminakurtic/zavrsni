<?php
include('config.php');

$google_client->revokeToken();
//uništavanje prijave
session_destroy();
//vračanje na početnu 
header('location:index.php');
?>