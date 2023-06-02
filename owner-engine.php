<?php

$owner_id = '';
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


if (isset($_POST['owner_register'])) {
	owner_register();
}

if (isset($_POST['owner_login'])) {
	owner_login();
}

function owner_register()
{
	if (isset($_FILES['id_photo'])) {
		$id_photo = 'owner-photo/' . $_FILES['id_photo']['name'];

		// echo $_FILES['image']['name'].'<br>';

		if (!empty($_FILES['id_photo'])) {
			$path = "owner-photo/";
			$path = $path . basename($_FILES['id_photo']['name']);
			// if (move_uploaded_file($_FILES['id_photo']['tmp_name'], $path)) {
			// 	echo "The file " . basename($_FILES['id_photo']['name']) . " has been uploaded";
			// } else {
			// 	echo "There was an error uploading the file, please try again!";
			// }
		}
	}

	if (isset($_FILES['image']['name'][0])) {
		$photo = 'owner-photo/' . $_FILES['image']['name'];

		// echo $_FILES['image']['name'].'<br>';

		if (!empty($_FILES['image'])) {
			$photo_path = "owner-photo/";
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
	global $owner_id, $full_name, $email, $password, $phone_no, $address, $id_type, $id_photo, $photo, $errors, $db;
	// $owner_id = validate($_POST['owner_id']);
	$full_name = validate($_POST['full_name']);
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);
	$phone_no = validate($_POST['phone_no']);
	$address = validate($_POST['address']);
	$id_type = validate($_POST['id_type']);
	// $id_photo = $_POST['id_photo'];
	$random_id = "abc-" . rand();
	$password = md5($password); // Encrypt password
	// $sql = "INSERT INTO owner(full_name,email,password,phone_no,address,id_type,id_photo,image,owner_rand_id,status) VALUES('$full_name','$email','$password','$phone_no','$address','$id_type','$path','$photo_path','$random_id','0')";
	// if ($db->query($sql) === TRUE) {
	// 	header("location:owner-login.php");
	// }

	$ownerQ = $db->query("SELECT * FROM owner WHERE email = '$email'");
	if (mysqli_num_rows($ownerQ) < 1) {
		// echo "true"; die();
		$imageQ = $db->query("SELECT * FROM owner WHERE (image = '$photo_path') || (image = '$path')");
		if (mysqli_num_rows($imageQ) < 1) {
			echo "yes"; die();
			$id_imageQ = $db->query("SELECT * FROM owner WHERE (id_photo = '$photo_path') || (id_photo = '$path')");
			if (mysqli_num_rows($id_imageQ) < 1) {

				$sql = "INSERT INTO owner(full_name,email,password,phone_no,address,id_type,id_photo,image,owner_rand_id,status) VALUES('$full_name','$email','$password','$phone_no','$address','$id_type','$path','$photo_path','$random_id','0')";
				if ($db->query($sql) === TRUE) {
					header("location:owner-login.php");
					move_uploaded_file($_FILES['image']['tmp_name'], $photo_path);
					move_uploaded_file($_FILES['id_photo']['tmp_name'], $path);
				}
			} else {
				echo "<script>window.alert('This id prove name already exist. Please try another!')</script>";
				echo "<script>window.open('owner-register.php', '_self')</script>";
			}
		} else {
			echo "<script>window.alert('This image already exist. Please change image name or try another!')</script>";
			echo "<script>window.open('owner-register.php', '_self')</script>";
		}
	} else {
		echo "<script>window.alert('This email already exist. Please try another!')</script>";
		echo "<script>window.open('owner-register.php', '_self')</script>";
	}
}

function owner_login()
{
	global $email, $db;
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);

	$password = md5($password);
	$sql = "SELECT * FROM owner where email='$email' AND password='$password' LIMIT 1";
	$result = $db->query($sql);
	if ($result->num_rows == 1) {
		$data = $result->fetch_assoc();
		if ($data['status'] == 1) {


			$logged_user = $data['email'];
			session_start();
			$_SESSION['email'] = $email;
			header('location:owner/owner-index.php');
		} else { ?>
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
					<strong>Your registration successful. Wait for admin approve!</strong>
				</div>
			</div>
		<?php }
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
				<strong>Incorrect Email/Password or not registered.</strong> Click here to <a href="owner-register.php" style="color: lightblue;"><b>Register</b></a>.
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