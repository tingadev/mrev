<?php
define('GETLANG', dirname(__FILE__,2));

      $lang ='vn';
      
      
  if (isset($_GET['lang'])){  // check GET trước 

     $lang=$_GET['lang']; 
     $_SESSION['lang']=$lang; 

     // update cart when convert languages
     $id_update_cart = array();
     global $connection;
     $query_select_id_cart = "SELECT item_id from order_shopping where session= '$session_id'";
     // die($query_select_id_cart)
     $select_id_cart = mysqli_query($connection,$query_select_id_cart);
     if($select_id_cart){
        while($row_id_cart = mysqli_fetch_assoc($select_id_cart)){
          array_push($id_update_cart, $row_id_cart['item_id']);
        }
        $id_update_cart = array_intersect_key($id_update_cart, array_unique(array_map('serialize', $id_update_cart)));
        foreach ($id_update_cart as $key => $value) {
          $query_update_cart = "UPDATE order_shopping set price = (SELECT price from products_desc where p_id = $value and lang = '$lang') where item_id = $value";
          $update_price_cart = mysqli_query($connection,$query_update_cart);
        }
     }


  }elseif (isset($_SESSION['lang'])){ 
     $lang=$_SESSION['lang']; 
  }else{ 
     $lang="vn"; // default language 
     $_SESSION['lang']="vn"; 
  }



  if($lang == 'vn'){
  $products_seo = "du-an/"; 
  $news_seo = "tin-tuc/";  
  }
  else{
    $products_seo = "projects/";
    $news_seo = "news/";
  }
       

?>