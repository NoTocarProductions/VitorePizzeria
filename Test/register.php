<?php
//register.php
declare(strict_types=1);

use Business\KlantenService;
use Exceptions\AlreadyRegisteredException;
use Exceptions\NotRegisteredException;


session_start();

spl_autoload_register();

if (isset($_POST["register"])) {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST["achternaam"];
    $straatnaam = $_POST["straatnaam"];
    $huisnummer = $_POST["huisnummer"];
    $gemeenteID = $_POST["formPlaatsen"];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $herhaalWachtwoord = $_POST["Hwachtwoord"];
    $opmerkingen = $_POST["opmerkingen"];

      if ($wachtwoord !== $herhaalWachtwoord) {
       $_SESSION["error"] = "De wachtwoorden komen niet overeen.";
    } else {
        try {
            $checkEmail = new KlantenService();
            $emailCount = $checkEmail->bestaatEmailAl($email);
        

            $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $newKlant = new KlantenService();
            $setNewUser = $newKlant->maakNieuweKlant($voornaam, $achternaam, $straatnaam, $huisnummer, $gemeenteID, $email, $hash, $opmerkingen);

            $_SESSION["confirm"] = 'U bent succesvol geregistreerd, u kan nu inloggen.';
            header('Location: register.php');


        } catch (AlreadyRegisteredException $ex) {
            $_SESSION["error"] = "This email is already in use, please try again with another email adress.";

        } 
}
}




if (isset($_POST['login'])) {

    $loginEmail = $_POST['loginEmail'];

    $loginWachtwoord = $_POST['loginWachtwoord'];

    try {
    $login = new KlantenService();
    
    $usercheck = $login->LoginMailCheck($loginEmail);

      } catch (NotRegisteredException $ex) {
        $_SESSION["errorHandler"] = "That email adress is not yet registered.";
      }

    if(password_verify($loginWachtwoord, $usercheck['wachtwoord'])){

     
        $_SESSION['klantID'] = $usercheck['klantID'];
        
        setcookie('email', $usercheck['email'], time() + 86400);

        echo '<p class="success">Congratulations, you are logged in! </p>';

        header('Location: checkout.php');  
    
} else {
  $_SESSION["errorHandler"] = "wrong password.";
}}
include('presentation/topnavForm.php');

include('presentation/newRegisterForm.php');
include('presentation/footerForm.php');