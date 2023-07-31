<?php
declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Exceptions\NotRegisteredException;
use Exceptions\AlreadyRegisteredException;
use Exceptions\WrongPasswordException;

class KlantenDAO {


    public function UpdateUserInfo($klantID, $voornaam, $achternaam, $straatnaam, $huisnummer, $plaatsID) {
        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $query = $dbh->prepare("UPDATE klanten 
                                SET voornaam = :voornaam, achternaam = :achternaam, straatnaam = :straatnaam,
                                huisnummer = :huisnummer, plaatsID = :plaatsID
                                WHERE klantID = :klantID");
                                
        $query->bindParam("klantID", $klantID, PDO::PARAM_STR);
        $query->bindParam("voornaam", $voornaam, PDO::PARAM_STR);
        $query->bindParam("achternaam", $achternaam, PDO::PARAM_STR);
        $query->bindParam("straatnaam", $straatnaam, PDO::PARAM_STR);
        $query->bindParam("huisnummer", $huisnummer, PDO::PARAM_STR);
        $query->bindParam("plaatsID", $plaatsID, PDO::PARAM_STR);

        $query->execute(); 
        
    }

    public function getUserInfo($klantID) {
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);


        $sql = "SELECT * from klanten
        INNER JOIN plaatsen on klanten.plaatsID = plaatsen.plaatsID
         where klantID = :klantID";


        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantID' => $klantID));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

        return $result;
    }

    public function getUserLogin($email, $wachtwoord) {
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);


        $sql = "select * from klanten where email = :email and wachtwoord = :wachtwoord";


        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':email' => $email,
            ':wachtwoord' => $wachtwoord));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

            if (!$result) {
                throw new WrongPasswordException();
                }
    
        return $result;
    }

    public function checkUserMail($email) {
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);


        $sql = "select * from klanten where email = :email";


        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':email' => $email));

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

            if (!$result) {
                throw new NotRegisteredException();
                }
    
        return $result;
    }


    public function getUserId($email) {

        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
    
    
        $sql = "select klantID from klanten where email = :email";
    
    
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':email' => $email));
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $dbh = null;
        
        return $result;

    }

    public function setUser($voornaam, $achternaam, $straatnaam, $huisnummer, $plaatsID, $email, $wachtwoord, $opmerkingen) {
        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $query = $dbh->prepare("INSERT INTO klanten(voornaam, achternaam, straatnaam, huisnummer, plaatsID, email, wachtwoord, opmerkingen, promo) 
        VALUES (:voornaam, :achternaam, :straatnaam, :huisnummer, :plaatsID, :email, :wachtwoord, :opmerkingen, 0)");

        $query->bindParam("voornaam", $voornaam, PDO::PARAM_STR);
        $query->bindParam("achternaam", $achternaam, PDO::PARAM_STR);
        $query->bindParam("straatnaam", $straatnaam, PDO::PARAM_STR);
        $query->bindParam("huisnummer", $huisnummer, PDO::PARAM_STR);
        $query->bindParam("plaatsID", $plaatsID, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("wachtwoord", $wachtwoord, PDO::PARAM_STR);
        $query->bindParam("opmerkingen", $opmerkingen, PDO::PARAM_STR);

        $query->execute(); 
        
    }

    public function setMessage($email, $bericht) {

        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $query = $dbh->prepare("INSERT INTO berichten(email, bericht) 
                                VALUES (:email, :bericht)");

        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("bericht", $bericht, PDO::PARAM_STR);
        
        $query->execute(); 

    }


    public function checkEmail($email) {
        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $query = $dbh->prepare("SELECT * FROM klanten WHERE email=:email");

        $query->bindParam("email", $email, PDO::PARAM_STR);

        $query->execute();

        $check = $query->rowCount();

        if ($check == 1) {
            throw new AlreadyRegisteredException();
        }

        return $check;
    }

    public function getPlaatsen() {
        $sql = "SELECT * from plaatsen 
        where isleverbaar = 1
order by postcode asc";

        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $resultSet = $dbh->query($sql);

        $lijst = array();

        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }

        $dbh = null;
        return $lijst;
    }


    public function getUserName($klantID) {

        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
    
    
        $sql = "select voornaam from klanten where klantID = :klantID";
    
    
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantID' => $klantID));
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $dbh = null;
        
        return $result;

    }

    public function getUserPromo($klantID) {

        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
    
    
        $sql = "select promo from klanten where klantID = :klantID";
    
    
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantID' => $klantID));
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $dbh = null;
        
        return $result;

    }

}
