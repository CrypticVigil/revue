<?php

	include 'db_connect.php';

	$email = $crust = '';
	$toppings = [];
	$error = false;

	if (isset( $_POST['submit'] )) {
		print_r($_POST);

		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			echo 'Email address is valid.';
			$email = mysqli_real_escape_string($conn, $_POST['email']);
		} else {
			echo 'Email address is not valid.';
			$error = true;
		}
		$crust = $_POST['crust'];

		for ($i = 1; $i < 5; $i++) {
			array_push($toppings, $_POST["topping$i"]);
		}

		$toppings = array_filter($toppings);

		if (!$error) {
			$topString = implode(', ', $toppings);

			// create SQL query
			$sql = "INSERT INTO orders (email, crust, toppings) VALUES ('$email', '$crust', '$topString')";

			// save to database and check for errors
			if (mysqli_query($conn, $sql)) {
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
			<h2>Order A Pizza</h2>
			<form action="order.php" method="post">
				<label for="email">Email Address</label>
				<input type="text" name="email" id="email" value=<?= $email ?> >
				<label for="crust">Crust</label>
				<select name="crust" id="crust">
					<option value="hand-tossed" <?php if ($crust == 'hand-tossed') echo 'selected' ?> >Hand Tossed</option>
					<option value="classic-pan" <?php if ($crust == 'classic-pan') echo 'selected' ?> >Classic Pan</option>
					<option value="deep-dish" <?php if ($crust == 'deep-dish') echo 'selected' ?> >Deep Dish</option>
				</select>
				<h3>Toppings</h3>
				<ul class="toppings">
					<li>
						<input type="checkbox" name="topping1" id="topping1" value="pepperoni" <?php if ($toppings[0]) echo 'checked' ?> >
						<label for="topping1">Pepperoni</label>
					</li>
					<li>
						<input type="checkbox" name="topping2" id="topping2" value="sausage" <?php if ($toppings[1]) echo 'checked' ?> >
						<label for="topping2">Italian Sausage</label>
					</li>
					<li>
						<input type="checkbox" name="topping3" id="topping3" value="pineapple" <?php if ($toppings[2]) echo 'checked' ?> >
						<label for="topping3">Pineapple</label>
					</li>
					<li>
						<input type="checkbox" name="topping4" id="topping4" value="bacon" <?php if ($toppings[3]) echo 'checked' ?> >
						<label for="topping4">Bacon</label>
					</li>
				</ul>
				<input type='submit' name='submit' value="Submit Order">
			</form>
		</div>
	</main>

	<?php include 'templates/footer.php'; ?>

</html>