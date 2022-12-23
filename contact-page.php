<?php
session_start();

include("navbar.php");

?>
<main>
	<div class="container">
		<!-- Header part contain Title page and descriptoion -->
		<div class="header">
			<h2>Contact Us</h2>
			<hr />
			<p>
				Intersted in striking a partnership or do you have any complaint or
				feedback? Fill the form below
			</p>
		</div>

		<!-- End of header Part -->

		<!-- Main part contain form and informatoion contactus -->
		<div class="main">
			<div class="contact">
				<!-- Form start here -->
				<div class="contact-form">
					<form method="post">
						<div class="contact-detail">
							<label for="name">Enter your name</label>
							<input type="text" class="form-control" placeholder="Name" id="name" style="margin-bottom: 15px;" />
							<label class="hide" for="email">Enter your email address</label>
							<input type="email" class="form-control" placeholder="Email" id="email" name="email" style="margin-bottom: 15px;" />
						</div>
						<label class="hide" for="message">message</label>
						<textarea class="form-control" rows="5" id="comment" placeholder="Message" style="resize: none; width: 100%;" name="message"></textarea>

						<button type="submit" class="btn btn-success" style="margin-top: 15px;margin-bottom: 30px;" name="send_msg">SEND MESSAGE</button>
					</form>

					<?php
					// session_start();
					include("config/config.php");

					if (isset($_POST["send_msg"])) {
						if (isset($_SESSION['email'])) {

							$message = $_POST["message"];
							$tenentQuery = $db->query("SELECT * FROM tenant WHERE email = '{$_SESSION['email']}'");
							$tenantR = mysqli_fetch_assoc($tenentQuery);
							$tenantRand = $tenantR["tenant_rand_id"];

							$messageQ = $db->query("INSERT INTO `tenant_to_admin_message`(`tenant_msg_rand_id`, `msg`) VALUES ('$tenantRand','$message')");
							if($messageQ){
								echo "<script>window.alert('Thank you ! We will reply you soon.')</script>";
								echo "<script>window.open('index.php', '_self')</script>";
							}
						} else{
							echo "<script>window.alert('Please Login first')</script>";
						}
					}



					?>
				</div>
				<!-- Form finish here -->

				<!-- Contact Us start here -->
				<!-- <div class="contact-us">
					<h3>Contact Us</h3>

					<span><i style="font-size: 1.5rem;" class="fa fa-map-marker" aria-hidden="true"></i>23, Fola osibo, Lekki&nbsp;phase&nbsp;1</span>
					<span><i style="font-size: 1.5rem;" class="fa fa-phone" aria-hidden="true"></i>08185956620</span>
					<span><i style="font-size: 1.5rem;" class="fa fa-envelope-o" aria-hidden="true"></i>Support@starhotels.com</span>
				</div> -->
				<!-- Contact Us Finish here -->
			</div>
		</div>
	</div>
</main>

<?php
include("footer.php")
?>