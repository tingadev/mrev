<?php
  if($_SERVER['REQUEST_METHOD']){
    
    define('SEO_URL', basename($_SERVER['REQUEST_URI']));
    
  }

  
  if ( strstr(SEO_URL, '?' ) ) {
    $res_url = trim(substr(SEO_URL,0 ,strrpos(SEO_URL, "?")));
   
  } else {
    $res_url = SEO_URL;
  }
  global $connection;
  $query_seo_url = "SELECT * from seo_url where url = '".$res_url."' and lang = '".$lang."'";
  // die($query_seo_url);
  $select_seo_url = mysqli_query($connection,$query_seo_url);
  $count_nums_seo = mysqli_num_rows($select_seo_url);
  $tn_id = '';
  if($count_nums_seo != 0) {
    $ex_modules = 0;
    if($row = mysqli_fetch_assoc($select_seo_url)){
       $modules = $row['modules'];
       $tn_id= $row['itemid'];
       if($row['action']==""){
        $action="";
       }
       else{
        
        $action = "_".$row['action'];
        if($action=='_products'){
          $row['action'] = 'detail';

          $action = "_".$row['action'];
        }
       }
       
    }
  }
  else{
    switch ($res_url) {
      case 'shopping_cart':
        $modules = 'products';
        $ex_modules = 'shopping';
        $action ='_cart';
        break;
        
      case 'shopping_method':
        $modules = 'products';
        $ex_modules = 'shopping';
        $action ='_method';
        break;
      case 'shopping_finished':
        $modules = 'products';
        $ex_modules = 'shopping';
        $action ='_finished';
        break;
      default:
          $ex_modules = 0;
          if($lang == 'vn'){
            switch ($res_url) {
              case 'lien-he':
                $modules = 'contact';
                $action ='';
                break;
              case 'vn':
              
                $modules = 'main';
                $action ='';
                break;

                case '':
                $modules = 'main';
                $action ='';
                break;
              case 'trang-chu':
              
                $modules = 'main';
                $action ='';
                break;
              case 'mrev':
              
                $modules = 'main';
                $action ='';
                break;

              case 'index.html':
             
                $modules = 'main';
                $action ='';
                break;
              case 'index.html?lang=vn':
             
                $modules = 'main';
                $action ='';
                break;

              case 'san-pham':
                $modules = 'products';
                $action ='';
                break;

              default:
              
                header('Location: https://mrevracing.com/404.html',true,301);
                break;
            }
          }
          if($lang == 'en'){
            switch (SEO_URL) {
              case '':
              
                $modules = 'main';
                $action ='';
                break;

              case 'contact':
                $modules = 'contact';
                $action ='';
                break;

              case 'en':
                $modules = 'main';
                $action ='';
                break;

              case 'index.html?lang=en':
                $modules = 'main';
                $action ='';
                break;

              case 'mrev':
                $modules = 'main';
                $action ='';
                break;

              case 'main':
                $modules = 'main';
                $action ='';
                break;

              case 'index.html':
                $modules = 'main';
                $action ='';
                break;

              case 'products':
                $modules = 'products';
                $action ='';
                break;

              default:
              // die(SEO_URL);
                header('Location: https://mrevracing.com/404.html',true,301);
                break;
            }
          }
        break;
    }
    
    
  }

?>