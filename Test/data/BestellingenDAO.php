<?php
declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;

class BestellingenDAO {

    public function setBestelling($klantID, $totaalPrijs)  {

        $sql = "INSERT INTO bestellingen (klantID, totaalPrijs) values (:klantID, :totaalPrijs)";

        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantID' => $klantID,
            ':totaalPrijs' => $totaalPrijs));
        
            $last_id = $dbh->lastInsertId();

            return $last_id;
    }

    //int $pizzaID, string $naam, string $omschrijving, float $prijs, float $totaalprijs

    public function getOverzicht($klantID, $bestelID) {
        $sql = "SELECT pizza.pizzaID, pizza.naam, pizza.omschrijving, aantal, pizza.prijs, pizza.promotieprijs, bestellingen.totaalPrijs
                from bestellijnen 
                inner join bestellingen on bestellijnen.bestelId = bestellingen.bestelId 
                inner join pizza on bestellijnen.pizzaID = pizza.pizzaID 
                where bestellingen.klantID = :klantID
                and bestellingen.bestelID = :bestelID";

        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $stmt = $dbh->prepare($sql);

            $stmt->execute(array(
                ':klantID' => $klantID,
                ':bestelID' => $bestelID));

            $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $lijstOverzicht = array();

            foreach($resultset as $rij) {
                array_push($lijstOverzicht, $rij);
            }


            $dbh = null;
            return $lijstOverzicht;
    }

}
?>