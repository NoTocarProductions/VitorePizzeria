<?php
//checkout.php
declare(strict_types=1);
spl_autoload_register();
use Business\KlantenService;
$newKlant = new KlantenService();

session_start();



if (isset($_POST["ja"])) {
    header('location: overview.php');
}

if (isset($_POST["wijzigen"])) {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST["achternaam"];
    $straatnaam = $_POST["straatnaam"];
    $huisnummer = $_POST["huisnummer"];
    $gemeenteID = $_POST["formPlaatsen"];

    $newKlant->updateKlantInfo($_SESSION["klantID"], $voornaam, $achternaam, $straatnaam, $huisnummer, $gemeenteID);

    $_SESSION["gewijzigd"] = "Uw adresgegevens werden succesvol gewijzigd.";
    
    header('location: overview.php');

}

include('presentation/topnavForm.php');
include('presentation/checkoutForm.php');
include('presentation/footerForm.php');
