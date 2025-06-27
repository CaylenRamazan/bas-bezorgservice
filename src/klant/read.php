<?php
// auteur: Caylen Ramazan
// functie: read klanten

require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant();

$zoekterm = $_GET['zoek'] ?? '';

$klantenlijst = array_filter($klant->getKlanten(), function ($k) use ($zoekterm) {
    return stripos($k['klantNaam'], $zoekterm) !== false;
});
?>

<!DOCTYPE html>
<html>
<head>
    <title>Klant Overzicht</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h1>CRUD Klant</h1>
<a href='insert.php'>Nieuwe klant toevoegen</a>
<form method="get">
    <input type="text" name="zoek" placeholder="Zoek op klantnaam" value="<?= htmlspecialchars($zoekterm) ?>">
    <button type="submit">Zoek</button>
</form>

<?php $klant->showTable($klantenlijst); ?>

</body>
</html>
