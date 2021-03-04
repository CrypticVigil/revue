<?php

// set up a new connection to the server
include 'db_connect.php';

// pull the list of movies from the movies table
$sql = "SELECT * FROM movies";
$result = mysqli_query($conn, $sql);
$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

// delete a movie
if (isset( $_POST['submit'] )) {
	$id = $_POST['movie_id'];

	$sql = "DELETE FROM movies WHERE id = '$id'";

	// update the database and check for errors
	if ($conn -> query($sql)) {
		// redirect to home page
		header('Location: index.php');
	} else {
		echo 'query error: ' . mysqli_error($conn);
	}

}

?>

<!doctype html>

<html lang="en">

	<?php include 'templates/header.php'; ?>

	<main>
		<div class="main-container">

			<div class="movies-container">

				<?php foreach ($movies as $movie): ?>
					<div class="movie-card">
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
						<form action="index.php" method="post">
							<input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
							<input type='submit' name='submit' class="submit-button" value="Delete Movie">
						</form>
					</div>
				<?php endforeach; ?>
				
			</div>

		</div>
	</main>

	<?php include 'templates/footer.php'; ?>

</html>