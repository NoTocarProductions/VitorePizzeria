<!DOCTYPE html>
<html>


    <head>
        <meta charset="UTF-8">
        <title>Check-out</title>
        <link rel="stylesheet" type="text/css" href="presentation/style/checkout.css" />

    </head>


    <body>
        <div class="container">
            <div class="registrationInfo">

                <h1 class="registrationInfo-group-heading">
                    Almost there!
                </h1>

                <div class="registrationInfo-group">
                    <h3 class="group-heading-three">Zijn dit nog steeds jouw adresgegevens?</h3>

                    <?php
                    use Business\KlantenService;
                    $newKlant = new KlantenService();
                    $infoKlant = $newKlant->haalKlantInfo($_SESSION["klantID"]); 
                    ?>

                    <div class="registerInfo-item">
                        <h3 class="registerInfo-item-heading">
                            <label class="registerInfo-item-label">Voornaam</label> 
                            <p class="registerInfo-item-text"> <?php print($infoKlant['voornaam']); ?> </p>
                        </h3>
                    </div>

                    <div class="registerInfo-item">
                        <h3 class="registerInfo-item-heading">
                            <label class="registerInfo-item-label">Achternaam:</label> 
                            <p class="registerInfo-item-text"> <?php print($infoKlant['achternaam']); ?> </p>
                        </h3>
                    </div>

                    <div class="registerInfo-item">
                        <h3 class="registerInfo-item-heading">
                            <label class="registerInfo-item-label">Straatnaam:</label> 
                            <p class="registerInfo-item-text"> <?php print($infoKlant['straatnaam']); ?> </p>
                        </h3>
                    </div>

                    <div class="registerInfo-item">
                        <h3 class="registerInfo-item-heading">
                            <label class="registerInfo-item-label">Huisnummer:</label> 
                            <p class="registerInfo-item-text"> <?php print($infoKlant['huisnummer']); ?> </p>
                        </h3>
                    </div>

                    <div class="registerInfo-item">
                        <h3 class="registerInfo-item-heading">
                            <label class="registerInfo-item-label">Gemeente:</label> 
                            <p class="registerInfo-item-text"> <?php print($infoKlant['gemeente']); ?> </p>
                        </h3>
                    </div>
                
                    <form method="POST" action="">
                        <button class="register-item-button" type="submit" name="ja" value="ja"> ja </button>
                    </form>

                </div>




                <div class="changeRegistration-group">

                    <h3 class="group-heading-three">
                        Indien je adresgegevens gewijzigd zijn, gelieve ze hieronder aan te passen:
                    </h3>

                    <form method="post" action="">

                        <div class="registerInfo-item">
                                <h3 class="registerInfo-item-heading">
                                    <label class="registerInfo-item-label">Voornaam</label>
                                    <input class="registerInfo-item-input" type="text" name="voornaam" required>
                                </h3>
                        </div>

                        <div class="registerInfo-item">
                                <h3 class="registerInfo-item-heading">
                                    <label class="registerInfo-item-label">Achternaam</label>
                                    <input class="registerInfo-item-input" type="text" name="achternaam" required>
                                </h3>
                        </div>

                        <div class="registerInfo-item">
                                <h3 class="registerInfo-item-heading">
                                    <label class="registerInfo-item-label">Straatnaam</label>
                                    <input class="registerInfo-item-input" type="text" name="straatnaam" required>
                                </h3>
                        </div>

                        <div class="registerInfo-item">
                                <h3 class="registerInfo-item-heading">
                                    <label class="registerInfo-item-label">Huisnummer</label>
                                    <input class="registerInfo-item-input" type="text" name="huisnummer" required>
                                </h3>
                        </div>

                        <div class="registerInfo-item">
                            <h3 class="registerInfo-item-heading">
                                <label class="registerInfo-item-label">Gemeentes waar wij leveren:</label>
                                <select name="formPlaatsen">
                                    <option disabled selected value> -- kies een gemeente -- </option>
                                    <?php 
                                    $newPlaats = new KlantenService();
                                    $getPlaatsen = $newPlaats->haalPlaatsenOp();
                                    foreach($getPlaatsen as $rij) { ?>
                                    <option value=<?php print($rij['plaatsID']); ?>><?php print($rij['gemeente']); ?> </option>
                                    <?php } ?>
                                </select>
                            </h3>
                        </div>
                        
                        <div class="register-item">
                        <button class="register-item-button" type="submit" name="wijzigen" value="wijzigen">Update my information!</button>
                        </div>

                </div>
            </div>
        </div>
    </body>
</html>


