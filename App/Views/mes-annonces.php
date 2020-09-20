<?php require_once '_header.php' ?>
    <h1>Voici vos annonces <?php echo $html_h1 ?></h1>

    <?php if (count( $announces ) > 0): ?>
    <div class="row">
        <?php foreach ($announces as $announce): ?>
            <div class="col-auto">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo IMG_PATH . $announce->picture; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $announce->title ?></h5>
                        <p class="card-text">
                            <?php echo $announce->chapo; ?> <br>
                            <?php echo $announce->cp; ?>
                        </p>
                        <p class="card-text">
                            <?php echo $announce->price; ?> € / nuit
                        </p>
                        <a href="/detail/<?php echo $announce->id ?>" class="btn btn-primary">Voir</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once '_footer.php'; ?>
