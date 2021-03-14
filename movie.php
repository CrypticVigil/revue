<?php

include 'db_connect.php';

$id = $_GET['id'];

// pull the selected movie from the movies table
$sql = "SELECT * FROM movies WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$movie = mysqli_fetch_array($result, MYSQLI_ASSOC);

$title = $movie[title];
$year = $movie[year];
$rated = $movie[rated];
$length = $movie[length];
$score = $movie[score];
$description = $movie[description];

?>

<!doctype html>

<html lang="en">

	<?php include 'templates/header.php'; ?>

	<main>
		<div class="main-container">
			<div class="single-movie">
				<div class="title-container">
					<div class="title-container--left">
						<h1><?= $movie[title] ?></h1>
						<h4><?= $movie[year] ?>&ensp;&bull;&ensp;<?= $movie[rated] ?>&ensp;&bull;&ensp;<?= $movie[length] ?>min</h4>
					</div>
					<div class="title-container--right">
						<h2 class="movie-score"><?= $movie[score] ?></h2>
					</div>
				</div>
				<hr>
				<p><?= $movie[description] ?></p>
				<div class="movie-card--buttons">
					<form action="editMovie.php" method="post">
						<input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
						<input type='submit' name='edit' class="submit-button" value="Edit Movie">
					</form>
					<form action="index.php" method="post">
						<input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
						<input type='submit' name='submit' class="submit-button" value="Delete Movie">
					</form>
				</div>
			</div>
		</div>
	</main>

	<?php include 'templates/footer.php'; ?>

</html>