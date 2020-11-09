<?php ob_start(); ?>
<?php session_start(); ?>


<?php include "db.php"; ?>


<?php 


if(isset($_POST['login'])){
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	
	$query="select * from table_user ";
	$select_user=mysqli_query($connection,$query);
	$row = mysqli_fetch_assoc($select_user);
	
	
	$role=$row['role'];
	$username_db=$row['username'];
	$password_db=$row['password'];
	
	if($username==$username_db && $password==$password_db){
		
		$_SESSION['username']=$username;
		$_SESSION['role']=$role;
		
		header("Location: ../admin");
		
	}
	else{
		header("Location: ../index.php");
	}
	
	
}


?>