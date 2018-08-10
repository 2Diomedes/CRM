<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>CRM</title>
    </head>
    <body>

        <?php

        $user = "admin";
        $pass = "plop";

        $db = new PDO('mysql:host=localhost;dbname=crm-bdd', $user, $pass);
        $business=$db->query("SELECT * FROM Business")->fetchAll();

        if ($_POST) {
            $newName = $_POST['name'];
            $newAddress = $_POST['address'];

            $insertLine = $db->prepare("INSERT INTO Customers VALUES (NULL, :name, :address)");
            $insertLine->execute([':name' => $newName, ':address' => $newAddress]);
            header("location:index.php");
        }

        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                            <a class="navbar-brand" href="#">My mini (putain de) CRM</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.php">Listings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="addCustomer.php">Ajouter Client</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="addBusiness.php">Ajouter Entreprise</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <div class="row main">

                      <h1>Ajout d'un nouveau client</h1>

                      <form action="addCustomer.php" method="post">
                        <input type="text" name="name" value="" placeholder="Dénomination">
                        <input type="text" name="address" value="" placeholder="Adresse Complète">
                        <select class="" name="businessChoice">
                          <option value="placeholder"> --- </option>
                            <?php foreach ($business as $value):?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach;?>
                        </select>

                        <button type="submit" name="submit">Enregistrer</button>

                      </form>

                </div>
            </div>
        </div>

    <script src="node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="js/script.js" charset="utf-8"></script>
    </body>
</html>
