<?php require_once '_header.php' ?>

<?php var_dump($details); ?>
<?php var_dump($equipment); ?>

    <h1><?php echo $details->title ?></h1>


    <img src="<?php echo '../' . $details->picture  ?>" style="width: 50%">


    <p>
        <?php echo $details->description; ?> <br>
        <?php echo $details->cp; ?>
    </p>
    <p>equipment :
        <?php foreach ($equipment as $object){
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
        <?php echo $details->price; ?> € / nuits
    </p>


<?php require_once '_footer.php'; ?>