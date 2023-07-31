<?php 

declare(strict_types=1);

namespace Business;

use Data\BestelregelDAO;

class BestelregelService {

    public function MaakBestelregel($bestelID, $pizzaID, $aantal) {
        $bestelregelDAO = new BestelregelDAO();
        $bestelregelID = $bestelregelDAO->setBestelregel($bestelID, $pizzaID, $aantal);
        return $bestelregelID;
    }
}