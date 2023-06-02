<?php

$tenant_id = '';
$full_name = '';
$email = '';
$password = '';
$phone_no = '';
$address = '';
$id_type = '';
$id_photo = '';

$errors = array();

$db = new mysqli('localhost', 'root', '', 'renthouse');

if ($db->connect_error) {
	echo "Error connecting database";
}


if (isset($_POST['tenant_register'])) {
	tenant_register();
}

if (isset($_POST['tenant_login'])) {
	tenant_login();
}

if (isset($_POST['tenant_update'])) {
	tenant_update();
}

function tenant_register()
{
	if (isset($_FILES['id_photo'])) {
		$id_photo = 'tenant-photo/' . $_FILES['id_photo']['name'];

		if (!empty($_FILES['id_photo'])) {
			$path = "tenant-photo/";
			$path = $path . basename($_FILES['id_photo']['name']);
			// if (move_uploaded_file($_FILES['id_photo']['tmp_name'], $path)) {
			// 	echo "The file " . basename($_FILES['id_photo']['name']) . " has been uploaded";
			// } else {
			// 	echo "There was an error uploading the file, please try again!";
			// }
		}
	}
	if (isset($_FILES['image']['name'][0])) {
		$photo = 'tenant-photo/' . $_FILES['image']['name'];

		if (!empty($_FILES['image'])) {
			$photo_path = "tenant-photo/";
			$photo_path = $photo_path . basename($_FILES['image']['name']);
			// if (move_uploaded_file($_FILES['image']['tmp_name'], $photo_path)) {
			// 	echo "The file " . basename($_FILES['image']['name']) . " has been uploaded";
			// } else {
			// 	echo "There was an error uploading the file, please try again!";
			// }
		}
	} else {
		$photo_path = "";
	}
	global $tenant_id, $full_name, $email, $password, $phone_no, $address, $id_type, $id_photo, $photo, $errors, $db;
	// $tenant_id = validate($_POST['tenant_id']);
	$full_name = validate($_POST['full_name']);
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);
	$phone_no = validate($_POST['phone_no']);
	$address = validate($_POST['address']);
	$id_type = validate($_POST['id_type']);
	// $id_photo = $_POST['id_photo'];
	$random_id = "def-" . rand();
	$password = md5($password); // Encrypt password

	$tenantQ = $db->query("SELECT * FROM tenant WHERE email = '$email'");
	if (mysqli_num_rows($tenantQ) < 1) {
		// echo "true"; die();
		$imageQ = $db->query("SELECT * FROM tenant WHERE (image = '$photo_path') || (image = '$path')");
		if (mysqli_num_rows($imageQ) < 1) {
			// echo "true"; die();

			$id_imageQ = $db->query("SELECT * FROM tenant WHERE (id_photo = '$photo_path') || (id_photo = '$path')");
			if (mysqli_num_rows($id_imageQ) < 1) {
		// echo "true"; die();

				$sql = "INSERT INTO tenant(full_name,email,password,phone_no,address,id_type,id_photo,image,tenant_rand_id) VALUES('$full_name','$email','$password','$phone_no','$address','$id_type','$path','$photo_path','$random_id')";
				if ($db->query($sql) === TRUE) {

					move_uploaded_file($_FILES['image']['tmp_name'], $photo_path);
					move_uploaded_file($_FILES['id_photo']['tmp_name'], $path);
					header("location:tenant-login.php");
				}
			} else {
				echo "<script>window.alert('This id prove name already exist. Please try another!')</script>";
				echo "<script>window.open('tenant-register.php', '_self')</script>";
			}
		} else {
			echo "<script>window.alert('This image already exist. Please change image name or try another!')</script>";
			echo "<script>window.open('tenant-register.php', '_self')</script>";
		}
	} else {
		echo "<script>window.alert('This email already exist. Please try another!')</script>";
		echo "<script>window.open('tenant-register.php', '_self')</script>";
	}
}



function tenant_login()
{
	global $email, $db;
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);

	$password = md5($password);
	$sql = "SELECT * FROM tenant where email='$email' AND password='$password' LIMIT 1";
	$result = $db->query($sql);
	if ($result->num_rows == 1) {
		$data = $result->fetch_assoc();
		$logged_user = $data['email'];
		session_start();
		$_SESSION['email'] = $email;
		header('location:index.php');
	} else {





?>


		<style>
			.alert {
				padding: 20px;
				background-color: #DC143C;
				color: white;
			}

			.closebtn {
				margin-left: 15px;
				color: white;
				font-weight: bold;
				float: right;
				font-size: 22px;
				line-height: 20px;
				cursor: pointer;
				transition: 0.3s;
			}

			.closebtn:hover {
				color: black;
			}
		</style>
		<div class="container">
			<div class="alert">
				<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
				<strong>Incorrect Email/Password or not registered.</strong> Click here to <a href="tenant-register.php" style="color: lightblue;"><b>Register</b></a>.
			</div>
		</div>



	<?php
	}
}



function tenant_update()
{
	global $owner_id, $full_name, $email, $password, $phone_no, $address, $id_type, $id_photo, $errors, $db;
	$tenant_id = validate($_POST['tenant_id']);
	$full_name = validate($_POST['full_name']);
	$email = validate($_POST['email']);
	$phone_no = validate($_POST['phone_no']);
	$address = validate($_POST['address']);
	$id_type = validate($_POST['id_type']);
	$password = md5($password); // Encrypt password
	$sql = "UPDATE tenant SET full_name='$full_name',email='$email',phone_no='$phone_no',address='$address',id_type='$id_type' WHERE tenant_id='$tenant_id'";
	$query = mysqli_query($db, $sql);
	if (!empty($query)) {
	?>

		<style>
			.alert {
				padding: 20px;
				background-color: #DC143C;
				color: white;
			}

			.closebtn {
				margin-left: 15px;
				color: white;
				font-weight: bold;
				float: right;
				font-size: 22px;
				line-height: 20px;
				cursor: pointer;
				transition: 0.3s;
			}

			.closebtn:hover {
				color: black;
			}
		</style>
		<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(1000, 0).slideUp(500, function() {
					$(this).remove();
				});
			}, 2000);
		</script>
		<div class="container">
			<div class="alert" role='alert'>
				<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
				<center><strong>Your Information has been updated.</strong></center>
			</div>
		</div>


<?php
	}
}


function validate($data)
{
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}



?>