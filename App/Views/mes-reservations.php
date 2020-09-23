<?php require_once '_header.php' ?>
    <h1>Voici vos reservations <?php echo $html_h1 ?></h1>


    <?php if (count( $reservationDetail ) > 0): ?>
    <div class="row">
        <?php foreach ($reservationDetail as $reservation): ?>
            <?php var_dump($reservation) ?>
            <div class="col-auto">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo IMG_PATH . $reservation->picture; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $reservation->title ?></h5>
                        <p class="card-text">
                            <?php echo $reservation->chapo; ?> <br>
                            <?php echo $reservation->cp; ?>
                        </p>
                        <p class="card-text">
                            <?php echo $reservation->price; ?> € / nuit
                        </p>
                        <a href="/detail/<?php echo $reservation->offer_id ?>" class="btn btn-primary">Voir</a>
                        <a href="/delete/<?php echo $reservation->id ?>" class="btn btn-warning">Annuler</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once '_footer.php'; ?>
