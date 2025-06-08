<?php
// auteur: Caylen Ramazan
// functie: insert class Klant

require '../../vendor/autoload.php';
use Bas\classes\Klant;

if (isset($_POST["insert"]) && $_POST["insert"] === "Toevoegen") {
    $klant = new Klant();

    $row = [
        'klantNaam' => $_POST['klantnaam'],
        'klantEmail' => $_POST['klantemail'],
        'klantWoonplaats' => $_POST['klantwoonplaats'],
        'klantAdres' => $_POST['klantadres'],
        'klantPostcode' => $_POST['klantpostcode']
    ];

    if ($klant->insertKlant($row)) {
        echo "<p style='color:green;'>Klant succesvol toegevoegd!</p>";
    } else {
        echo "<p style='color:red;'>Fout bij toevoegen klant.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h1>CRUD Klant</h1>
<h2>Toevoegen</h2>
<form method="post">
    <label for="nv">Klantnaam:</label>
    <input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required />
    <br>
    <label for="an">Klantemail:</label>
    <input type="email" id="an" name="klantemail" placeholder="Klantemail" required />
    <br>
    <label for="wp">Woonplaats:</label>
    <input type="text" id="wp" name="klantwoonplaats" placeholder="Woonplaats" required />
    <br>
    <label for="ad">Adres:</label>
    <input type="text" id="ad" name="klantadres" placeholder="Adres" required />
    <br>
    <label for="pc">Postcode:</label>
    <input type="text" id="pc" name="klantpostcode" placeholder="Postcode" required />
    <br><br>
    <input type='submit' name='insert' value='Toevoegen'>
</form><br>

<a href='read.php'>Terug</a>

</body>
</html>
