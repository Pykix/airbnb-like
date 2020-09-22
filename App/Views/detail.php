<?php require_once '_header.php' ?>

<?php $offer_id = ''; ?>

    <h1><?php echo $details->title ?></h1>

    <div class="page-content">

        <img src="<?php echo IMG_PATH . $details->picture ?>" style="width: 50%">

        <div class="content d-flex row justify-content-around">
            <div class="details col-auto">
                <p>
                    <?php echo $details->description; ?> <br>
                    <?php echo $details->cp; ?>
                </p>
                <p>equipement :
                    <?php foreach ($equipment as $object) {
                        echo $object->type . ' / ';
                        $offer_id = $object->id;
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
                <div class="card my-2">
                    <div class="card-header">
                        Reservation
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $details->title ?></h5>
                        <form action="/reservation" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
                            <input type="hidden" name="offer_id" value="<?php echo $offer_id ?>">
                            <label for="start_date" class="form-label">Date de debut :</label>
                            <input type="text" class="form-control" id="start_date" name="start_date"
                                   placeholder="Choisissez une date">
                            <label for="end_date" class="form-label">Date de fin :</label>
                            <input type="text" class="form-control" id="end_date" name="end_date"
                                   placeholder="Choisissez une date">

                            <button class="btn btn-primary " type="submit">Reserver</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php require_once '_footer.php'; ?>