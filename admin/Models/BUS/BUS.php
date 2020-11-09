<?php  
    
  
// ------------------PRODUCT------------------

    function BUSaddProduct($cat_id,$title,$description,$short_desc,$picture,$price,$stock,$link,$thumb,$focus_main,$focus_order,$display,$display_order,$date_post){
        
       $result = addProduct($cat_id,$title,$description,$short_desc,$picture,$price,$stock,$link,$thumb,$focus_main,$focus_order,$display,$display_order,$date_post);
        return $result;
        
    }
    function BUSdeleteProduct($id){
        
       $result = deleteProduct($id);
        return $result;
        
    }
    function BUSupdateProduct($id,$cat_id,$title,$description,$short_desc,$picture,$price,$stock,$link,$thumb,$focus_main,$focus_order,$display,$display_order,$date_post){

    $result = updateProduct($id,$cat_id,$title,$description,$short_desc,$picture,$price,$stock,$link,$thumb,$focus_main,$focus_order,$display,$display_order,$date_post);
    return $result;

    }
    
    function BUSselectProduct($id){
        
       $result = selectProduct($id);
        return $result;
        
    }
    


    // ------------------PRODUCT------------------


     // ------------------BANNER------------------
    function BUSaddBanner($title,$pic,$display,$sbig,$ssmall){
        
        $result = addBanner($title,$pic,$display,$sbig,$ssmall);
        return $result;
        
    }
    function BUSupdateBanner($id,$title,$pic,$display,$sbig,$ssmall){
        
        $result = updateBanner($id,$title,$pic,$display,$sbig,$ssmall);
        return $result;
        
    }
   function BUSdeleteBanner($id){
       
      $result = deleteBanner($id);
       return $result;
       
   }
   // ------------------BANNER------------------



      // ------------------MENU------------------

    //Add Categories
    function BUSaddMenu($title,$link,$pid,$display_order){
        
        $result = addMenu($title,$link,$pid,$display_order);
        return $result;
        
    }
    function BUSupdateMenu($id,$title,$link,$pid,$display_order){
        
        $result = updateMenu($id,$title,$link,$pid,$display_order);
        return $result;
        
    }
   function BUSdeleteMenu($id){
       
      $result = deleteMenu($id);
       return $result;
       
   }
   // ------------------MENU------------------

// ------------------SERVICES------------------

    function BUSaddService($title,$desc,$content,$img_home,$img_mod,$thumb,$display_order){
        
       $result = addService($title,$desc,$content,$img_home,$img_mod,$thumb,$display_order);
        return $result;
        
    }
    function BUSdeleteService($id){
        
       $result = deleteService($id);
        return $result;
        
    }
    function BUSupdateService($id,$title,$desc,$content,$img_home,$img_mod,$thumb,$display_order){

    $result = updateService($id,$title,$desc,$content,$img_home,$img_mod,$thumb,$display_order);
    return $result;

    }
    
    function BUSselectService($info){
        
       $result = selectService($info);
        return $result;
        
    }
    


    // ------------------SERVICES------------------

    function BUSaddCom($name,$address,$phone,$email,$website,$display_order){
        
       $result = addCom($name,$address,$phone,$email,$website,$display_order);
        return $result;
        
    }
    function BUSdeleteCom($id){
        
       $result = deleteCom($id);
        return $result;
        
    }
    function BUSupdateCom($id,$name,$address,$phone,$email,$website,$display_order){

    $result = updateCom($id,$name,$address,$phone,$email,$website,$display_order);
    return $result;

    }
    
    function BUSselectCom(){
        
       $result = selectCom();
        return $result;
        
    }


        // ------------------ABOUT------------------

    function BUSaddAbout($content,$picture,$thumb){
        
       $result = addAbout($content,$picture,$thumb);
        return $result;
        
    }
    // function BUSdeleteAbout($id){
        
    //    $result = deleteCom($id);
    //     return $result;
        
    // }
    function BUSupdateAbout($id,$content,$picture,$thumb){

    $result = updateAbout($id,$content,$picture,$thumb);
    return $result;

    }
    
    function BUSselectAbout($id){
        
       $result = selectAbout($id);
        return $result;
    }





      // ------------------SOCIAL------------------

    function BUSaddSocial($name,$title,$icon,$link,$display_order){
        
       $result = addSocial($name,$title,$icon,$link,$display_order);
        return $result;
        
    }
    function BUSdeleteSocial($id){
        
       $result = deleteSocial($id);
        return $result;
        
    }
    function BUSupdateSocial($id,$name,$title,$link,$icon,$display_order){

    $result = updateSocial($id,$name,$title,$link,$icon,$display_order);
    return $result;

    }
    
    function BUSselectSocial(){
        
       $result = selectSocial();
        return $result;
        
    }

?>
