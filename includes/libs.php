<?php
//GET CURRENT PAGE
function curPageURL() { 
 $pageURL = 'http'; 
if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://"; 
 if ($_SERVER["SERVER_PORT"] != "80") { 
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
 } else { 
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
 } 
 return $pageURL; 
} 
//GET LOGO
function getBanner($pos){
    global $connection;
    $banner ="";
    $query = "SELECT *from banner where pos ='".$pos."' and display = 1 order by id DESC limit 0,1 ";
    // die($query);
    $select = mysqli_query($connection,$query);
    if(mysqli_num_rows($select)){
        if($row= mysqli_fetch_assoc($select)){
            $img = $row['src'];
            $title = $row['title'];
            $src ='uploads/weblink/'.$img;
        }
        $banner .= '<div class="box_banner">';
        $banner .= '<div class="banner">';
        $banner .= '<div class="item"><div class="img">';
        $banner .=  '<img src="'.$src.'" alt="'.$title.'">';  
        $banner .= '</div></div></div>';
        $banner .= '<div class="scroll">
        <p>Scroll to Shopping</p>
        <img src="4-images/mrev_scroll.png" alt="">
      </div>';
      $banner .= '</div>';
    }
    else{
        $banner ='';
    }
    return $banner;
}

function getParallax($pos){
    global $connection;
    $src ="";
    $query = "SELECT *from banner where pos ='".$pos."' and display = 1 order by id DESC limit 0,1 ";
    // die($query);
    $select = mysqli_query($connection,$query);
    if(mysqli_num_rows($select)){
        if($row= mysqli_fetch_assoc($select)){
            $img = $row['src'];
          
            $src ='uploads/weblink/'.$img;
        }
        
    }
    else{
        $src ='';
    }
    return $src;
}
function getFavicon()
{
    global $connection;
    $query = "SELECT *from banner where pos ='favicon' and display = 1 order by id DESC limit 0,1 ";
    $select = mysqli_query($connection,$query);
    if($select){
        if($row= mysqli_fetch_assoc($select)){
            $src = $row['src'];
           $logo = '<link rel="icon" href="uploads/weblink/'.$src.'">';
        }
    }
    else{
        $logo ='';
    }
    
    return $logo;
}
function getLogo()
{
	global $connection;
	$query = "SELECT *from banner where pos ='logo' and display = 1 order by id DESC limit 0,1 ";
	$select = mysqli_query($connection,$query);
	if($select){
		if($row= mysqli_fetch_assoc($select)){
			$img = $row['src'];
			$title = $row['title'];
		}
	}
	$logo = '<a href="index.html"><img src="uploads/weblink/'.$img.'" alt="'.$title.'"></a>';
	return $logo;
}
function getLogoFooter()
{
    global $connection;
    $query = "SELECT *from banner where pos ='logo_footer' and display = 1 order by id DESC limit 0,1 ";
    $select = mysqli_query($connection,$query);
    if(mysqli_num_rows($select)){
        if($row= mysqli_fetch_assoc($select)){
            $img = $row['src'];
            $title = $row['title'];
            $logo = '<img src="uploads/weblink/'.$img.'" alt="'.$title.'">';
        }
    }
    else{
        $logo = '';
    }
    return $logo;
}
function getMenu($lang='vn')
{
	global $connection;
	$menu = '<ul class="uk-list menu_list">';
	$query = "SELECT *from menu m, menu_desc md where m.id =md.m_id and lang ='".$lang."' and pos ='main' and parentid = 0 and display = 1 order by display_order ASC";
    $select_menu= mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_menu)){
    	$link = $lang."/".$row['link'];
    	$menu .='<li><a href="'.$link.'">'.$row['title'].'</a>';
    	$menu .= getMenuSub($lang,$row['m_id']);
    	$menu .= '</li>';
    }
    $menu .= '</ul>';
    return $menu;
}
function getMenuQuick($lang='vn')
{
    global $connection;
    $menu = '<ul>';
    $query = "SELECT *from menu m, menu_desc md where m.id =md.m_id and lang ='".$lang."' and pos ='quick' and parentid = 0 and display = 1 order by display_order ASC";
    $select_menu= mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_menu)){
        $link = $lang."/".$row['link'];
        $menu .='<li><a href="'.$link.'">'.$row['title'].'</a>';
       
        $menu .= '</li>';
    }
    $menu .= '</ul>';
    return $menu;
}
function getMenuSub($lang,$pid){
	global $connection;
	$menu_sub ='<span class="drop"></span><ul class="uk-nav-sub" >';
	$query_sub = "SELECT * from menu m, menu_desc md where m.id = md.m_id and lang = '".$lang."' and pos ='main' and parentid = $pid and display = 1 order by display_order ASC";
    $select_sub_menu= mysqli_query($connection,$query_sub);
    $count_rows = mysqli_num_rows($select_sub_menu);
    if($count_rows != 0){
    	while($row = mysqli_fetch_assoc($select_sub_menu)){
    		$link = $lang."/".$row['link'];
    		$menu_sub .='<li><a href="'.$link.'">'.$row['title'].'</a>';
	    	$menu_sub .= getMenuSub($lang,$row['m_id']);
	    	$menu_sub .= '</li>';
    	}
    	$menu_sub .= '</ul>';
    }
    else{
    	$menu_sub='';
    }
    return $menu_sub;
 	

}
function getLang($lang){
	global $connection;
	$query = "SELECT * from languages";
	$select = mysqli_query($connection,$query);
	$box_lang ='';
	$count_rows = mysqli_num_rows($select);
    if($count_rows != 0){
    	while($row = mysqli_fetch_assoc($select)){
    		if($row['name'] != $lang){
				$box_lang = '<a href="'.$row['name'].'/index.html?lang='.$row['name'].'">'.$row['title'].'</a>';
			}
    	}
    	
    }
    return $box_lang;	
}
function getContact($lang){
    global $connection;
    $query = "SELECT * from company where lang ='".$lang."' limit 0,1";
    $select = mysqli_query($connection,$query);  
    $count_rows = mysqli_num_rows($select);
    if($count_rows != 0){
        while($row = mysqli_fetch_assoc($select)){
            $item = $row;
        }
        
    }
    else{
        $item ='';
    }
    return $item;   
}
function getCatProducts($lang,$id){
    global $connection;
    $data="";
    $query = "SELECT *from products_cat n, products_cat_desc nd where n.id = nd.cat_id and parentid = 0 and lang = '".$lang."' order by display_order ASC";
    // die($query);
    $result= mysqli_query($connection,$query);
    $selected = "";
    if(mysqli_num_rows($result)){
        while($row= mysqli_fetch_assoc($result)){
            if($id == $row['cat_id']){
                $selected = 'selected';
            }
            else{
                $selected = "";
            }
            $data .= "<option value='{$row['cat_id']}' $selected>{$row['title']}</option>";

        }
    }   
    
    return $data; 
}

function getQuantity($session_id){
    global $connection;
    $data="";
    $query = "SELECT *from order_shopping where session = '$session_id'";
    $result= mysqli_query($connection,$query);
    $data = 0;
    if(mysqli_num_rows($result)){
        while($row= mysqli_fetch_assoc($result)){
            
            $data = $data + $row['quantity'];

        }
    }   
    
    return $data; 
}
function getSocial(){
    global $connection;
    $data="";
    $query = "SELECT *from social order by display_order ASC";
    $result= mysqli_query($connection,$query);
    $data = array();
    if(mysqli_num_rows($result)){
        while($row= mysqli_fetch_assoc($result)){           
             array_push($data, $row);
        }
    }
    else{
        $data= '';
    }   
    
    return $data; 
}

//DATABASE
function insert($table, $data, $exclude = array()) {
    global $connection;
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "`$key`";
            // print_r($data[$key]) ; die;
            $values[] = "'" . mysqli_real_escape_string($connection,$data[$key]) . "'";
        }
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    $query = "INSERT INTO `$table` ($fields) VALUES ($values)";
    $result= mysqli_query($connection,$query);
    if($result) {
        return array( "mysqli_error" => false,
                      "mysqli_insert_id" => mysqli_insert_id($connection),
                      "mysqli_affected_rows" => mysqli_affected_rows($connection),
                      "mysqli_info" => mysqli_info($connection)
                    );
    } else {
        return array( "mysqli_error" => mysqli_error($connection) );
    }
}
// UPDATE DATA
function update($table, $data, $id_field, $id_value) {
    global $connection;
    foreach ($data as $field=>$value) {
        $fields[] = sprintf("`%s` = '%s'", $field, mysqli_real_escape_string($connection,$value));
    }
    $field_list = join(',', $fields);
    
    $query = sprintf("UPDATE `%s` SET %s WHERE `%s` = %s", $table, $field_list, $id_field, intval($id_value));
    // die($query);
    $result= mysqli_query($connection,$query);
    if($result) {
        return array( "mysqli_error" => false,
                      "mysqli_affected_rows" => mysqli_affected_rows($connection),
                      "mysqli_info" => mysqli_info($connection)
                    );
    } else {
        return array( "mysqli_error" => mysqli_error($connection) );
    }
}
?>