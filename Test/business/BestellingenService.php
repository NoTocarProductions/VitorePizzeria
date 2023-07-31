<?php 

declare(strict_types=1);

namespace Business;

use Data\BestellingenDAO;

class BestellingenService {

    public function MaakBestelling($klantID, $totaalPrijs) {
        $bestellingenDAO = new BestellingenDAO();
        $bestellingID = $bestellingenDAO->setBestelling($klantID, $totaalPrijs);
        return $bestellingID;
    }
    
    public function haalBestellingenOp($klantID, $bestelID) {
        $bestellingenDAO = new BestellingenDAO();
        $bestellingen = $bestellingenDAO->getOverzicht($klantID, $bestelID);
        return $bestellingen;
    }
}
?>