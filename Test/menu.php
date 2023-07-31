<?php
//menu.php
declare(strict_types=1);

use Business\PizzaService;


spl_autoload_register();

session_start();
unset($_SESSION["error"]);
unset($_SESSION["confirm"]);
unset($_SESSION['klantID']);
unset($_SESSION["errorHandler"]);
unset($_SESSION["gewijzigd"]);

$found = false;
$newPizza = new PizzaService();

if (isset($_POST["Add"])) {
    if (!isset($_SESSION["gekozenpizzas"])) {
        $_SESSION["gekozenpizzas"] = array();
        $_SESSION["totaalPrijs"] = 0;
        $_SESSION["totaalPromoPrijs"] =0;
    }
    $getPizza = $newPizza->haalPizzaOpMetId($_POST["Add"]);
    $pizzaID = $getPizza->getPizzaID();
    $pizzaNaam = $getPizza->getNaam();
    $pizzaOmschrijving = $getPizza->getOmschrijving();
    $pizzaPrijs = $getPizza->getPrijs();
    $pizzaPromoprijs = $getPizza->getPromotieprijs();

    

    $selectedPizza = array(
        'id' => $pizzaID,
        'naam' => $pizzaNaam,
        'aantal' => 1,
        'prijs' => $pizzaPrijs,
        'promotieprijs' => $pizzaPromoprijs
    );

    foreach ($_SESSION["gekozenpizzas"] as &$item) {
        if ($item['id'] == $pizzaID) {
            
            $item['aantal'] += 1;
            $item['prijs'] += $pizzaPrijs;
            $_SESSION["totaalPrijs"] += $pizzaPrijs;
            $_SESSION["totaalPromoPrijs"] += $pizzaPromoprijs;
            $found = true;  
            break;  
        }
    }
    
   
    if (!$found) {
         $_SESSION["gekozenpizzas"][] = $selectedPizza;
         $_SESSION["totaalPrijs"] += $pizzaPrijs;
         $_SESSION["totaalPromoPrijs"] += $pizzaPromoprijs;
    }


}
if (isset($_SESSION["gekozenpizzas"]) && count($_SESSION["gekozenpizzas"])>0) {
if (isset($_POST["Delete"])) {
    for ($i=0; $i<=count($_SESSION["gekozenpizzas"]); $i++) {
        if ($_SESSION["gekozenpizzas"][$i]['id'] == $_POST["Delete"]) {
            $_SESSION["totaalPrijs"] -= $_SESSION["gekozenpizzas"][$i]['prijs'];
            $_SESSION["totaalPromoPrijs"] -= $_SESSION["gekozenpizzas"][$i]['promotieprijs'];

            array_splice($_SESSION["gekozenpizzas"], $i, 1);
            break;
}
    }
}
}

include('presentation/topnavForm.php');
include('presentation/newMenuForm.php');
include('presentation/footerForm.php');

?>