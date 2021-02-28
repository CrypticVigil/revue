<?php

include 'db_connect.php';

$sql = "SELECT * FROM orders ORDER BY order_time";
$result = mysqli_query($conn, $sql);

$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset( $_POST['submit'] )) {
	$id = $_POST['order_id'];

	$sql = "DELETE FROM orders WHERE id = '$id'";

	// save to database and check for errors
	if (mysqli_query($conn, $sql)) {
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
			<h1>Orders</h1>

			<div class="orders-container">
				<?php foreach ($orders as $order) : ?>

					<?php $time = date('l \a\t g:ia', strtotime( $order['order_time'] )) ?>

					<div class="pizza-card">
						<h3><?= 'Order #' . $order['id'] ?></h3>
						<ul>
							<li>Email: <?= htmlspecialchars($order['email']) ?></li>
							<li>Time: <?= $time ?></li>
							<li>Crust: <?= htmlspecialchars($order['crust']) ?></li>
							<li>Toppings: <?= htmlspecialchars($order['toppings']) ?></li>
						</ul>
						<form action="index.php" method="post">
							<input type="hidden" name="order_id" value="<?= $order['id'] ?>">
							<input type='submit' name='submit' value="Done">
						</form>
					</div>

				<?php endforeach; ?>

				<?php $numOrders = sizeof($orders); ?>
				<?php if ($numOrders > 1): ?>
					<h2>There are <?= $numOrders ?> orders remaining.</h2>
				<?php elseif ($numOrders == 1): ?>
					<h2>There is 1 order remaining.</h2>
				<?php else: ?>
					<h2>There are no orders remaining.</h2>
				<?php endif; ?>

			</div>
		</div>
	</main>

	<?php include 'templates/footer.php'; ?>

</html>