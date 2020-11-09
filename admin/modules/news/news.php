<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
  include "functions_news.php";
?>
<?php 
if(isset($_GET['mod'])){
    $mod=$_GET['mod'];
    if(isset($_GET['act'])){
        $act= $_GET['act'];
    }
    else{
        $act= '';
    }  
}
else{
    $mod ='';                       
}
  
    if($mod=='news'){
        switch($act){
            case'add';
                include ROOT_MOD."/add_news.php";
                break;

            case'update';
                include ROOT_MOD."/update_news.php";
                break;

            default:
                include ROOT_MOD."/view_all_news.php";
                break;
        }
    }
    else if($mod=='category'){
        switch($act){

            case'add';
                include ROOT_MOD."/add_news_category.php";
                break;

            case'update';
                include ROOT_MOD."/update_news_category.php";
                break;

            default:
                include ROOT_MOD."/view_all_news_category.php";
                break;
        }
    }
    else{
        include ROOT_MOD."/view_all_news.php";
    }


?>

    <!-- CONTENT -->
<?php include "../../_layout/admin_footer.php"; ?>