<?php
// auteur: Caylen Ramazan
// functie: definitie class Klant
namespace Bas\classes;

use Bas\classes\Database;

include_once "functions.php";

class Klant extends Database {
    public $klantId;
    public $klantemail = null;
    public $klantnaam;
    public $klantwoonplaats;
    public $klantadres;
    public $klantpostcode;
    private $table_name = "Klant";

    public function crudKlant(): void {
        $lijst = $this->getKlanten();
        $this->showTable($lijst);
    }

    public function getKlanten(): array {
        $sql = "SELECT * FROM $this->table_name";
        $stmt = self::$conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getKlant(int $klantId): array {
        $sql = "SELECT * FROM $this->table_name WHERE klantId = :klantId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['klantId' => $klantId]);
        return $stmt->fetch();
    }

    public function dropDownKlant($row_selected = -1) {
        $lijst = $this->getKlanten();
        echo "<label for='Klant'>Choose a klant:</label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row) {
            $selected = ($row_selected == $row["klantId"]) ? "selected='selected'" : "";
            echo "<option value='$row[klantId]' $selected> $row[klantNaam] $row[klantEmail]</option>\n";
        }
        echo "</select>";
    }

    public function showTable($lijst): void {
        if (empty($lijst)) {
            echo "<p style='color: red;'>Geen klanten gevonden.</p>";
            return;
        }

        $txt = "<table>";
        $txt .= getTableHeader($lijst[0]);

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>{$row["klantId"]}</td>";
            $txt .= "<td>{$row["klantNaam"]}</td>";
            $txt .= "<td>{$row["klantEmail"]}</td>";
            $txt .= "<td>{$row["klantWoonplaats"]}</td>";
            $txt .= "<td>{$row["klantAdres"]}</td>";
            $txt .= "<td>{$row["klantPostcode"]}</td>";

            $txt .= "<td>
                    <form method='post' action='update.php?klantId={$row["klantId"]}'>       
                        <button name='update'>Wzg</button>     
                    </form>
                 </td>";

            $txt .= "<td>
                    <form method='post' action='delete.php?klantId={$row["klantId"]}'>       
                        <button name='verwijderen'>Verwijderen</button>     
                    </form>
                 </td>";
            $txt .= "</tr>";
        }

        $txt .= "</table>";
        echo $txt;
    }


    public function deleteKlant(int $klantId): bool {
        $sql = "DELETE FROM $this->table_name WHERE klantId = :klantId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(['klantId' => $klantId]);
    }

    public function updateKlant($row): bool {
        $sql = "UPDATE $this->table_name SET 
                    klantNaam = :klantNaam, 
                    klantEmail = :klantEmail, 
                    klantWoonplaats = :klantWoonplaats,
                    klantAdres = :klantAdres,
                    klantPostcode = :klantPostcode
                WHERE klantId = :klantId";

        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'klantNaam' => $row['klantNaam'],
            'klantEmail' => $row['klantEmail'],
            'klantWoonplaats' => $row['klantWoonplaats'],
            'klantAdres' => $row['klantAdres'],
            'klantPostcode' => $row['klantPostcode'],
            'klantId' => $row['klantId'],
        ]);
    }

    private function BepMaxKlantId(): int {
        $sql = "SELECT MAX(klantId)+1 FROM $this->table_name";
        return (int) self::$conn->query($sql)->fetchColumn();
    }

    public function insertKlant($row) {
        $klantId = $this->BepMaxKlantId();

        $sql = "INSERT INTO $this->table_name 
                (klantId, klantNaam, klantEmail, klantWoonplaats, klantAdres, klantPostcode)
                VALUES (:klantId, :klantNaam, :klantEmail, :klantWoonplaats, :klantAdres, :klantPostcode)";

        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'klantId' => $klantId,
            'klantNaam' => $row['klantNaam'],
            'klantEmail' => $row['klantEmail'],
            'klantWoonplaats' => $row['klantWoonplaats'],
            'klantAdres' => $row['klantAdres'],
            'klantPostcode' => $row['klantPostcode'],
        ]);
    }
}
