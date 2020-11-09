<?php
	$modules= "about";

	
	$detail = getDetail($lang);
	
	// HEADER_META
	$title_meta = $detail['title'];
    $meta_desc = $detail['description'];
    $meta_keyword = $detail['keywords'];
    // HEADER_META
    $banner = getBanner_about();
	$link_share = $lang."/".$detail['link'].".html";
	// GET DETAIL
	function getDetail($lang){
		global $connection;
		$query = "SELECT *from about a, about_desc ad where a.id = ad.aid and display = 1 and lang ='".$lang."' limit 0,1";
		// die($query);
		$select_query = mysqli_query($connection,$query);
		if(mysqli_num_rows($select_query)){
			while($row=mysqli_fetch_assoc($select_query)){
				$item = $row;
			}
		}
		return $item;

	}
	function getBanner_about()
	{
		global $connection;
		$query = "SELECT *from banner where pos ='about' and display = 1 order by id DESC limit 0,1 ";
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