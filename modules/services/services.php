<?php
	$modules= "services";
	$detail = getDetail($lang);

	// SEO
	$title_meta = $detail['title'];
    $meta_desc = $detail['description'];
    $meta_keyword = $detail['keywords'];
	$link_share = $lang."/".$detail['link'].".html";
	
	// BANNER
	$banner = getBanner_services();
	// GET DETAIL
	function getDetail($lang){
		global $connection;
		$query = "SELECT *from services a, services_desc ad where a.id = ad.aid and display = 1 and lang ='".$lang."' limit 0,1";
		// die($query);
		$select_query = mysqli_query($connection,$query);
		if(mysqli_num_rows($select_query)){
			while($row=mysqli_fetch_assoc($select_query)){
				$item = $row;
			}
		}
		return $item;

	}
	function getBanner_services()
	{
		global $connection;
		$query = "SELECT *from banner where pos ='services' and display = 1 order by id DESC limit 0,1 ";
		$select = mysqli_query($connection,$query);
		if(mysqli_num_rows($select)){
			if($row= mysqli_fetch_assoc($select)){
				$src = "uploads/weblink/".$row['src'];	
			}
		}
		else{
			$src = '';
		}
		return $src;
	}

?>