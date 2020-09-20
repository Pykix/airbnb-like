<?php require_once '_header.php' ?>
<a href="#add" class="btn btn-primary">Ajouter une annonce</a>
<h2>Voici vos annonces <?php echo $html_h1 ?></h2>
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
<h2>Ajouter une annonce</h2>
<form action="" id="add">
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title">
    <label for="chapo">Courte description :</label>
    <input type="text" id="chapo" name="chapo">
    <label for="cp">Code postal :</label>
    <input type="text" id="cp" name="cp">
    <label for="price">Code postal :</label>
    <input type="text" id="price" name="price">
    

</form>


<?php require_once '_footer.php'; ?>
