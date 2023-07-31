<?php 
//business/KlantenService.php

declare(strict_types=1);

namespace Business;

use Data\KlantenDAO;

class KlantenService {

    public function updateKlantInfo($klantID, $voornaam, $achternaam, $straatnaam, $huisnummer, $plaatsID) {
        $klantenDAO = new KlantenDAO();
        $klantenDAO->UpdateUserInfo($klantID, $voornaam, $achternaam, $straatnaam, $huisnummer, $plaatsID);
    }

    public function haalKlantInfo($klantID) {
        $klantenDAO = new KlantenDAO();
        $klantInfo = $klantenDAO->getUserInfo($klantID);
        return $klantInfo;
    }
    
    public function maakNieuweKlant($voornaam, $achternaam, $straatnaam, $huisnummer, $plaatsID, $email, $wachtwoord, $opmerkingen) {
        $klantenDAO = new KlantenDAO();
        $klantenDAO->setUser($voornaam, $achternaam, $straatnaam, $huisnummer, $plaatsID, $email, $wachtwoord, $opmerkingen);
    }

    public function maakNieuwBericht($email, $bericht) {
        $klantenDAO = new KlantenDAO();
        $klantenDAO->setMessage($email, $bericht);
    }
    
    public function haalKlantOp($email, $wachtwoord) {
        $klantenDAO = new KlantenDAO();
        $klant = $klantenDAO->getUserLogin($email, $wachtwoord);
        return $klant;
    }

    public function haalklantIdOp($email) {
        $klantenDAO = new KlantenDAO();
        $klantId = $klantenDAO->getUserId($email);
        return $klantId;
    }
    
    public function bestaatEmailAl($email) {
        $klantenDAO = new KlantenDAO();
        $check = $klantenDAO->checkEmail($email);
        return $check;
    }

    public function LoginMailCheck($email) {
        $klantenDAO = new KlantenDAO();
        $check = $klantenDAO->checkUserMail($email);
        return $check;
    }

    public function haalPlaatsenOp() {
        $klantenDAO = new KlantenDAO();
        $plaatsen = $klantenDAO->getPlaatsen();
        return $plaatsen;
    }

    public function haalNaamOp($klantID) {
        $klantenDAO = new KlantenDAO();
        $voornaam = $klantenDAO->getUserName($klantID);
        return $voornaam;
    }

    public function haalPromoOp($klantID) {
        $klantenDAO = new KlantenDAO();
        $promo = $klantenDAO->getUserPromo($klantID);
        return $promo;
    }




}