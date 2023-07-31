<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home Pizza Vitore</title>
        <link rel="stylesheet" type="text/css" href="presentation/style/newMenu.css" />

    </head>

    <body>
        <div class="container">
            <div class="registration">
                <h2 class="menu-group-heading">
                Pizza's
                </h2>
                <div class="menu-group">
                    <form method="post" action="">
                <?php use Business\PizzaService;
                    use Entities\Pizza;
                    $pizzas = new PizzaService();
                    $pizzaOverzicht = $pizzas->haalPizzasOp();

                    foreach ($pizzaOverzicht as $rij) { ?>
                    <div class="menu-item">
                        <img src="./presentation/style/images/sliceO.png" alt="pizza" class="menu-item-image">
                        <div class="menu-item-text">
                           <h3 class="menu-item-heading">
                            <span class="menu-item-name"> <?php print($rij->getNaam()); ?> </span>
                            <span class="menu-item-price"> &euro; <?php print($rij->getPrijs()); ?> </span>
                           </h3> 
                           <p class="menu-item-description">
                            <?php print($rij->getOmschrijving());?> 
                           </p>
                           <button class="menu-item-button" name='Add'value=<?php print($rij->getPizzaID()); ?> style="font-size: small;"> I want this! </button>
                        </div>
                    </div>
                    <?php } ?>
                    </form>
                </div>
            </div>

            <div id="cart-container">
                <div class="cart-content">
                    <table>
                        <caption class="cart-container-caption">Winkelmandje</caption>
                            <tbody>
                                <tr>
                                    <th class="cart-table-header">
                                    Pizza Nome
                                    </th>                    
                                              
                                    <th class="cart-table-header">
                                    Aantal
                                    </th>

                                    <th class="cart-table-header">
                                    Prezzo
                                    </th>  

                                    <form method="post" action="">
                                    
                                    <?php if (isset($_SESSION["gekozenpizzas"])) {
                                        foreach($_SESSION["gekozenpizzas"] as $cart) { ?>

                                    <tr>
                                        <td>
                                            <?php print($cart['naam']);
                                            ?>
                                        </td>

                                        <td> 
                                            <?php print($cart['aantal']);
                                            ?>
                                        </td>

                                        <td> 
                                        &euro; <?php print($cart['prijs']);
                                            ?>
                                        </td>

                                        <td>
                                        <button value=<?php print($cart['id']);?> name='Delete' style="font-size: small;"><img src="./presentation/style/images/delete.jpg" alt="clickpng" border="0"></button>
                                        </td>
                                    </tr>
                                    <?php }}?>
                                    </form>
                            </tbody>
                    </table> 


                <div class="totaal">
                    <?php if (isset($_SESSION["totaalPrijs"])) { ?> 
                        <span class="cart-total-name">Totaal:</span>
                    
                        <span class="cart-total-price"> &euro; <?php print($_SESSION["totaalPrijs"]); ?>  </span>
                    <?php } ?>
                </div>

            <form method="POST" action="register.php">
            <button name='bestel'>Checkout </button>
            </form>
        </div>
    </div>
</div>


            
        
</body>
</html>
