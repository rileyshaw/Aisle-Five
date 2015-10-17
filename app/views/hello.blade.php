<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	{{ HTML::style('css/style.css'); }}
</head>
<body>
	<div class="welcome">
		<?php
			for($i = 0; $i< 10; $i++){
				echo "<h2>Item " . $names[$i] . " </h2>";
				echo $images[$i];
			}
		?>
	</div>
</body>
</html>
