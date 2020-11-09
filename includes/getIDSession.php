<?php
	session_start();
	$session_id = session_id();
	$_SESSION['userid'] = $session_id;
	if(isset($_SESSION['userid'])){
		global $connection;
		$query_s = "SELECT session from order_address where session = '$session_id'";
		// die($query_s);
		$select_s = mysqli_query($connection,$query_s);
		$count_s = mysqli_num_rows($select_s);
		if(!$count_s){	 
			$query = "INSERT into order_address(session) values('{$session_id}')";
			$insert = mysqli_query($connection,$query);
		}
		
	}

	
	// unset($_SESSION['userid']);
	
?>