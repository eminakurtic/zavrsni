<?php

include('config.php');
if($_SESSION['access_token'] == '') {
header("Location: index.php");
} 
//$_GET korisnik prijavi na google, preusmjeri na php skriptu
if(isset($_GET["code"]))
{
//provjera autentičnosti
$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
//provjera greske tokom prijave
if(!isset($token['error']))
{
//zahtjev 
$google_client->setAccessToken($token['access_token']);
//zahtjev smjesten u $_SESSION za buduću upotrebu
$_SESSION['access_token'] = $token['access_token'];
//objekat klase google oauth2
$google_service = new Google_Service_Oauth2($google_client);
//uzeti podatke korisnickog racuna
$data = $google_service->userinfo->get();
//podaci o profilu 
if(!empty($data['given_name']))
{
$_SESSION['user_first_name'] = $data['given_name'];
}
if(!empty($data['family_name']))
{
$_SESSION['user_last_name'] = $data['family_name'];
}
if(!empty($data['email']))
{
$_SESSION['user_email_address'] = $data['email'];
}
if(!empty($data['gender']))
{
$_SESSION['user_gender'] = $data['gender'];
}
if(!empty($data['picture']))
{
$_SESSION['user_image'] = $data['picture'];
}
}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Login using Google Account</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="card">
<div class="card-header">
You have Successfully Logged In With Google
</div>
<div class="card-body">
<h5 class="card-title"><?php echo $_SESSION['user_first_name'].' '.$_SESSION['user_last_name']?></h5>
<p class="card-text">Email:- <?php echo $_SESSION['user_email_address']; ?> </p>
<img class="user-image" src="<?php echo $_SESSION["user_image"]; ?>" alt="Card image cap">
<a href="logout.php" class="btn btn-primary">Logout</a>
</div>
</div>
</div>
</body>
</html>