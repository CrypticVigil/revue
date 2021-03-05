<?php

include 'db_connect.php';

$title = $year = $rated = $length = $score = $description = '';
$error = false;

if (isset( $_POST['submit'] )) {

	// check if each piece of data has been entered and escape special characters

	if ($_POST['title']) {
		$title = $conn -> real_escape_string($_POST['title']);
	} else {
		echo 'No post title';
		$error = true;
	}

	if ($_POST['year']) {
		$year = $conn -> real_escape_string($_POST['year']);
	} else {
		echo 'No release year';
		$error = true;
	}

	if ($_POST['rated']) {
		$rated = $conn -> real_escape_string($_POST['rated']);
	} else {
		echo 'No parental rating';
		$error = true;
	}

	if ($_POST['length']) {
		$length = $conn -> real_escape_string($_POST['length']);
	} else {
		echo 'No length in minutes';
		$error = true;
	}

	if ($_POST['score']) {
		$score = $conn -> real_escape_string($_POST['score']);
	} else {
		echo 'No review score';
		$error = true;
	}

	if ($_POST['description']) {
		$description = $conn -> real_escape_string($_POST['description']);
	} else {
		echo 'No description';
		$error = true;
	}

	if (!$error) {
		// create SQL query
		$sql = "INSERT INTO movies (title, score, year, rated, length, description) VALUES ('$title', '$score', '$year', '$rated', '$length', '$description')";

		// save to database and check for errors
		if ($conn -> query($sql)) {
			// redirect to home page
			header('Location: index.php');
		} else {
			echo 'query error: ' . mysqli_error($conn);
		}
	}

}

?>

<!doctype html>

<html lang="en">

	<?php include 'templates/header.php'; ?>

	<main>
		<div class="main-container">
			<div class="add-container">
				<h2>Add A Movie</h2>
				<hr>
				<form action="addMovie.php" method="post">
					<label for="title">Movie Title</label><br/>
					<input type="text" name="title" id="title" value="<?= $title ?>" class="add-movie--input" >
					<br />
					<label for="year">Year Released</label><br/>
					<input type="text" name="year" id="year" value="<?= $year ?>" class="add-movie--input" >
					<br />
					<label for="rated">Parental Rating</label><br/>
					<input type="text" name="rated" id="rated" value="<?= $rated ?>" class="add-movie--input" >
					<br />
					<label for="length">Length in Minutes</label><br/>
					<input type="text" name="length" id="length" value="<?= $length ?>" class="add-movie--input" >
					<br />
					<label for="score">Score</label><br/>
					<input type="text" name="score" id="score" value="<?= $score ?>" class="add-movie--input" >
					<br />
					<label for="description">Description</label><br/>
					<textarea name="description" id="description" rows=5 ><?= $description ?></textarea>
					<br />
					<input type='submit' name='submit' class="submit-button" value="Add Movie">
				</form>
			</div>
		</div>
	</main>

	<?php include 'templates/footer.php'; ?>

</html>