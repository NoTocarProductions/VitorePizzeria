<!DOCTYPE html>
<html>


    <head>
        <meta charset="UTF-8">
        <title>Overzicht</title>
        <link rel="stylesheet" type="text/css" href="presentation/style/overzichtTry.css" />
    </head>


    <!-- php functionaliteiten ophalen -->

            <!-- ------------------------------------------------------- -->
            <?php 
            use Business\KlantenService;
            $newKlant = new KlantenService();
            $voornaam = $newKlant->haalNaamOp($_SESSION["klantID"]);
            use Business\BestellingenService;
            $newOverzicht = new BestellingenService();
            ?>
            <!-- ------------------------------------------------------- -->


    <body>

    <div class="container">

        <!-- first container (done)
        _______________________________________________________________________ -->
            <div class="one">

                <h1 class="box-header">
                    Bedankt voor uw bestelling <?php print($voornaam['voornaam']) ?>! <br>
                </h1>

                <p style="color:green; font-weight: bold;">
                    <?php if (isset($_SESSION["gewijzigd"])) {
                    print($_SESSION["gewijzigd"]);
                    } ?>
                </p>

            </div>
            <!-- _______________________________________________________________________ -->



                    <!-- second container 
        _______________________________________________________________________ -->
            <div class="two">

                <h1 class="box-header-two">Uw bestelling:</h1>
                <div class="table-container">
                    <table>
                        <caption class="table-caption">Gekozen Pizza's</caption>
                        <tbody>
                            <tr>

                                <?php
                                $overzicht = $newOverzicht->haalBestellingenOp($_SESSION["klantID"], $_SESSION["bestelID"]);
                                foreach($overzicht as $rij) {
                                ?>
                                <tr class="table-row-bestellijn">
                                    <td class="table-name">
                                        <?php print($rij['naam']);
                                        ?>
                                    </td>
                                    <td class="table-amount"> 
                                        <?php print($rij['aantal']);
                                        ?>
                                    </td>
                                    <td class="table-price"> 
                                        <?php

                                        if ($_SESSION["promo"] == 0) {
                                            print($rij['prijs']);
                                        } else {
                                            print($rij['promotieprijs']);
                                        }
                                        ?>
                                    </td>

                                </tr>
                                <?php }?>
                                </form>
                        </tbody>


                    </table>
                    

                    <p class="p-totaal">

                    totaalPrijs:  <span class="prijs"> &euro; <?php if ($_SESSION["promo"] == 0) { 
                        print($rij['totaalPrijs']);
                    } else {
                        print($_SESSION["totaalPromoPrijs"]);
                    }
                        ?>
                    </span>
                    </p>   
                    </div>
            </div>
            <!-- _______________________________________________________________________ -->



                                <!-- third container 
            _______________________________________________________________________ -->
            <div class="three">
                <p class="p-home">
                    klik <a href="homePage.php">hier</a> om terug te keren naar de homepagina.
                </p>
            </div>
            <!-- _______________________________________________________________________ -->


    </div>



    </body>
</html>