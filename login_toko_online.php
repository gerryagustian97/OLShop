<?php
	include 'connect.php';
	//mysqli_select_db($database); //connect to database
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<body style="background-color: #1D3C4D;">
<div class="form" style="width: 300px; margin-left: 40%; margin-top: 10%;">
	<form action="" method="post" class="form form-control" enctype="multipart/form-data">
		<div class="form-group">
			<label for="idadmin">ID Admin:</label>
			<input type="text" class="form-control" id="idadmin" placeholder="Masukkan ID Admin..." name="idadmin">
		</div>
		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" class="form-control" id="username" placeholder="Masukkan username..." name="username">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" placeholder="Masukkan password..." name="password">
		</div>
		<!--idadmin :<br><input type="text" name="idadmin"><br>
		username :<br><input type="text" name="username"><br>
		harga :<br><input type="text" name="harga"><br><br>-->
		<button type="submit" class="btn btn-default" name="submit">Submit</button>
	</form><br>	
</div>
</body>

<?php
		//session_start();
		if(isset($_POST['idadmin'])and isset($_POST['username']) and isset($_POST['password'])){
			$idadmin = $_POST['idadmin'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$dt = mysqli_query($conn, "select * from admin where idadmin='$idadmin' AND username='$username' AND password='$password' limit 1");
			$data=mysqli_fetch_assoc($dt);
			if(isset($data['idadmin'])) {
				$_SESSION['status']=1;
				header("Location:admin_toko_online.php");
			}
			else {
				echo '<script>alert("Data tidak valid!")</script>';
			}
		}
?>	

