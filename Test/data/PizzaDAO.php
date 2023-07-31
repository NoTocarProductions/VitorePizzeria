<?php 
declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Pizza;

class PizzaDAO {

    public function getOverzicht() {
        $sql = "SELECT * from pizza order by pizzaID asc";

        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $resultSet = $dbh->query($sql);

        $lijst = array();

        foreach ($resultSet as $rij) {
            $pizza = new Pizza($rij['pizzaID'], $rij['naam'], $rij['omschrijving'], $rij['prijs'], $rij['promotieprijs']);
            array_push($lijst, $pizza);
        }

        $dbh = null;
        return $lijst;
    }

    public function getPizzaById($pizzaID) {
        $sql = "SELECT * FROM pizza WHERE pizzaID = :pizzaID";

        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':pizzaID' => $pizzaID));
    
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $pizza = new Pizza($rij['pizzaID'], $rij['naam'], $rij['omschrijving'], $rij['prijs'], $rij['promotieprijs']);

        $dbh = null;

        return $pizza;
    }
}