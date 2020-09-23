<?php require_once '_header.php' ?>
<?php if (isset( $_SESSION[ 'username' ] )): ?>
    <p>Bievenue <?php echo $_SESSION[ 'username' ] ?></p>
<?php endif; ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card bg-dark text-white">
            <img src="<?php echo IMG_PATH . 'aurora.jpg' ?>" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h5 class="card-title">Voyage Inoubliable</h5>
                <p class="card-text">
                    Ces endroits dont vous vous souviendrez
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card bg-dark text-white">
            <img src="<?php echo IMG_PATH . 'castle.jpg' ?>" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h5 class="card-title">Envie de grandeur ?</h5>
                <p class="card-text">
                    Qui n'a jamais rêvé de s'assoir sur le trône
                </p>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-title">
        <h3><?php echo $html_h1 ?></h3>
    </div>
    <div class="card-body">
        <?php if (count( $latest_offers ) > 0): ?>


            <div class="row  justify-content-around">

                <?php foreach ($latest_offers as $offer): ?>

                    <div class="col-auto d-flex align-items-stretch justify-content-center">
                        <div class="card mb-3 " style="width: 18rem;">

                            <img src="<?php echo IMG_PATH . $offer->picture; ?>" class="card-img-top" alt="...">

                            <div class="card-body">
                                <h5 class="card-title"><?php echo $offer->title ?></h5>
                                <p class="card-text">
                                    <?php echo $offer->chapo; ?> <br>
                                    <?php echo $offer->cp; ?>
                                </p>
                                <p class="card-text">
                                    <?php echo $offer->price; ?> € / nuit
                                </p>
                                <a href="/detail/<?php echo $offer->id ?>" class="btn btn-primary">Reserver</a>
                            </div>
                        </div>


                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <ul class="nav nav-tabs justify-content-around" id="myTab" role="tablist">
                    <li class="nav-item w-50" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab"
                           aria-controls="login" aria-selected="true">Connexion</a>
                    </li>
                    <li class="nav-item w-50" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#inscription" role="tab"
                           aria-controls="inscription" aria-selected="false">Inscription</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form action="/login" method="post" class="text-center ">
                            <input class="my-3 form-control" type="text" name="username" placeholder="login"><br>
                            <input class="mb-3 form-control" type="password" name="password" placeholder="mot de passe"><br>
                            <input type="submit" value="CONNEXION" class="btn btn-success">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="inscription" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="/register" method="post" class="justify-content-center">
                            <input class="my-3 form-control" type="text" name="username" placeholder="login"><br>
                            <input class="mb-3 form-control" type="password" name="password" placeholder="mot de passe"><br>
                            <input class="form-control" type="email" name="email" placeholder="email"><br>
                            <div class="d-flex">
                                <div class="m-3">
                                    <label for="announcer">Annonceur</label>
                                    <input type="radio" id="announcer" name="role" value="0" placeholder="type"><br>
                                </div>
                                <div class="m-3">
                                    <label for="user">Compte utilisateur</label>
                                    <input type="radio" id="user" name="role" value="1" placeholder="type"><br>
                                </div>
                            </div>
                            <input class="btn btn-success" type="submit" value="INSCRIPTION">
                        </form>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<?php require_once '_footer.php'; ?>

