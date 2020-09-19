<?php require_once '_header.php' ?>

<?php var_dump( $details ); ?>
<?php var_dump( $equipment ); ?>

    <h1><?php echo $details->title ?></h1>

    <div class="page-content">
        <img src="<?php echo IMG_PATH . $details->picture ?>" style="width: 50%">


        <div class="content d-flex row">
            <div class="details col-auto">
                <p>
                    <?php echo $details->description; ?> <br>
                    <?php echo $details->cp; ?>
                </p>
                <p>equipment :
                    <?php foreach ($equipment as $object) {
                        echo $object->type . ' / ';
                    } ?>
                </p>
                <p> taille :
                    <?php echo $details->height . 'm2'; ?>
                </p>
                <p> Auteur :
                    <?php echo $details->username ?>
                </p>
                <p> Nombres de lit :
                    <?php echo $details->bed_nbrs ?>
                </p>
                <p>
                    <?php echo $details->price; ?> € / nuit
                </p>
            </div>

            <div class="reservation-zone col-auto">
                <div class="card">
                    <div class="card-header">
                        Reservation
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $details->title ?></h5>
                        <form action="">
                            <label for="rangeDate" class="form-label">Date de debut :</label>
                            <input type="text" class="form-control" id="rangeDate" name="dates" placeholder="Choisissez une date">
                            <input type="text" class="form-control" id="rangeDate" name="dates" placeholder="Choisissez une date">
                            <button class="btn btn-primary" type="submit">Reserver</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php require_once '_footer.php'; ?>