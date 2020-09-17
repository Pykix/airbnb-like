<?php require_once '_header.php' ?>

<h1><?php echo $html_h1 ?></h1>
<?php if (count( $latest_offers ) > 0): ?>
    <div class="row">
        <?php foreach ($latest_offers as $offer): ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="App/assets/img/house1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $offer->title ?></h5>
                        <p class="card-text">
                            <?php echo $offer->chapo; ?> <br>
                            <?php echo $offer->cp; ?>
                        </p>
                        <p class="card-text">
                            <?php echo $offer->price; ?> € / nuits
                        </p>
                        <a href="#" class="btn btn-primary">Reserver</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

