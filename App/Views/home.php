<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
	>

	<title><?php echo $html_title ?></title>
</head>
<body>
	<h1><?php echo $html_h1 ?></h1>
	<?php if( count($latest_posts) > 0 ): ?>
		<ul>
			<?php foreach($latest_posts as $post): ?>
				<li><strong><?php echo $post->title ?></strong> - <?php echo $post->author_name ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</body>
</html>
