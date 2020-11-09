<?php
function getMenuSubView($lang,$pos,$pid,$padding){
    global $connection;
    $padding = $padding + 30; 
    $query = "SELECT *from menu m, menu_desc md where m.id =md.m_id and parentid = $pid and pos ='$pos' and lang ='".$lang."' order by display_order ASC";
    $menu='';
    $select_menu= mysqli_query($connection,$query);
    $count_rows = mysqli_num_rows($select_menu);
    if($count_rows != 0){
       
        
         
        while($row = mysqli_fetch_assoc($select_menu)){
           
           
            $title=$row['title'];
            $id= $row['m_id'];
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
            $onclick = "'modules/menu/menu.php?act=update&id=".$id."'";
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
                            <a rel="'.$id.'" href="javascript:void(0)"" class="delete_link" class="btn btn-danger btn-link btn-icon btn-sm">
                                <i class="tim-icons icon-simple-remove"></i>
                            </a>
                        </td>
                 </tr>
                 ';
           
            
            $menu .= getMenuSubView($lang,$pos,$id,$padding);

      
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
function getListMenuView($lang,$pos){
    global $connection;
    $query = "SELECT *from menu m, menu_desc md where m.id =md.m_id and parentid = 0 and pos ='$pos' and lang ='".$lang."' order by display_order ASC";
    $menu='';
    $select_menu= mysqli_query($connection,$query);
    $count_rows = mysqli_num_rows($select_menu);
    $padding = 0;
    if($count_rows != 0){
        while($row = mysqli_fetch_assoc($select_menu)){
        $title=$row['title'];
        $id= $row['m_id'];
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
        $onclick = "'modules/menu/menu.php?act=update&id=".$id."'";
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
         $menu .= getMenuSubView($lang,$pos,$id,$padding);

     }
     

    }
    else{
        $menu ='';
    }
    return $menu;


}
function getMenuSub($lang,$pid,$p_check,$padding){
    global $connection;
    $menu_sub ='';
    $padding = $padding."|---"; 
    $query_sub = "SELECT * from menu m, menu_desc md where m.id = md.m_id and lang = '".$lang."' and parentid = $pid order by display_order ASC";
    $select_sub_menu= mysqli_query($connection,$query_sub);
    $count_rows = mysqli_num_rows($select_sub_menu);
    if($count_rows != 0){
        while($row = mysqli_fetch_assoc($select_sub_menu)){
            if ($p_check == $row['m_id']) {
               $selected = 'selected';
            }
            else{
                $selected ='';
            }
            $menu_sub .="<option value='{$row['m_id']}' ".$selected.">".$padding."{$row['title']}";
            $menu_sub .= getMenuSub($lang,$row['m_id'],$selected,$padding);
            $menu_sub .= '</option>';
        }
       
    }
    else{
        $menu_sub='';
    }
    return $menu_sub;
    

}
function getListMenu($lang,$parentid){
    global $connection;
    $data="";
    $query = "SELECT *from menu m, menu_desc md where m.id =md.m_id and lang ='".$lang."' and parentid = 0 order by m.id ASC";
    // die($query);
    $result= mysqli_query($connection,$query);
    $padding = "";
    $data.="<select class='form-control' name='parentid' id='parentidd'>";
    $data .= "<option value=0>ROOT</option>";
    if($result){
        while($row= mysqli_fetch_assoc($result)){
            if ($parentid == $row['m_id']) {
               $selected = 'selected';
            }
            else{
                $selected ='';
            }
            $data .= "<option value='{$row['m_id']}' ".$selected.">{$row['title']}</option>";
            $data .= getMenuSub($lang,$row['m_id'],$parentid,$padding);
            $data .= '</option>';
        }
    }   
    $data.="</select>";

    return $data;

}
function getPosMenu($pos){
    $arr_pos = array('main' => 'Menu Chính','quick' => 'Menu Link Nhanh');
    $menu = '<select class="form-control" name="pos" id="pos">';
        foreach ($arr_pos as $key => $value) {
            if($pos==$key){
              $selected_pos = 'selected';
            }
            else{
              $selected_pos = '';
            }
            $menu .= ' <option value="'.$key.'" '.$selected_pos.'>'.$value.'</option>';
        }
                    
     $menu .= '</select>';
     return $menu;     
}


?>