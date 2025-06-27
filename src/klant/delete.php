<?php
require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant();

if (isset($_GET['klantId'])) {
	$klant->deleteKlant((int)$_GET['klantId']);
	header("Location: read.php");
	exit;
}




