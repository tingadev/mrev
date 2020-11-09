<?php
    
// ------------------product------------------

    function addProduct($cat_id,$title,$description,$short_desc,$picture,$price,$stock,$link,$thumb,$focus_main,$focus_order,$display,$display_order,$date_post){
      
        global $connection;
        $query = "INSERT INTO product(cat_id,title,description,short_desc,picture,price,stock,link,thumb,focus_main,focus_order,display,display_order,date_post) values('{$cat_id}','{$title}','{$description}','{$short_desc}','{$picture}','{$price}','{$stock}','{$link}','{$thumb}','{$focus_main}','{$focus_order}','{$display}','{$display_order}','{$date_post}')";
        // die($query);
        $add_query= mysqli_query($connection,$query);
        $result = confirmQuery($add_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }

function updateProduct($id,$cat_id,$title,$description,$short_desc,$picture,$price,$stock,$link,$thumb,$focus_main,$focus_order,$display,$display_order,$date_post){
    
         global $connection;
        $query = "UPDATE product SET cat_id = '{$cat_id}', title='{$title}',description='{$description}',short_desc='{$short_desc}',picture='{$picture}',price='{$price}',stock='{$stock}',link='{$link}',thumb='{$thumb}', focus_main='{$focus_main}',focus_order='{$focus_order}',display='{$display}',display_order='{$display_order}',date_post='{$date_post}' WHERE id = '{$id}' ";
        $update_query= mysqli_query($connection,$query);
         $result = confirmQuery($update_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }

    function deleteProduct($id){
         global $connection;
        $query = "DELETE FROM product WHERE id = $id";
        $delete_query= mysqli_query($connection,$query);
        $result = confirmQuery($delete_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }
    
   
    function selectProduct($id){  
        global $connection;
        $product = array();
        $query = "select *FROM product";
        $select_query= mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_query)){
            $product[]=$row;
        }
        return $product;
    }
    // ------------------product------------------


    // ------------------BANNER------------------
    function addBanner($title,$pic,$display,$sbig,$ssmall){
        global $connection;
        $query = "INSERT INTO banner(title,src,display_order,slogan_big,slogan_small) values('{$title}','{$pic}','{$display}','{$sbig}','{$ssmall}')";
        $add_query= mysqli_query($connection,$query);
        $result = confirmQuery($add_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }
    function updateBanner($id,$title,$pic,$display,$sbig,$ssmall){
        global $connection;
        $query = "UPDATE banner set title='{$title}', src='{$pic}',display_order='{$display}',slogan_big='{$sbig}', slogan_small='{$ssmall}' where id = $id";
        $update_query= mysqli_query($connection,$query);
        $result = confirmQuery($update_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }
   function deleteBanner($id){
        global $connection;
       $query = "DELETE FROM banner WHERE id = $id";
       $delete= mysqli_query($connection,$query);
       $result = confirmQuery($delete);
       if($result !== true){
           return false;
       }
       return true;
       
   }
   // ------------------BANNER------------------





    // ------------------MENU------------------
    function addMenu($title,$link,$parentid,$display_order){
        global $connection;
        $query = "INSERT INTO menu(title,link,parentid,display_order) values('{$title}','{$link}','{$parentid}','{$display_order}')";
        $add_query= mysqli_query($connection,$query);
        $result = confirmQuery($add_query);
        
        if($result !== true){
            return false;
        }
        return true;
        
    }
     function updateMenu($id,$title,$link,$parentid,$display_order){
        global $connection;
        $query = "UPDATE menu set title='{$title}', link='{$link}',display_order='{$display_order}',parentid='{$parentid}' where id = $id";
        $update_query= mysqli_query($connection,$query);
        $result = confirmQuery($update_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }
   function deleteMenu($id){
        global $connection;
       $query = "DELETE FROM menu WHERE id = $id";
       $delete= mysqli_query($connection,$query);
       $result = confirmQuery($delete);
       if($result !== true){
           return false;
       }
       return true;
       
   }
// ------------------MENU------------------






       // ------------------SERVICES------------------

    function addService($title,$desc,$content,$img_home,$img_mod,$thumb,$display_order){
      
        global $connection;
        $query = "INSERT INTO services(title,short_desc,content,pic_home,pic_mod,thumb,display_order) values('{$title}','{$desc}','{$content}','{$img_home}','{$img_mod}','{$thumb}','{$display_order}')";
        $add_query= mysqli_query($connection,$query);
        $result = confirmQuery($add_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }

function updateService($id,$title,$desc,$content,$img_home,$img_mod,$thumb,$display_order){
    
         global $connection;
        $query = "UPDATE services SET title='{$title}',short_desc='{$desc}',content='{$content}',pic_home='{$img_home}',pic_mod='{$img_mod}',thumb='{$thumb}',display_order='{$display_order}' WHERE id = '{$id}' ";
        $update_query= mysqli_query($connection,$query);
         $result = confirmQuery($update_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }

    function deleteService($id){
         global $connection;
        $query = "DELETE FROM services WHERE id = $id";
        $delete_query= mysqli_query($connection,$query);
        $result = confirmQuery($delete_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }
    
   
    function selectService($info){  
        global $connection;
        $services = array();
        $query = "select *FROM services";
        $select_query= mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_query)){
            $services[]=$row;
        }
        return $services;
    }
    // ------------------SERVICES------------------



       // ------------------COMPANY------------------

    function addCom($name,$address,$phone,$email,$website,$display_order){
      
        global $connection;
        $query = "INSERT INTO company(name,address,phone,email,website,display_order) values('{$name}','{$address}','{$phone}','{$email}','{$website}','{$display_order}')";
        $add_query= mysqli_query($connection,$query);
        $result = confirmQuery($add_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }

function updateCom($id,$name,$address,$phone,$email,$website,$display_order){
    
         global $connection;
        $query = "UPDATE company SET name='{$name}',address='{$address}',phone='{$phone}',email='{$email}',website='{$website}',display_order='{$display_order}' WHERE id = '{$id}' ";
        $update_query= mysqli_query($connection,$query);
         $result = confirmQuery($update_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }

    function deleteCom($id){
         global $connection;
        $query = "DELETE FROM company WHERE id = $id";
        $delete_query= mysqli_query($connection,$query);
        $result = confirmQuery($delete_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }
    
   
    function selectCom(){  
        global $connection;
        
        $query = "select *FROM company order by display_order ASC limit 0,1";
        $select_query= mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_query)){
            $com=$row;
        }
        return $com;
    }



    // ------------------ABOUT------------------
    function addAbout($content,$picture,$thumb){
      
        global $connection;
        $query = "INSERT INTO about(content,picture,thumb) values('{$content}','{$picture}','{$thumb}')";
        $add_query= mysqli_query($connection,$query);
        $result = confirmQuery($add_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }
    function updateAbout($id,$content,$picture,$thumb){
    
         global $connection;
        $query = "UPDATE about SET content='{$content}',picture='{$picture}',thumb='{$thumb}' WHERE id = '{$id}' ";
        $update_query= mysqli_query($connection,$query);
        $result = confirmQuery($update_query);
        
        
    }

    // function deleteAbout($id){
    //      global $connection;
    //     $query = "DELETE FROM about WHERE id = $id";
    //     $delete_query= mysqli_query($connection,$query);
    //     $result = confirmQuery($delete_query);
    //     if($result !== true){
    //         return false;
    //     }
    //     return true;
        
    // }
    
   
    function selectAbout($id){  
        global $connection;
        
        $query = "select *FROM about where id = $id order by id DESC limit 0,1";
        $select_query= mysqli_query($connection,$query);
        if(mysqli_num_rows($select_query)==0){
            $info['picture']="noimg.jpg";
            $info['content']="";
            $info['id']=0;
        }
        else{
            while($row=mysqli_fetch_assoc($select_query)){
                $info=$row;
            }   
        }
        
        return $info;
    }
    // ------------------SOCIAL------------------


    function addSocial($name,$title,$icon,$link,$display_order){
      
        global $connection;
        $query = "INSERT INTO social(name,title,icon,link,display_order) values('{$name}','{$title}','{$icon}','{$link}','{$display_order}')";
        $add_query= mysqli_query($connection,$query);
        $result = confirmQuery($add_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }

function updateSocial($id,$name,$title,$link,$icon,$display_order){
    
         global $connection;
        $query = "UPDATE social SET name='{$name}',title='{$title}',link='{$link}',icon='{$icon}',display_order='{$display_order}' WHERE id = '{$id}' ";
        $update_query= mysqli_query($connection,$query);
         $result = confirmQuery($update_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }

    function deleteSocial($id){
         global $connection;
        $query = "DELETE FROM social WHERE id = $id";
        $delete_query= mysqli_query($connection,$query);
        $result = confirmQuery($delete_query);
        if($result !== true){
            return false;
        }
        return true;
        
    }
    
   
    function selectSocial(){  
        global $connection;
        $social=array();
        $query = "select *FROM social order by display_order ASC";
        $select_query= mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_query)){
            array_push($social, $row);
            
        }
        return $social;
    }

?>