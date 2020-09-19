<?php require_once '_header.php' ?>

<h1><?php echo $html_h1 ?></h1>

<?php if (count( $latest_offers ) > 0): ?>


    <div class="row">

        <?php foreach ($latest_offers as $offer): ?>

            <div class="col-auto">
                <div class="card" style="width: 18rem;">
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

<?php require_once '_footer.php'; ?>

