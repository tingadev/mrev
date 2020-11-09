
<?php

function getCatProducts($lang,$cat_id = 0){
	global $connection;
	$data="";
	$query = "SELECT *from products_cat n, products_cat_desc nd where n.id = nd.p_id and lang = '".$lang."' order by n.id ASC";
	// die($query);
	$result= mysqli_query($connection,$query);

	$selected = "";
	if(mysqli_num_rows($result)){
		while($row= mysqli_fetch_assoc($result)){
			if($cat_id == $row['nid']){
				$selected = 'selected';
			}
			else{
				$selected = "";
			}
			$data .= "<option value='{$row['nid']}' $selected>{$row['title']}</option>";

		}
	}	
	

	return $data;

}

function getCatSubView($lang,$pid,$padding){
    global $connection;
    $padding = $padding + 30; 
    $query = "SELECT *from products_cat m, products_cat_desc md where m.id =md.cat_id and parentid = $pid and lang ='".$lang."' order by display_order ASC";
    $menu='';
    $select_menu= mysqli_query($connection,$query);
    $count_rows = mysqli_num_rows($select_menu);
    if($count_rows != 0){
       
        
         
        while($row = mysqli_fetch_assoc($select_menu)){
           
           
            $title=$row['title'];
            $id= $row['cat_id'];
            $link =$row['link'];
            $pid =$row['parentid'];
            $display= $row['display'];
            $display_order = $row['display_order'];
            if($display==1){
                $hide= '<i class="fas fa-eye"></i>';
            }
            else{
                $hide ='<i class="fas fa-eye-slash"></i>';
            }
            $onclick = "'modules/products/products.php?mod=category&act=update&id=".$id."'";
            $menu .= ' 
            <tr>
                <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="'.$id.'"></td>
                        
                        <td style ="padding-left:'.$padding.'px;">|---'.$title.'</td>
                        <td>'.$link.'</td>
                        

                       <td style ="padding-left:'.$padding.'px;"><input type="text" name="displayArray['.$id.']" style="width: 40px;" value="'.$display_order.'"></td>
                       
                        <td class="td-actions text-right">
                            <button type="button" rel="tooltip" class="btn btn-info btn-link btn-icon btn-sm">
                               '.$hide.'
                            </button>
                            <button type="button" onclick="location.href='.$onclick.'" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                                <i class="tim-icons icon-settings"></i>
                            </button>
                            <a rel="'.$id.'" href="javascript:void(0)" class="delete_link" class="btn btn-danger btn-link btn-icon btn-sm">
                                <i class="tim-icons icon-simple-remove"></i>
                            </a>
                        </td>
                 </tr>
                 ';
           
            
            $menu .= getCatSubView($lang,$id,$padding);

      
            // if($i==$count_rows){
            //     $padding = 0; 
                
            //     // die('ok');
            // }
           
           
        }
       
     
    }
    else{
        $menu ='';
    }
    return $menu;
    

}
function getListCatView($lang){
    global $connection;
    $query = "SELECT *from products_cat m, products_cat_desc md where m.id =md.cat_id and parentid = 0 and lang ='".$lang."' order by display_order ASC";
    // die($query);
    $menu='';
    $select_menu= mysqli_query($connection,$query);
    $count_rows = mysqli_num_rows($select_menu);
    $padding = 0;
    if($count_rows != 0){
        while($row = mysqli_fetch_assoc($select_menu)){
        $title=$row['title'];
        $id= $row['cat_id'];
        $link =$row['link'];
        $pid =$row['parentid'];
        $display= $row['display'];
        $display_order = $row['display_order'];
        if($display==1){
            $hide= '<i class="fas fa-eye"></i>';
        }
        else{
            $hide ='<i class="fas fa-eye-slash"></i>';
        }
        $onclick = "'modules/products/products.php?mod=category&act=update&id=".$id."'";
        $menu .= ' 
        <tr>
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="'.$id.'"></td>
                    
                    <td>'.$title.'</td>
                    <td>'.$link.'</td>
                    

                   <td><input type="text" name="displayArray['.$id.']" style="width: 40px;" value="'.$display_order.'"></td>
                   
                    <td class="td-actions text-right">
                        <button type="button" rel="tooltip" class="btn btn-info btn-link btn-icon btn-sm">
                           '.$hide.'
                        </button>
                        <button type="button" onclick="location.href='.$onclick.'" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                            <i class="tim-icons icon-settings"></i>
                        </button>
                        <a rel="'.$id.'" href="javascript:void(0)"" class="delete_link" class="btn btn-danger btn-link btn-icon btn-sm">
                            <i class="tim-icons icon-simple-remove"></i>
                        </a>
                    </td>
             </tr>
             ';
         $menu .= getCatSubView($lang,$id,$padding);

     }
     

    }
    else{
        $menu ='';
    }
    return $menu;


}
function getCatSub($lang,$pid,$p_check,$padding){
    global $connection;
    $menu_sub ='';
    $padding = $padding."|---"; 
    $query_sub = "SELECT * from products_cat m, products_cat_desc md where m.id = md.cat_id and lang = '".$lang."' and parentid = $pid order by display_order ASC";
    $select_sub_menu= mysqli_query($connection,$query_sub);
    $count_rows = mysqli_num_rows($select_sub_menu);
    if($count_rows != 0){
        while($row = mysqli_fetch_assoc($select_sub_menu)){
            if ($p_check == $row['cat_id']) {
               $selected = 'selected';
            }
            else{
                $selected ='';
            }
            $menu_sub .="<option value='{$row['cat_id']}' ".$selected.">".$padding."{$row['title']}";
            $menu_sub .= getCatSub($lang,$row['cat_id'],$selected,$padding);
            $menu_sub .= '</option>';
        }
       
    }
    else{
        $menu_sub='';
    }
    return $menu_sub;
    

}
function getListCat($lang,$parentid){
    global $connection;
    $data="";
    $query = "SELECT *from products_cat m, products_cat_desc md where m.id =md.cat_id and lang ='".$lang."' and parentid = 0 order by m.id ASC";
    // die($query);
    $result= mysqli_query($connection,$query);
    $padding = "";
    $data.="<select class='form-control' name='parentid' id='parentid'>";
    $data .= "<option value=0>ROOT</option>";
    if($result){
        while($row= mysqli_fetch_assoc($result)){
            if ($parentid == $row['cat_id']) {
               $selected = 'selected';
            }
            else{
                $selected ='';
            }
            $data .= "<option value='{$row['cat_id']}' ".$selected.">{$row['title']}</option>";
            $data .= getCatSub($lang,$row['cat_id'],$parentid,$padding);
            $data .= '</option>';
        }
    }   
    $data.="</select>";

    return $data;

}
function getListCat_Search($lang,$parentid){
    global $connection;
    $data="";
    $query = "SELECT *from products_cat m, products_cat_desc md where m.id =md.cat_id and lang ='".$lang."' and parentid = 0 order by m.id ASC";
    // die($query);
    $result= mysqli_query($connection,$query);
    $padding = "";
    
    $data .= "<option value=0>ROOT</option>";
    if($result){
        while($row= mysqli_fetch_assoc($result)){
            if ($parentid == $row['cat_id']) {
               $selected = 'selected';
            }
            else{
                $selected ='';
            }
            $data .= "<option value='{$row['cat_id']}' ".$selected.">{$row['title']}</option>";
            $data .= getCatSub($lang,$row['cat_id'],$parentid,$padding);
            $data .= '</option>';
        }
    }   
    

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
function getCatCode($cat_id,$lang){
    global $connection;
    $query = "SELECT parentid,id from products_cat where id = $cat_id";
    // die($query);
    $result= mysqli_query($connection,$query);
    $cat_code="";
    $arr_cat = loadCat($lang);
    $item = array();
    if($result){
        while($row= mysqli_fetch_assoc($result)){
            if($row['parentid']!=0){
                 $cat_code .= $row['parentid']."_";
            }
            foreach ($arr_cat as $key => $value) {
                if($row['id']==$value['id']){
                    $cat_code .= $value['parentid']."_";
                }
                
            }
        }   
    }   
    $cat_code.=$cat_id;
    return $cat_code;
}
?>