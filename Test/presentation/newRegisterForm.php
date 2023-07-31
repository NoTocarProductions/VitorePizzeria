<!DOCTYPE html>
<html>


    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="presentation/style/register.css" />
    </head>


    <body>
        <div class="container">
            <div class="registration">
                    <h1 class="registration-group-heading">
                    Register Form
                    </h1>
                <div class="register-group">
                    <p class="LetOp">
                        Let op! Wij leveren enkel in de gemeentes uit het drop-down menu! <br>
                        Het afhalen van pizza's is niet mogelijk, gelieve hiermee rekening te houden.
                    </p>
                    <form method="post" action="">
                        <p class="error">
                        <?php if (isset($_SESSION["error"]) && !isset($_SESSION["confirm"])) {
                                print($_SESSION["error"]);
                                 } ?>
                        </p>
                        <p class="confirmation">
                        <?php if (isset($_SESSION["confirm"])) {
                                print($_SESSION["confirm"]);
                                } ?>
                        </p>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Voornaam</label> 
                                <input class="register-item-input" type="text" name="voornaam" required>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Achternaam</label>
                                <input class="register-item-input" type="text" name="achternaam" required>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Straatnaam</label>
                                <input class="register-item-input" type="text" name="straatnaam" required>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Achternaam</label>
                                <input class="register-item-input" type="text" name="achternaam" required>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Huisnummer</label>
                                <input class="register-item-input" type="number" name="huisnummer" required>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Gemeentes waar wij leveren:</label>
                                <select name="formPlaatsen">
                                    <option disabled selected value> -- kies een gemeente -- </option>
                                    <?php 
                                    use Business\KlantenService;
                                    $newPlaats = new KlantenService();
                                    $getPlaatsen = $newPlaats->haalPlaatsenOp();
                                    foreach($getPlaatsen as $rij) { ?>
                                    <option value=<?php print($rij['plaatsID']); ?>><?php print($rij['gemeente']); ?> </option>
                                    <?php } ?>
                                </select>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Email</label>
                                <input class="register-item-input" type="email" name="email" required>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Password</label>
                                <input class="register-item-input" type="password" name="wachtwoord" required>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Herhaal password</label>
                                <input class="register-item-input" type="password" name="Hwachtwoord" required>
                            </h3>
                        </div>

                        <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Opmerkingen</label>
                                <input class="register-item-input" type="text" name="opmerkingen">
                            </h3>
                        </div>

                        <div class="register-item">
                        <button class="register-item-button" type="submit" name="register" value="register">Register</button>
                        </div>
                    </form>

                </div>



                <div class="login-group">
                    <h1 class="login-group-heading">
                        If you already have an account, you can login here:
                    </h1>
                    <p  class="error">
                        <?php if (isset($_SESSION["errorHandler"])) {
                        print($_SESSION["errorHandler"]);
                    } ?>
                    </p>

                    <form method="post" action="register.php">

                    <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Email</label>
                                <input class="register-item-input" type="email" name="loginEmail" required>
                            </h3>
                    </div>

                    <div class="register-item">
                            <h3 class="register-item-heading">
                                <label class="register-item-label">Password</label>
                                <input class="register-item-input" type="password" name="loginWachtwoord" required>
                            </h3>
                    </div>

                    <button class="register-item-button" type="submit" name="login" value="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>



