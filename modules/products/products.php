<?php

	include ROOTPATH."/lang/".$lang."/products.php";
	$modules= "products";

	$link_share = curPageURL();
	$mod_bred ="<li><a href='".$lang."/".$products_lang['product_link']."''>".$products_lang['product']."</a></li>";
	$itemID = $tn_id;
	// die($itemID);
	//LOAD CAT
	$arr_cat = loadCat($lang);
	// print_r($arr_cat); die;
	// die($action);
	if($action == '_category'){

		$box_search = 1;
		// GET CAT TITLE
		$query_cat_detail = "SELECT * from products_cat n, products_cat_desc nd where n.id = nd.cat_id and n.id = $itemID and lang = '".$lang."'";
		$select_cat_detail = mysqli_query($connection,$query_cat_detail);
		if($select_cat_detail){
			if($row_cat = mysqli_fetch_assoc($select_cat_detail)){
				$title_cat = $row_cat['title'];
				$cat_parent_id = $row_cat['parentid'];

				// SEO
				$title_meta = $row_cat['title'];
			    $meta_desc = $row_cat['meta_desc'];
			    $meta_keyword = $row_cat['meta_key'];
			}
			
		}
		// GET CAT PARENT

		$query_cat_parent = "SELECT * from products_cat n, products_cat_desc nd where n.id = nd.cat_id and n.id = $cat_parent_id and lang = '".$lang."'";
		$select_cat_parent = mysqli_query($connection,$query_cat_parent);
		if($select_cat_parent){
			while($row_cat_parent = mysqli_fetch_assoc($select_cat_parent)){
				$id_cat_parent = $row_cat_parent['cat_id'];
				$title_cat_parent = $row_cat_parent['title'];
				$link_cat_parent = $row_cat_parent['link'];
			}
			
		}
		// GET CAT ID
		$cat_code = array();
		
		$query_cat = "SELECT * from products_cat n, products_cat_desc nd where n.id = nd.cat_id and parentid = $itemID and lang = '".$lang."'";
		// die($query_cat);
		$select_cat_id = mysqli_query($connection,$query_cat);
		if($select_cat_id){
			while($row = mysqli_fetch_assoc($select_cat_id)){
				$cat_id = $row['cat_id'];
				array_push($cat_code, $row['cat_id']);
				
			}
			array_push($cat_code, $itemID);
			$cat_id_all = implode(",", $cat_code);
			
		}
		$limit_count = $products_config['limit_display'];
		$query_count = "SELECT * from products n, products_desc nd where n.id = nd.p_id and FIND_IN_SET(cat_id,'".$cat_id_all."') and lang = '".$lang."' order by display_order ASC";
		$select_count = mysqli_query($connection,$query_count);
		$cat_count = mysqli_num_rows($select_count);
		$flag = 0;
		$list_product_cat = getProducts_cat($cat_id_all,$lang,$products_config['limit_display']);
		foreach ($arr_cat as $key => $value) {
			if($itemID == $value['parentid']){
				// die("okdasdasd");
				$flag = 1;
			}
			
		}
		if($flag == 1){
			$cat_name = getCatProducts_category($itemID,$lang);
			$cat_sub_name = get_cat_sub($itemID,$lang);
			$mod_bred .= "<li><a href='".$lang."/".SEO_URL."''>".$title_cat."</a></li>";
		}
		else{
			$cat_name = getCatProducts_category($cat_parent_id,$lang);
			$cat_sub_name = getCatProducts_category($itemID,$lang);
			$box_search = 0;
			$mod_bred .= "<li><a href='".$lang."/".$link_cat_parent."''>".$title_cat_parent."</a></li>";
			$mod_bred .= "<li><a href='".$lang."/".SEO_URL."''>".$title_cat."</a></li>";

		}

		$breadcrum = getBreadcrum($lang,$mod_bred);

		
	}
	else if($action == '_detail'){
		$query_detail = "SELECT title, cat_id,meta_desc,meta_key from products n, products_desc nd where n.id = nd.p_id and n.id = $itemID and lang = '".$lang."'";
		$select_detail = mysqli_query($connection,$query_detail);
		if($select_detail){
			if($row_cat = mysqli_fetch_assoc($select_detail)){
				
				$cat_related_id = $row_cat['cat_id'];
				$title_cat_related = $row_cat['title'];
				// SEO
				$title_meta = $row_cat['title'];
			    $meta_desc = $row_cat['meta_desc'];
			    $meta_keyword = $row_cat['meta_key'];
				
			}
			
		}
		foreach ($arr_cat as $key => $value) {
			if($cat_related_id == $value['cat_id']){
				$cat_re_p = $value['parentid'];
				foreach ($arr_cat as $key_p => $value_p) {
					if($cat_re_p == $value_p['cat_id']){
						$mod_bred .="<li><a href='".$lang."/".$value_p['link']."'>".$value_p['title']."</a></li>";
					}
				}
				$mod_bred .="<li><a href='".$lang."/".$value['link']."'>".$value['title']."</a></li>";
			}
			
		}
		$mod_bred .="<li><a href='".$lang."/".SEO_URL."'>".$title_cat_related."</a></li>";
		$breadcrum = getBreadcrum($lang,$mod_bred);
		$limit_re = $products_config['limit_related'];
		$detail_product = getDetail($itemID,$lang,$products_config['ratio']);
		$detail_product_img = getPicDetail($itemID,$lang);
		$detail_op = getOpDetail($itemID,$lang);
		$detail_product_related = getProducts_related($cat_related_id,$lang,$limit_re,$products_config['ratio']);
		// print_r($detail_product_img); die;
		$out_of_stock = '<span class="ex"><i class="fas fa-check"></i> '.$products_lang['status_in'].'</span>' ;
		$trigger_c = 1;
		if($detail_product['stock'] == 0){
			$out_of_stock = '<span class="ex" style="color: red;"><i class="fal fa-times"></i> '.$products_lang['status_out'].'</span>' ;
			$trigger_c = 0;
		}

		$size_d = $detail_product['size'];
		if($size_d){
			$size_d = explode(',', $size_d);
		}
		else{
			$size_d = '';
		}
		$sen_d = $detail_product['sen'];
		if($sen_d){
			$sen_d = explode(',', $sen_d);
		}
		else{
			$sen_d = '';
		}
		$color_d = $detail_product['color'];
		if($color_d){
			$color_d = explode(',', $color_d);
		}
		else{
			$color_d = '';
		}
		





	}
	else{
		
		$limit = $products_config['limit_display'];
		$list_product = getProducts($lang,$limit,$products_config['ratio']);
		$query = "SELECT n.id from products n, products_desc nd where n.id = nd.p_id and lang = '".$lang."'";
		$select = mysqli_query($connection,$query);
		$cat_count = mysqli_num_rows($select);
		$breadcrum = getBreadcrum($lang,$mod_bred);

		// SEO
		$title_meta = $products_lang['title_header'];
	    $meta_desc = $products_lang['meta_desc'];
	    $meta_keyword = $products_lang['meta_key'];
	}
	
	


	//GET BREADCRUM
function getBreadcrum($lang,$ex_bredcrumb){
    $data = "<ul class ='breadcrum'>";
    $data .= "<li><a href='".$lang."''><i class='fas fa-home'></i></a></li>";
    $data .= $ex_bredcrumb;
    $data .= "</ul>";
    return $data;
}
	function loadCat($lang){
	    global $connection;
	    $query = "SELECT * from products_cat p, products_cat_desc pd where p.id = pd.cat_id and lang = '".$lang."'";
	    // die($query);
	    $result= mysqli_query($connection,$query);
	    $item = array();
	    if($result){
	        while($row= mysqli_fetch_assoc($result)){
	            array_push($item, $row);
	            
	        }
	    }   
	    return $item;
	}
	function get_cat_sub($id,$lang){
			global $connection;
			


	    $query = "SELECT *from products_cat n, products_cat_desc nd where n.id = nd.cat_id and parentid = $id and lang = '".$lang."' order by n.id ASC";
	    // die($query);
	    $result= mysqli_query($connection,$query);
	    $selected = "";
	    $data = '';
	    if(mysqli_num_rows($result)){
	        while($row= mysqli_fetch_assoc($result)){
	            
	            $data .= "<option value='{$row['cat_id']}' $selected>{$row['title']}</option>";

	        }
	    }   
	    
	    return $data;
	}
	function getCatProducts_category($id,$lang){
    global $connection;
    $data="";
    $query = "SELECT *from products_cat n, products_cat_desc nd where n.id = nd.cat_id and n.id = $id and lang = '".$lang."' order by n.id ASC";
    // die($query);
    $result= mysqli_query($connection,$query);
    $selected = "";
    if(mysqli_num_rows($result)){
        while($row= mysqli_fetch_assoc($result)){
            
            $data .= "<option value='{$row['cat_id']}' $selected>{$row['title']}</option>";

        }
    }   
    
    return $data; 
}
	function getProducts($lang='vn',$limit,$ratio){
		global $connection;
			$query = "SELECT * from products n, products_desc nd where n.id = nd.p_id and lang = '".$lang."' order by display_order ASC, n.id DESC limit 0,$limit";
			$select = mysqli_query($connection,$query);
			$item = array();
			if($select){
				while ($row=mysqli_fetch_assoc($select)) {
					$src = "uploads/products/thumb/".$row['thumb'];
					$row['price_real'] = $row['price'];
					$price = number_format($row['price'], 0, '', '.');
					if($lang =='en'){
						$price = $row['price'];
					}

					$row['src'] = $src;
					$row['price'] = $price;
					array_push($item, $row);
				}
			}else{
				$item="";
			}
		return $item;
	}
	function getProducts_related($cat_id,$lang='vn',$limit,$ratio){
		global $connection;
			$query = "SELECT * from products n, products_desc nd where n.id = nd.p_id and cat_id =$cat_id and lang = '".$lang."' order by display_order ASC limit 0,$limit";
			$select = mysqli_query($connection,$query);
			$item = array();
			if($select){
				while ($row=mysqli_fetch_assoc($select)) {
					$src = "uploads/products/".$row['picture'];
					$price = number_format($row['price'], 0, '', '.');
					if($lang =='en'){
						$price = $row['price'];
					}
					$row['src'] = $src;
					$row['price'] = $price;
					$row['link'] = $lang."/".$row['link'];
					array_push($item, $row);
				}
			}else{
				$item="";
			}
		return $item;
	}
	function getProducts_cat($cat_id,$lang='vn',$limit){
		global $connection;
		// print_r($cat_id); die;
		// die($cat_id);

			$query = "SELECT * from products n, products_desc nd where n.id = nd.p_id and FIND_IN_SET(cat_id,'".$cat_id."') and lang = '".$lang."' order by display_order ASC, n.id DESC limit 0,$limit";
			// die($query);
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

	// GET DETAIL
	function getDetail($id,$lang='vn',$ratio){
		global $connection;
		// $item
		$query = "SELECT *from products n, products_desc nd where n.id = nd.p_id and p_id = $id and lang='".$lang."'";
		// die($query);
		$select_query = mysqli_query($connection,$query);
		if($select_query){
			while($row=mysqli_fetch_assoc($select_query)){
				$src = "uploads/products/".$row['picture'];
				$item = $row;
				$price = number_format($row['price'], 0, '', '.');
				$item['price_real'] = $row['price'];
				if($lang =='en'){
					$price = $row['price'];
					$item['price_real'] = $price;
				}
				$item['src'] = $src;
				$item['price'] = $price;

				
			}
		}
		else{
			$item ="";
		}
		return $item;

	}
	function getPicDetail($id,$lang='vn'){
		global $connection;
		$arr_src = array();
		$query = "SELECT *from product_images where p_id = $id and lang='".$lang."'";
		// die($query);
		$select_query = mysqli_query($connection,$query);
		if($select_query){
			while($row=mysqli_fetch_assoc($select_query)){
				$src = "uploads/products/".$row['picture'];
				array_push($arr_src, $src);
				// $item['src'] = $src;
			}
		}
		else{
			$arr_src ="";
		}
		return $arr_src;

	}
	function getOpDetail($id,$lang='vn'){
		global $connection;
		// $item
		$arr_op = array();
        $query_op_name = 'SELECT *from product_option p,product_option_desc pd where p.op_id = pd.op_id and lang ="'.$lang.'" and display = 1 order by op_order ASC';
        $select_op_name = mysqli_query($connection,$query_op_name);
		if($select_op_name){
			while($row_op_name = mysqli_fetch_assoc($select_op_name)){
				$id_op =$row_op_name['op_id'];
				$op_name = $row_op_name['op_name'];
				$arr_op[$id_op]= $op_name;
			}
		}
		$query_op = 'SELECT *from products_options_value v, product_option p where v.op_id = p.op_id and p_id = '.$id.' and display = 1 and lang ="'.$lang.'" order by op_order ASC';
		// die($query_op);
		$item ="";
		$select_op = mysqli_query($connection,$query_op);
		if($select_op){
			while($row = mysqli_fetch_assoc($select_op)){
				$value_op = $row['option_value'];
				$id_op_value = $row['op_id'];
				if($value_op=='' || empty($value_op)){

				}
				else{
					$item .='<li>'.$arr_op[$id_op_value].'<span>'.$value_op.'</span></li>';
				}
				
			}
		}        
	    return $item;
	}

	function getPage($total_pages,$cat_id){
		$nav="";
		

	    if($total_pages > 1){
	        $nav .= '<nav aria-label="..." style="margin: 0 auto; text-align:center;"><ul class="pagination">
	        ';
	        
	          for($i=1;$i<=$total_pages;$i++){
	              $nav .= "<li class='page-item'><a class='page-link' href='modules/products/html/products_category_tpl.php?cat_id=$cat_id&pageno=$i'>$i</a></li>";
	          }
	 
	        $nav .= '</ul></nav>';
	    }
	    return $nav;

	}

	// GET DETAIL CAT
	function getCat($cat_id,$lang='vn'){
		global $connection;
		// $item ="";       
		$query = "SELECT *from products_cat n, products_cat_desc nd where n.id = nd.nid and nid = $cat_id and lang='".$lang."'";
		// die($query);
		$select_query = mysqli_query($connection,$query);
		if($select_query){
			while($row=mysqli_fetch_assoc($select_query)){
				$item=$row;
			}
		}
		else{
			$item ="";
		}
		return $item;

	}

	// GET ITEM OF CAT
	function getCatList($cat_id,$lang='vn'){
		global $connection;
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 6;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_pages_sql = "SELECT *from products n, products_desc nd where n.id = nd.n_id and cat_id = $cat_id and lang='".$lang."'";
        // die($total_pages_sql);
        $result = mysqli_query($connection,$total_pages_sql);
        $totals = mysqli_num_rows($result);
                            $total_pages = ceil($totals / $no_of_records_per_page);
        $item=array();
        $nav = getPage($total_pages,$cat_id);
        array_push($item, $nav);
		$query = "SELECT *from products n, products_desc nd where n.id = nd.n_id and cat_id = $cat_id and lang='".$lang."' order by display_order ASC ,n_id DESC";
		// die($query);
		
		$select_query = mysqli_query($connection,$query);
		if($select_query){
			while($row=mysqli_fetch_assoc($select_query)){
				array_push($item, $row);
			}
		}
		else{
			$item ="";
		}
		return $item;

	}


	// GET ITEM OF CAT
	function getFocus($cat_id,$lang='vn'){
		global $connection;
		$query = "SELECT *from products n, products_desc nd where n.id = nd.n_id and cat_id = $cat_id and focus_main = 1 and lang='".$lang."' limit 0,3";
		// die($query);
		$item=array();
		$select_query = mysqli_query($connection,$query);
		if($select_query){
			while($row=mysqli_fetch_assoc($select_query)){
				array_push($item, $row);
			}
		}
		else{
			$item ="";
		}
		return $item;

	}

?>