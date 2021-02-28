<?php

include 'db_connect.php';

$sql = "SELECT * FROM movies WHERE id=1";
$result = mysqli_query($conn, $sql);

$movie = mysqli_fetch_array($result, MYSQLI_ASSOC);

?>

<!doctype html>

<html lang="en">

	<?php include 'templates/header.php'; ?>

	<main>
		<div class="main-container">
			<h1><?= $movie[title] ?></h1>
			<h4><?= $movie[year] ?>&ensp;&bull;&ensp;<?= $movie[rated] ?>&ensp;&bull;&ensp;<?= $movie[length] ?>min</h4>

		</div>
	</main>

	<?php include 'templates/footer.php'; ?>

</html>