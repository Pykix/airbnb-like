<?php require_once '_header.php' ?>


<form action="/login" method="post">
	<input type="text" name="username" placeholder="login"><br>
	<input type="password" name="password" placeholder="mot de passe"><br>
	<input type="submit" value="CONNEXION" class="btn btn-success">
</form>

<a href="/register">Pas encore inscrit ? Cliquez ici</a>


<?php require_once '_footer.php' ?>


