<?php
// auteur: Caylen Ramazan
// functie: Unittest voor Klant insert

use PHPUnit\Framework\TestCase;
use Bas\classes\Klant;

class KlantTest extends TestCase
{
    private $klant;

    protected function setUp(): void
    {
        $this->klant = new Klant();
    }

    public function testInsertKlant()
    {
        // Voorbeeldgegevens (vervang evt. door random unieke strings om dubbele entries te voorkomen)
        $testData = [
            'klantNaam' => 'Test Gebruiker',
            'klantEmail' => 'testuser@example.com',
            'klantWoonplaats' => 'Teststad',
            'klantAdres' => 'Teststraat 1',
            'klantPostcode' => '1234AB'
        ];

        $result = $this->klant->insertKlant($testData);
        $this->assertTrue($result, "De klant moet succesvol worden toegevoegd.");
    }
}
