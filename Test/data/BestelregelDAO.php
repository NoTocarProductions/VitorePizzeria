<?php
declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;

class BestelregelDAO {

    public function setBestelregel($bestelID, $pizzaID, $aantal)  {

        $sql = "INSERT INTO bestellijnen (bestelID, pizzaID, aantal) 
                values (:bestelID, :pizzaID, :aantal)";
        
        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':bestelID' => $bestelID,
            ':pizzaID' => $pizzaID,
            ':aantal' => $aantal));
        
            $last_id = $dbh->lastInsertId();

            return $last_id;
    }
}