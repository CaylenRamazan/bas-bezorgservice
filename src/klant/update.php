<?php
// auteur: Caylen Ramazan
require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant();

// Stap 1: Als formulier verzonden is
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['klantId'])) {
    $klantData = [
        'klantId' => $_POST['klantId'],
        'klantNaam' => $_POST['klantNaam'],
        'klantEmail' => $_POST['klantEmail'],
        'klantAdres' => $_POST['klantAdres'],
        'klantPostcode' => $_POST['klantPostcode'],
        'klantWoonplaats' => $_POST['klantWoonplaats']
    ];

    $klant->updateKlant($klantData);
    header("Location: read.php");
    exit;
}

// Stap 2: Als pagina geopend wordt met GET (voor het eerst)
if (isset($_GET['klantId'])) {
    $klantData = $klant->getKlant((int)$_GET['klantId']);
} else {
    die("Geen klantId opgegeven.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Klant bijwerken</title>
</head>
<body>

<h2>Klant bijwerken</h2>

<form method="post">
    <input type="hidden" name="klantId" value="<?= htmlspecialchars($klantData['klantId']) ?>">

    <label for="klantNaam">Naam:</label>
    <input type="text" name="klantNaam" value="<?= htmlspecialchars($klantData['klantNaam']) ?>" required><br>

    <label for="klantEmail">Email:</label>
    <input type="email" name="klantEmail" value="<?= htmlspecialchars($klantData['klantEmail']) ?>" required><br>

    <label for="klantAdres">Adres:</label>
    <input type="text" name="klantAdres" value="<?= htmlspecialchars($klantData['klantAdres']) ?>" required><br>

    <label for="klantPostcode">Postcode:</label>
    <input type="text" name="klantPostcode" value="<?= htmlspecialchars($klantData['klantPostcode']) ?>" required><br>

    <label for="klantWoonplaats">Woonplaats:</label>
    <input type="text" name="klantWoonplaats" value="<?= htmlspecialchars($klantData['klantWoonplaats']) ?>" required><br><br>

    <input type="submit" value="Wijzigen">
</form>

<a href="read.php">Terug</a>

</body>
</html>
