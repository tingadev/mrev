<?php
    session_start();
	include "config.php";
    include "lang/products_config.php";
    
    $session_id = session_id();

	if(isset($_GET['ajax'])){
		$ajax_get = $_GET['ajax'];
		switch ($ajax_get) {
			case 'show_modal':
				get_show_modal();
				break;
			
			case 'getCatSub':
				get_cat_sub();
				break;
			case 'get_list_product':
				getListProduct();
				break;
			case 'get_list_product_more':
				getListProductMore();
				break;
            case 'add_to_cart';
                addToCart();
                break;
            case 'update_cart';
                updateCart();
                break;
            case 'delete_cart';
                deleteCart();
                break;
            case 'option_state';
                get_option_state();
                break;
            case 'option_ward';
                get_option_ward();
                break;
		}
	}
function getQuantity(){
    global $connection,$session_id;
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
function addToCart(){
    global $connection, $session_id;
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $src = $_POST['src'];
    $price = $_POST['price'];
    $link = $_POST['link'];
    $title = $_POST['title'];
    $stock = $_POST['stock'];
    $size = $_POST['size'];
    $sen = $_POST['sen'];
    $color = $_POST['color'];
    $data['ok'] = 0;
    if($price==0){
        $data['ok'] = 2;
    }
    else{
        if($stock >= 1){
            $query_count = "SELECT * from order_shopping where session = '$session_id' and item_id = $id and size = '{$size}' and color = '{$color}' and sen ='{$sen}'";
            $select_count = mysqli_query($connection,$query_count);
            $count = mysqli_num_rows($select_count);
            if($count){
                $query = "UPDATE order_shopping set quantity = quantity + $quantity where item_id = $id and size = '{$size}' and color = '{$color}' and sen ='{$sen}' and session = '$session_id'";
                $update = mysqli_query($connection,$query);
                $data['ok'] = 1;
                $data['totals'] = getQuantity();
            }
            else{
                $query ="INSERT into order_shopping(session,item_id,quantity,title,src,link,price,color,size,sen) values('{$session_id}','{$id}','{$quantity}','{$title}','{$src}','{$link}','{$price}','{$color}','{$size}','{$sen}')";
                // die($query);
                $insert = mysqli_query($connection,$query);
                $data['ok'] = 1;
                $data['totals'] = getQuantity();
            }
        }
    }
    

    
    
    echo json_encode($data);

}
function updateCart(){

    global $connection, $session_id;
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $price = (float)$_POST['price'];
    $lang = $_POST['lang'];
    // $data['ok'] = 0;
    $query_up = "UPDATE order_shopping set quantity = $quantity where session = '$session_id' and id = $id";
    $up_quantity = mysqli_query($connection,$query_up);

    $query = "SELECT *from order_shopping where session ='$session_id'"; 
    // die($query);
        $select = mysqli_query($connection,$query);
        $totals = 0;
        $data['quantity'] = 0;
        if(mysqli_num_rows($select)){
            while($row = mysqli_fetch_assoc($select)){
            
                $price_temp = $row['price'] * $row['quantity'];
                $totals = $totals + $price_temp;
                $quantity = $row['quantity'];
                $data['quantity'] = $data['quantity'] + $quantity;
                
                
            }
            $data['totals'] = number_format($totals, 0, '', '.');
            if($lang =='en'){   
                $data['totals'] = round($totals,2);
            }

        }
    $query_this = "SELECT *from order_shopping where session = '$session_id' and id = $id";
    $select_this = mysqli_query($connection,$query_this);
    if ($row_this = mysqli_fetch_assoc($select_this)) {
        $price_temp = $row_this['price'] * $row_this['quantity'];
        $data['price_this'] =number_format($price_temp, 0, '', '.');
        if($lang =='en'){   
            $data['price_this'] = round($price_temp,2);
        }
    }
    
    echo json_encode($data);

}
function deleteCart(){
    global $connection, $session_id;
    $id = $_POST['id'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $data['ok'] = 0;
    $query = "DELETE from order_shopping where session ='$session_id' and id = $id and size ='{$size}' and color = '{$color}'";
    // die($query);
    $delete = mysqli_query($connection, $query);
    if($delete){
        $data['ok'] = 1;
    }
    echo json_encode($data);
}
function get_show_modal(){
	global $connection;
	$id = $_POST['id'];
	$lang = $_POST['lang'];
	$title = $_POST['title'];
    $order_contact = $_POST['order_contact'];
    $link = $_POST['link'];
    $src_r = $_POST['src'];
    $stock = $_POST['stock'];
	$price = (float)$_POST['price'];
    $unit = 'VND';
    $price_f = number_format($price, 0, '', '.');
    if($lang =='en'){
        $price_f = $price;
        $unit = 'USD';
    }
    $price_f .=" ".$unit;
    if($price==0){
        $price_f = $order_contact;
    }
	$param = $_POST['param'];
	$add_cart = $_POST['add_cart'];
	$buy_now = $_POST['buy_now'];
    $color_title = $_POST['color_title'];
    $size_title = $_POST['size_title'];
    $sen_title = $_POST['sen_title'];
    
    $size =  $_POST['size'];
    $color =  $_POST['color'];
    $sen =  $_POST['sen'];
    if($size){
        $size = explode(',', $size);
    }
    else{
        $size = '';
    }
    if($color){
        $color = explode(',', $color);
    }
    else{
        $color = '';
    }
    if($sen){
        $sen = explode(',', $sen);
    }
    else{
        $sen = '';
    }


	$result = '<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

                        <button class="uk-modal-close-default" type="button" uk-close></button>

                        <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>
                          <div class="uk-position-relative uk-visible-toggle uk-light " tabindex="-1" uk-slideshow>

                            <ul class="uk-slideshow-items">';
	$query_img = 'SELECT *from product_images where p_id = '.$id.' and lang ="'.$lang.'"';
	// die($query_img);
	$select_img = mysqli_query($connection,$query_img);
	if($select_img){
		while($row = mysqli_fetch_assoc($select_img)){
			$src = "./uploads/products/".$row['picture'];
			$result .= '<li><img src="'.$src.'" alt="" uk-cover></li>';
		}
	}
	$result .='</ul>
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
              </div>';
    $arr_op = array();
    $query_op_name = 'SELECT *from product_option p,product_option_desc pd where p.op_id = pd.op_id and display = 1 and lang ="'.$lang.'" order by op_order ASC';
    $select_op_name = mysqli_query($connection,$query_op_name);
	if($select_op_name){
		while($row_op_name = mysqli_fetch_assoc($select_op_name)){
			$id_op =$row_op_name['op_id'];
			$op_name = $row_op_name['op_name'];
			$arr_op[$id_op]= $op_name;
		}
	}
	// print_r($arr_op); die;
	$query_op = 'SELECT *from products_options_value o, product_option p where o.op_id = p.op_id and display=1 and p_id = '.$id.' and lang ="'.$lang.'" order by op_order ASC';
	// die($query_op);
	$select_op = mysqli_query($connection,$query_op);
	if($select_op){
		$result .= '<div class="uk-padding-small product_modal_param">
                        <h3>'.$title.'</h3>
                        <div class="price">
                          '.$price_f.'
                        </div>
                        <div class="param">
                          <h6>'.$param.'</h6>
                          <ul>';
		while($row = mysqli_fetch_assoc($select_op)){
			$value_op = $row['option_value'];
			$id_op_value = $row['op_id'];
            if($value_op == '' || empty($value_op)){

            }
            else{
                $result .='<li><b>'.$arr_op[$id_op_value].'</b>:'.$value_op.'</li>';
            }
			
		}
	}
    //SIZE
    $size_d='';
    if(is_array($size)){
        $size_d .= '<li><b>'.$size_title.'</b>';
        $size_d .= '<select name="size" onchange="getSize(this.value)">';
        $size_d .='<option value="0">'.$size_title.'</option>';
        
            foreach ($size as $key => $value) {
                $size_d.= '<option value="'.$value.'">'.$value.'</option>';
            }

        $size_d .= '</select>';
        $size_d .='<input type="hidden" id="size" value="0"></li>';
    
    }
                                               
    $result .= $size_d;

    //SEN
    $sen_d='';
    if(is_array($sen)){
        $sen_d .= '<li><b>'.$sen_title.'</b>';
        $sen_d .= '<select name="sen" onchange="getSen(this.value)">';
        $sen_d .='<option value="0">'.$sen_title.'</option>';
        
            foreach ($sen as $key => $value) {
                $sen_d.= '<option value="'.$value.'">'.$value.'</option>';
            }

        $sen_d .= '</select>';
        $sen_d .='<input type="hidden" id="sen" value="0"></li>';
    
    }                         
    $result .= $sen_d;

    //COLOR
    $color_d ='';
    if(is_array($color)){
        $color_d .= '<li><b>'.$color_title.'</b><ul class="color_d" style="padding-left:0;">';       
        foreach ($color as $key => $value) {
            global $connection;
                $query = "SELECT name from color_table where code = '{$value}'";
                $select=mysqli_query($connection,$query);
                if($select){
                    while($row = mysqli_fetch_assoc($select)){
                        $title_color = $row['name'];
                    }
                }
            $color_d.= '<li><input type="radio" id="r'.$key.'" name="color_s" value="'.$value.','.$title_color.'" onchange="getColor(this.value);"><div style="background: #'.$value.'; width: 20px; height:20px; margin: 0 auto;"></div><div style="font-size:16px;">'.$title_color.'</div>
            </li>';
        }
        $color_d .='</ul>
                <input type="hidden" id="color" value="0">
                <div class="clear"></div>
            </li>';
    }

    $result .= $color_d;
    $nofly = "do_AddItemCartNoFly('empty',".$id.",'".$title."','".$src_r."','".$link."','".$price."',".$stock.")";
    $add_ref = "do_AddItemCart('empty',".$id.",'".$title."','".$src_r."','".$link."','".$price."',".$stock.")";        
    $result .= '</ul>
                        </div>
                        <div class="box_btn">
                          <a class="uk-button uk-button-default add_cart" href="javascript:0;" onclick="'.$nofly.'">'.$add_cart.'</a>
                          <a href="javascript:0;" class="uk-button uk-button-default color_m" onclick="'.$add_ref.'">'.$buy_now.'</a>
                        </div>

                      </div>
                    </div>

                  </div>';
       echo $result;
}

function get_cat_sub(){
	global $connection;
	$id = $_POST['id'];
	$lang =$_POST['lang'];
    $title_brand = $_POST['title_brand'];


$query = "SELECT *from products_cat n, products_cat_desc nd where n.id = nd.cat_id and parentid = $id and lang = '".$lang."' order by display_order ASC";
// die($query);
$result= mysqli_query($connection,$query);
$selected = "";
$data = '<option value="-1">--- '.$title_brand.' ---</option>';
if(mysqli_num_rows($result)){
    while($row= mysqli_fetch_assoc($result)){
        
        $data .= "<option value='{$row['cat_id']}' $selected>{$row['title']}</option>";

    }
}   
    echo $data;
}
function getListProduct(){

	global $connection;
	$id = $_POST['id'];
	$lang =$_POST['lang'];
    $start = $_POST['step'];
    $end = $_POST['limit'];
    $order_contact = $_POST['order_contact'];
    $color_title = "'".$_POST['color_title']."'";
    $size_title = "'".$_POST['size_title']."'";
    $sen_title = "'".$_POST['sen_title']."'";
	$where = '';
	if($id==-1){
		$where = "";
	}
    else if($id == 87){
        $where = ' and cat_id ='.$id;
    }
    else{
        $cat_code = array();
        
        $query_cat = "SELECT * from products_cat n, products_cat_desc nd where n.id = nd.cat_id and parentid = $id and lang = '".$lang."'";
        // die($query_cat);
        $select_cat_id = mysqli_query($connection,$query_cat);
        if($select_cat_id){
            while($row = mysqli_fetch_assoc($select_cat_id)){
                $cat_id = $row['cat_id'];
                array_push($cat_code, $row['cat_id']);
                
            }
            array_push($cat_code, $itemID);
            $cat_id_all = implode(",", $cat_code);
            
            if($cat_id_all){
                $where = " and FIND_IN_SET(cat_id,'".$cat_id_all."')";
            }
            else{
                $where = ' and cat_id ='.$id;
            }
        }
    }
    if(isset($_POST['keywords'])){
        $where .= ' and title like "%'.$_POST['keywords'].'%"';
    }
    $data['hide'] =0;
    $query_count = "SELECT n.id from products n, products_desc nd where n.id = nd.p_id $where and lang = '".$lang."'";
    // die($query_count);
    $result_count= mysqli_query($connection,$query_count);
    $count_com = mysqli_num_rows($result_count);
$query = "SELECT *from products n, products_desc nd where n.id = nd.p_id $where and lang = '".$lang."' order by display_order ASC, n.id DESC limit $start,$end";
// die($query);
$start = $start + $end; 
$data['step'] = $start;
$result= mysqli_query($connection,$query);
$data['text'] ="";

if(mysqli_num_rows($result)){
    while($row= mysqli_fetch_assoc($result)){
        $id_p = $row['p_id'];
        $title = $row['title'];
        $src = "uploads/products/thumb/".$row['thumb'];
        $link = $lang."/".$row['link'];
        $stock = $row['stock'];
        $unit = $_POST['unit'];
        $color= "'".$row['color']."'";
        $size= "'".$row['size']."'";
        $sen= "'".$row['sen']."'";
        $price_real = $row['price'];
        $price = number_format($row['price'], 0, '', '.')." ".$unit;
        if($lang == 'en'){
            
            $price_real = $row['price'];
            $price =  $row['price']." ".$unit;
            
        }
        if($row['price']==0){
            $price = $order_contact;
        }
        $lang_s = "'".$lang."'";
        $title_s = "'".$title."'";
        $price_s = "'".$price_real."'";
        $link_s = "'".$link."'";
        $src_s= "'".$src."'";
        $param = "'".$_POST['param']."'";
        $add_cart = "'".$_POST['add_cart']."'";
        $buy_now = "'".$_POST['buy_now']."'";

        $fly = "do_AddItemFlyCart('img_fly".$id_p."',".$id_p.",'".$title."','".$src."','".$link."','".$price_real."',".$stock.")";

        $data['text'] .= '<div class="item animated">';
        $data['text'] .= '<div class="product_box">';        
        $data['text'] .='<div class="img">';        
        $data['text'] .='<a class="a_img" href="'.$link.'">';          
        $data['text'] .='<img id="img_fly'.$id_p.'" src="'.$src.'" alt="'.$title.'">';
        $data['text'] .='</a>';
        $data['text'] .='<div class="i_tools">';
        $data['text'] .='<ul>';
        $data['text'] .='<li><a href="'.$link.'"><i class="fal fa-search"></i></a></li>';        
        $data['text'] .='<li onclick="showModal('.$id_p.','.$lang_s.','.$title_s.','.$price_s.','.$param.','.$add_cart.','.$buy_now.','.$link_s.','.$stock.','.$src_s.','.$color.','.$size.','.$sen.','.$color_title.','.$size_title.','.$sen_title.')"><a href="#modal-center'.$id_p.'" uk-toggle><i class="fal fa-eye"></i></a></li>';      
        $data['text'] .='</ul>
                    </div>
                    <div id="modal-center'.$id_p.'" class="uk-modal-container product_mod" uk-modal>  
                    </div>
                  </div>';               
                        
        $data['text'] .='<div class="i_title">
                    <h3><a href="'.$link.'">'.$title.'</a></h3>
                  </div>';              
                  
        $data['text'] .='<div class="i_price">
                   '.$price.'
                  </div>
                </div>
              </div>';          

    }
}   
if($start >= $count_com ){
    $data['hide'] =1;
}
echo json_encode($data);
}
function getListProductMore(){

	global $connection;
	$id = $_POST['id'];
	$lang =$_POST['lang'];
    $order_contact = $_POST['order_contact'];
    $temp_s = $_POST['temp_s'];
    $step_m = $_POST['limit'];
    $color_title = "'".$_POST['color_title']."'";
    $size_title = "'".$_POST['size_title']."'";
    $sen_title = "'".$_POST['sen_title']."'";
    // die($temp_s);
    $step = $_POST['step'];
    $step_f = $_POST['step'];
    $start = $step;

    //DATA FIRST LOAD
    $start_t = $step;
    if($temp_s == $step_m){
        $step = $temp_s;
        $start = $step;    
    } 
	
	$end = $_POST['step_m'];
    
    
	$where = '';
    if($id==-1){
        $where = "";
    }
    else if($id == 87){
        $where = ' and cat_id ='.$id;
    }
    else{
        $cat_code = array();
        
        $query_cat = "SELECT * from products_cat n, products_cat_desc nd where n.id = nd.cat_id and parentid = $id and lang = '".$lang."'";
        // die($query_cat);
        $select_cat_id = mysqli_query($connection,$query_cat);
        if($select_cat_id){
            while($row = mysqli_fetch_assoc($select_cat_id)){
                $cat_id = $row['cat_id'];
                array_push($cat_code, $row['cat_id']);
                
            }
            array_push($cat_code, $itemID);
            $cat_id_all = implode(",", $cat_code);
            if($cat_id_all){
                $where = " and FIND_IN_SET(cat_id,'".$cat_id_all."')";
            }
            else{
                $where = ' and cat_id ='.$id;
            }
        }
    }
   
    if(isset($_POST['keywords'])){
        $where .= ' and title like "%'.$_POST['keywords'].'%"';
    }
    $data['hide'] =0;
    $query_count = "SELECT n.id from products n, products_desc nd where n.id = nd.p_id $where and lang = '".$lang."'";
    // die($query_count);
    $result_count= mysqli_query($connection,$query_count);
    $count_com = mysqli_num_rows($result_count);
   
$query = "SELECT *from products n, products_desc nd where n.id = nd.p_id $where and lang = '".$lang."' order by display_order ASC, n.id DESC limit $start,$end";
// die($query);
$start = $start + $end; 
$data['step'] = $start;
$result= mysqli_query($connection,$query);
$data['text'] ="";
if(mysqli_num_rows($result)){
    while($row= mysqli_fetch_assoc($result)){
        $id_p = $row['p_id'];
        $title = $row['title'];
        $src = "uploads/products/thumb/".$row['thumb'];
        $link = $lang."/".$row['link'];
        $stock = $row['stock'];
        $color= "'".$row['color']."'";
        $size= "'".$row['size']."'";
        $sen= "'".$row['sen']."'";
        $unit = $_POST['unit'];
        $price_real = $row['price'];
        $price = number_format($row['price'], 0, '', '.')." ".$unit;
        if($lang == 'en'){
           
            $price_real = $row['price'];
            $price =  $row['price']." ".$unit;
        }
        if($row['price']==0){
            $price = $order_contact;
        }
        $lang_s = "'".$lang."'";
        $title_s = "'".$title."'";
        $price_s = "'".$price_real."'";
        $link_s = "'".$link."'";
        $src_s= "'".$src."'";
        $param = "'".$_POST['param']."'";
		$add_cart = "'".$_POST['add_cart']."'";
		$buy_now = "'".$_POST['buy_now']."'";

        $fly = "do_AddItemFlyCart('img_fly".$id_p."',".$id_p.",'".$title."','".$src."','".$link."','".$price_real."',".$stock.")";

        $data['text'] .= '<div class="item animated">';
        $data['text'] .= '<div class="product_box">';        
        $data['text'] .='<div class="img">';        
        $data['text'] .='<a class="a_img" href="'.$link.'">';          
        $data['text'] .='<img id ="img_fly'.$id_p.'" src="'.$src.'" alt="'.$title.'">';
        $data['text'] .='</a>';
        $data['text'] .='<div class="i_tools">';
        $data['text'] .='<ul>';
        $data['text'] .='<li><a href="'.$link.'"><i class="fal fa-search"></i></a></li>';        
        $data['text'] .='<li onclick="showModal('.$id_p.','.$lang_s.','.$title_s.','.$price_s.','.$param.','.$add_cart.','.$buy_now.','.$link_s.','.$stock.','.$src_s.','.$color.','.$size.','.$sen.','.$color_title.','.$size_title.','.$sen_title.')"><a href="#modal-center'.$id_p.'" uk-toggle><i class="fal fa-eye"></i></a></li>';              
        $data['text'] .='</ul>
                    </div>
                    <div id="modal-center'.$id_p.'" class="uk-modal-container product_mod" uk-modal>  
                    </div>
                  </div>';               
                        
        $data['text'] .='<div class="i_title">
                    <h3><a href="'.$link.'">'.$title.'</a></h3>
                  </div>';              
                  
        $data['text'] .='<div class="i_price">
                   '.$price.'
                  </div>
                </div>
              </div>';          

    }
}

if($start >= $count_com ){
    $data['hide'] =1;
}
echo json_encode($data);
}

function get_option_state ()
{
  global $connection;
  $textout = "";
  $city = (int)$_POST['city'];
  $name_choice = $_POST['state_name'];

    
  $textout .= "<option value=\"\" selected>" . $name_choice . "</option>";
    
    $sql = "SELECT * FROM iso_states where display=1 and city={$city}  order by s_order ASC , name ASC  ";
    // die($sql) ;
  $result = mysqli_query($connection,$sql);
  if ($num = mysqli_num_rows($result)) 
    {    
    while ($row = mysqli_fetch_assoc($result)) 
        {
            // $selected = ($row['id'] == $did) ? "selected" : "" ;       
            $textout .= "<option value=\"{$row['id']}\"  >" . $row['name']. "</option>";
    }
    }   
   
  echo $textout;
}
function get_option_ward ()
{
  global $connection;
  $textout = "";
  $city = (int)$_POST['city'];
  $state =(int)$_POST['state'];
  $name_choice = $_POST['state_name'];

    
  $textout .= "<option value=\"\" selected>" . $name_choice . "</option>";
    
    $sql = "SELECT * FROM iso_wards where display=1 and city={$city} and state = {$state} order by w_order ASC , name ASC  ";
    // die($sql) ;
  $result = mysqli_query($connection,$sql);
  if ($num = mysqli_num_rows($result)) 
    {    
    while ($row = mysqli_fetch_assoc($result)) 
        {
            // $selected = ($row['id'] == $did) ? "selected" : "" ;       
            $textout .= "<option value=\"{$row['id']}\"  >" . $row['name']. "</option>";
    }
    }   
   
  echo $textout;
}
?>
