<?php
//about.php
declare(strict_types=1);
spl_autoload_register();
use Business\KlantenService;
$newMessage = new KlantenService();
session_start();

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $bericht = $_POST["text"];

    $newMessage->maakNieuwBericht($email, $bericht);
}
include('presentation/topnavForm.php');
include('presentation/homePageForm.php');
include('presentation/footerForm.php');

?>
