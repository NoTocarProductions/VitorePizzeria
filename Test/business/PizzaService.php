<?php 

declare(strict_types=1);

namespace Business;

use Data\PizzaDAO;
use Entities\Pizza;

class PizzaService {

    public function haalPizzasOp() {
        $pizzaDAO = new PizzaDAO();
        $lijst = $pizzaDAO->getOverzicht();
        return $lijst;
    }

    public function haalPizzaOpMetId($pizzaID) : Pizza {
        $pizzaDAO = new PizzaDAO();
        $pizza = $pizzaDAO->getPizzaById($pizzaID);
        return $pizza;
    }
}
?>