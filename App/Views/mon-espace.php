<?php require_once '_header.php' ?>
<?php var_dump( $announces ); ?>

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
                        <a href="/detail/<?php echo $announce->id ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<h2>Ajouter une annonce</h2>
<form action="/add-announce" method="post" id="add">
    <div class="d-flex">
        <div>
            <input type="hidden" name="author_id" value="<?php echo $announces[ 0 ]->author_id ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Titre :</label><br>
                <input type="text" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="chapo" class="form-label">Courte description :</label><br>
                <textarea name="chapo" id="chapo" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
                <label for="cp" class="form-label">Code postal :</label><br>
                <input type="text" id="cp" name="cp">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prix :</label><br>
                <input type="text" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type de logement :</label><br>
                <select name="type" id="type">
                    <option value="<?php echo ENTIERE ?>">Entier</option>
                    <option value="<?php echo CHAMBRE_PRIVEE ?>">Chambre privée</option>
                    <option value="<?php echo CHAMBRE_PARTAGEE ?>">Chambre partagée</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="bed_nbrs" class="form-label">Nombre de lit :</label><br>
                <input type="text" id="bed_nbrs" name="bed_nbrs">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Adresse :</label><br>
                <input type="text" id="address" name="address">
            </div>
            <div class="mb-3">
                <label for="height">Surface en m² :</label><br>
                <input type="text" id="height" name="height">
            </div>
            <div class="mb-3">
                <label for="description">Description complète :</label><br>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div>
            <h5>Equipement</h5>
            <p>Les voayageurs s'attendent à trouver les produits de base (serviette, drap, gel douche, etc...)</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="machine à laver" value="9" id="machine-a-laver">
                <label class="form-check-label" for="machine-a-laver">
                    Machine à laver
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="balcon" value="13" id="balcon">
                <label class="form-check-label" for="balcon">
                    Balcon
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="piscine" value="3" id="piscine">
                <label class="form-check-label" for="piscine">
                    Piscine
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="wifi" value="11" id="wifi">
                <label class="form-check-label" for="wifi">
                    Wifi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cuisine" value="10" id="cuisine">
                <label class="form-check-label" for="cuisine">
                    Cuisine
                </label>
            </div>
        </div>
    </div>
    <div>
        <button class="btn btn-success">Ajouter</button>
    </div>
</form>


<?php require_once '_footer.php'; ?>
