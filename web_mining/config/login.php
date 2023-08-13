<?php
include 'connect.php';
session_start();
error_reporting(0);

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	$sql = "SELECT * FROM users WHERE username='$username' AND pass='$password'";
	$result = mysqli_query($koneksi, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: ../dashboard-admin.php");
	} else {
		echo "<script>alert('Perhatian: Email Atau Password anda Salah.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" href="../asset/logo.png">
	<title>Kemahasiswaan ITBAD</title>
</head>
<body>
<div class="body-content">
	<div class="container-login">
		<form action="" method="POST" class="login-email">
			<div class="logo">
			<img src="../asset/logo.png" alt="Image" height="180" width="190">
			</div>
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">LOGIN</p>
			<div class="input-group">
				<input type="username" placeholder="username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
		</form>
	</div>
</div>
</body>
</html>
