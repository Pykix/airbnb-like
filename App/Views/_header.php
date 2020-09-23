<!doctype html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_PATH . 'style' . DS . 'style.css' ?>">
    <title><?php echo $html_title ?></title>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <?php
                            if (isset( $_SESSION[ 'role' ] )):
                                if ($_SESSION[ 'role' ] == 0): ?>
                                    <a class="nav-link" href="/mon-espace">Mon espace</a>
                                <?php else: ?>
                                    <a class="nav-link" href="/mes-reservations">Mes Reservations</a>
                                <?php endif; ?>
                            <?php endif; ?>
                    </li>
                    <li class="nav-item ">
                        <?php if (isset( $_SESSION[ 'username' ] )): ?>
                            <a class="nav-link" href="/logout">logout</a>
                        <?php else: ?>
                            <!-- Button trigger modal -->
                            <button  class="nav-link styled" data-toggle="modal" data-target="#staticBackdrop">
                                Connexion / Inscription
                            </button>
                           <!-- <a class="" href="/login">login</a>-->
                        <?php endif; ?>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

</header>
<div class="container">