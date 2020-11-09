<?php ob_start(); ?>
<?php session_start(); ?>


<?php include "../config.php"; ?>


<?php 


if(isset($_POST['login'])){
	global $connection;
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password = hash('ripemd160', $password);
	
	$query="select * from users";
	$select_user=mysqli_query($connection,$query);
	$row = mysqli_fetch_assoc($select_user);
	
	
	$role=$row['role'];
	$username_db=$row['username'];
	$password_db=$row['password'];
	$_SESSION['success'] = "wrong";
	if($username==$username_db && $password==$password_db){
		
		$_SESSION['username']=$username;
		$_SESSION['role']=$role;
		$_SESSION['success'] = "ok";
		// die($_SESSION['success']);
		header("Location: ../admin");
		
	}
	else{
		header("Location: ../index.html");
	}
	
	
}


?>