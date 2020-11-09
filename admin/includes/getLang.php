<?php
// define('GETLANG', dirname(__FILE__,2));
    $lang ='vn';
    session_start();
    
    if (isset($_GET['lang'])){  // check GET trước 

       $lang=$_GET['lang']; 
       $_SESSION['lang_ad']=$lang;

     

    }elseif (isset($_SESSION['lang_ad'])){ 

       $lang=$_SESSION['lang_ad']; 

    }else{ 

       $lang="vn"; // default language 
       $_SESSION['lang_ad']="vn"; 

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