<?php require_once '_header.php' ?>


<form action="/register" method="post">
    <input type="text" name="username" placeholder="login"><br>
    <input type="password" name="password" placeholder="mot de passe"><br>
    <input type="email" name="email" placeholder="email"><br>
    <div class="d-flex">
        <div class="mx-3">
            <label for="announcer">Annonceur</label>
            <input type="radio" id="announcer" name="role" value="0" placeholder="type"><br>
        </div>
        <div>
            <label for="user">Compte utilisateur</label>
            <input type="radio" id="user" name="role" value="1" placeholder="type"><br>
        </div>
    </div>
    <input type="submit" value="INSCRIPTION">
</form>


<?php require_once '_footer.php' ?>


