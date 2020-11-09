<?php
	$modules= "contact";

	
	$detail= getDetail($lang);
	// SEO_HEAD
	$title_meta = $detail['title'];
    $meta_desc = $detail['meta_desc'];
    $meta_keyword = $detail['meta_key'];

	function getDetail($lang){
		global $connection;
		$query = "SELECT *from company where lang = '".$lang."' limit 0,1";
		$select = mysqli_query($connection,$query);
		if($select){
			while($row = mysqli_fetch_assoc($select)){
				$item = $row;
			}
		}
		else{
			$item="";

		}
		return $item;
	}
?>