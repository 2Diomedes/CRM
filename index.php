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

        $customer=$db->query("SELECT * FROM Customers")->fetchAll();
        $business=$db->query("SELECT * FROM Business")->fetchAll();

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
                        <h1>Listing clients/entreprises</h1>

                        <div class="col-12">
                            <div class="list-group row" id="list-tab" role="tablist">

                                <a class="list-group-item list-group-item-action active col-6" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Client</a>

                                <a class="list-group-item list-group-item-action col-6" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Entreprise</a>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

<!-- le Collapse en BDD-->

                                    <div id="accordion">

                                    <?php foreach ($customer as $value):?>

                                        <?php $clientBussiness = $db->query("SELECT * FROM Business WHERE customer_id=".$value['id'])->fetch();
                                        ?>

                                        <div class="card">
                                            <div class="card-header" id="heading<?php echo $value['id'] ?>">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $value['id'] ?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <?php echo $value['name'] ?>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse<?php echo $value['id'] ?>" class="collapse" aria-labelledby="heading<?php echo $value['id'] ?>" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <img class="mr-3" src="https://picsum.photos/150/120/?random" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="mt-0"><?php echo $value['name'] ?></h5>
                                                            <p><?php echo $value['address'] ?></p>
                                                            <a href="#"><?php echo $clientBussiness['name'] ?></a>
                                                            <a href="editCustomers.php?id=<?php echo $value['id'] ?>"><i class="fas fa-edit"></i></i></a>
                                                            <a href="#"><i class="fas fa-trash-alt"></i></a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach;?>

<!-- fin Collapse -->

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

<!-- Collapse BDD entreprise-->

<div id="accordion">

<?php foreach ($business as $value):?>

    <?php $worker = $customer[$value['customer_id']-1];?>

    <div class="card">
        <div class="card-header" id="heading<?php echo $value['id'] ?>">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $value['id'] ?>" aria-expanded="true" aria-controls="collapseOne">
                    <?php echo $value['name'] ?>
                </button>
            </h5>
        </div>

        <div id="collapse<?php echo $value['id'] ?>" class="collapse" aria-labelledby="heading<?php echo $value['id'] ?>" data-parent="#accordion">
            <div class="card-body">
                <div class="media">
                    <img class="mr-3" src="https://picsum.photos/150/120/?random" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $value['name'] ?></h5>
                        <p><?php echo $value['address'] ?></p>
                        <a href="#"><?php echo $worker['name']?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach;?>

<!-- fin Collapse -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="js/script.js" charset="utf-8"></script>
    </body>
</html>
