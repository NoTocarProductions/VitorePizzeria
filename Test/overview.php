<?php
//overview.php
declare(strict_types=1);



use Business\BestellingenService;
use Business\BestelregelService;
use Business\KlantenService;

spl_autoload_register();


$newBestelling = new BestellingenService();
$newRegel = new BestelregelService();
$newKlant = new KlantenService();

session_start();


if (isset($_SESSION["klantID"])) {
    $promo = $newKlant->haalPromoOp($_SESSION["klantID"]);
    $_SESSION["promo"] = $promo['promo'];

    if ($promo['promo'] == 0) {
    $bestelling = $newBestelling->MaakBestelling($_SESSION["klantID"], $_SESSION["totaalPrijs"]);
    } else {
        $bestelling = $newBestelling->MaakBestelling($_SESSION["klantID"], $_SESSION["totaalPromoPrijs"]);
    }
    $_SESSION["bestelID"] = $bestelling;
    foreach($_SESSION["gekozenpizzas"] as $bestelRegel) {
        $newRegel->MaakBestelregel($bestelling, $bestelRegel['id'], $bestelRegel['aantal']);
    }

    unset($_SESSION["gekozenpizzas"]);
    unset($_SESSION["totaalPrijs"]);
}


include('presentation/topnavForm.php');

include('presentation/overzichtTry.php');
include('presentation/footerForm.php');