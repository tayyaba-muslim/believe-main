<?php
include('includes/navbar.php');
include('includes/config.php');


if (!isset($_SESSION['useremail'])) {
	header("location: login.php");

}
?>

<div class="" style= "background-color:black; color:white;">
<section class="home-slider owl-carousel" style= "background-color:black; color:white;">

	<div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5" style= "background-color:black; color:white;">
		<div class="overlay"></div>
		<div class="container" style= "background-color:black; color:white;">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Cart</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
				</div>

			</div>
		</div>
	</div>
</section>
<br>
<br>
<br>
<section class="ftco-section ftco-cart" style= "background-color:black; color:white;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-9 ">
				<table class="table" style= "background-color:black; color:white;">
					<thead class="thead-primary">
						<tr class="text-center" style= "background-color:black; color:white;">

							<th style= "background-color:black; color:white;">Image</th>
							<th style= "background-color:black; color:white;">Title</th>
							<th style= "background-color:black; color:white;">Quantity</th>
							<th style= "background-color:black; color:white;">Price</th>
							<th style= "background-color:black; color:white;">Total</th>
							<th style= "background-color:black; color:white;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$current_user_id = $_SESSION['userid'];

						$cart_data = "SELECT * from cart AS c INNER JOIN `user-register` AS user ON c.userid = user.id INNER JOIN addproduct AS p ON p.pid = c.proid WHERE c.userid = '$current_user_id'";
						$result = mysqli_query($connection, $cart_data);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {

								?>
								<tr class="text-center">
									<!-- <td class="product-remove"><a id="closebtn"><span class="icon-close"></span></a></td> -->
									<input type="hidden" id="cartid" value="<?php echo $row['cartid'] ?>">
									<td class="image-prod"><img class="img" src=" <?php
									echo 'images/' . $row['pimage'] ?>" alt=""></td>

									<td class="product-name">
										<h3>
											<?php
											echo $row['ptitle'] ?>
										</h3>
									</td>


									<td>
									<?php echo $row['cartqty'] ?>

									</td>
									<td class="price">
										<?php echo $row['pprice'] ?>
									</td>
									<td class="total">$66</td>


									<td class="action">
										<a href="removecart.php?itemid=<?php echo $row['cartid'] ?>" class="text-dark"><i
												class="fa-solid fa-trash"></i></a>

									</td>
								</tr><!-- END TR-->
								<?php
							}
						}


						?>
			</div>
			</tbody>
			</table>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

			<script>
				$(document).ready(function () {
					let closebtn = $('#closebtn');
					let cartid = $('#cartid').val();
					closebtn.click(function () {
						$.ajax({
							url: 'remove.php',
							type: 'POST',
							data: { cartid: cartid },
							success: function (data) {
								if (data == 1) {
									alert('data deleted');

								} else {
									alert('not deleted');

								}
							}
						})
					})

				})
			</script>
		</div>
		<div class="col-md-3 mt-5 ftco-animate" style="border: 2px solid white;">
			<div class="cart-total mb-3">
				<h3>Cart Totals</h3>
				<p class="d-flex">
					<span>Subtotal</span>
					<span>$20.60</span>
				</p>
				<p class="d-flex">
					<span>Delivery</span>
					<span>$0.00</span>
				</p>
				<p class="d-flex">
					<span>Discount</span>
					<span>$3.00</span>
				</p>
				<hr>
				<p class="d-flex total-price">
					<span>Total</span>
					<span>$17.60</span>
				</p>
			</div>
			<p class="text-center"><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
		</div>

	</div>
	</div>
</section>

<br>
<br>
<br>






<?php
include('includes/footer.php');
?>