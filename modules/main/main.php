<?php
	$modules='main';

   

    $title_meta = $global_lang['title'];
    $meta_keyword = $global_lang['meta_key'];
    $meta_desc = $global_lang['meta_desc'];

    
	// GET ABOUT
	$limit = $products_config['limit_display'];
	$detail_about = getAbout($lang);
	$list_product = getProducts($lang,$limit);
	$about = getAbout($lang);
	$services = getServices($lang);
	$query = "SELECT n.id from products n, products_desc nd where n.id = nd.p_id and lang = '".$lang."' order by display_order ASC limit 0,$limit";
	$select = mysqli_query($connection,$query);
	$cat_count = mysqli_num_rows($select);

	// $link_share = $lang."/".$name_seo.".html";
	
	function getProducts($lang,$limit){
		global $connection;
			$query = "SELECT * from products n, products_desc nd where n.id = nd.p_id and lang = '".$lang."' order by display_order ASC, n.id DESC limit 0,$limit";
			$select = mysqli_query($connection,$query);
			$item = array();
			if($select){
				while ($row=mysqli_fetch_assoc($select)) {
					array_push($item, $row);
				}
			}else{
				$item="";
			}
		return $item;
	}
	function getCountProducts($lang,$cat_id){
		global $connection;
			$query = "SELECT n.id from products n, products_desc nd where n.id = nd.p_id and lang = '".$lang."' and cat_id =$cat_id order by display_order ASC limit 0,1";
			$select = mysqli_query($connection,$query);
			$count = mysqli_num_rows($select);
		return $count;
	}
	function getAbout($lang){
		global $connection;
			$query = "SELECT *from about a, about_desc ad where a.id = ad.aid and lang = '".$lang."' and display = 1 order by a.id DESC limit 0,1";
			// die($query);
			$select = mysqli_query($connection,$query);
			$count = mysqli_num_rows($select);
			if($count){
				if($row = mysqli_fetch_assoc($select)){
					
					$info = $row;
					$info['link'] = $lang."/".$row['link'];
					$info['src'] = "uploads/about/".$row['thumb'];
				}
			}
			else{
				$info ="";
			}
		return $info;
	}
	function getServices($lang){
		global $connection;
			$query = "SELECT *from services a, services_desc ad where a.id = ad.aid and lang = '".$lang."' and display = 1 order by a.id DESC limit 0,1";
			// die($query);
			$select = mysqli_query($connection,$query);
			$count = mysqli_num_rows($select);
			if($count){
				if($row = mysqli_fetch_assoc($select)){
					
					$info = $row;
					$info['link'] = $lang."/".$row['link'];
					$info['src'] = "uploads/services/".$row['thumb'];
				}
			}
			else{
				$info ="";
			}
		return $info;
	}
?>