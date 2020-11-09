<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
    include "functions_products.php";
    $modules = 'products';
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
  
    if($mod=='products'){
        switch($act){
            case'add';
                include ROOT_MOD."/add_products.php";
                break;

            case'update';
                include ROOT_MOD."/update_products.php";
                break;

            default:
                include ROOT_MOD."/view_all_products.php";
                break;
        }
    }
    else if($mod=='category'){
        switch($act){

            case'add';
                include ROOT_MOD."/add_products_category.php";
                break;

            case'update';
                include ROOT_MOD."/update_products_category.php";
                break;

            default:
                include ROOT_MOD."/view_all_products_category.php";
                break;
        }
    }
    else if($mod=='options_products'){
        switch($act){

            case'add';
                include ROOT_MOD."/add_products_options.php";
                break;

            case'update';
                include ROOT_MOD."/update_products_options.php";
                break;

            default:
                include ROOT_MOD."/view_all_products_options.php";
                break;
        }
    }
    else if($mod=='size_products'){
        switch($act){

            case'add';
                include ROOT_MOD."/add_products_size.php";
                break;

            case'update';
                include ROOT_MOD."/update_products_size.php";
                break;

            default:
                include ROOT_MOD."/view_all_products_size.php";
                break;
        }
    }
    else if($mod=='sen_products'){
        switch($act){

            case'add';
                include ROOT_MOD."/add_products_sen.php";
                break;

            case'update';
                include ROOT_MOD."/update_products_sen.php";
                break;

            default:
                include ROOT_MOD."/view_all_products_sen.php";
                break;
        }
    }
    else if($mod=='color_products'){
        switch($act){

            case'add';
                include ROOT_MOD."/add_products_color.php";
                break;

            case'update';
                include ROOT_MOD."/update_products_color.php";
                break;

            default:
                include ROOT_MOD."/view_all_products_color.php";
                break;
        }
    }
    else if($mod=='lang'){
        include ROOT_MOD."/lang.php";
    }
    else{
        include ROOT_MOD."/view_all_products.php";
    }


?>

    <!-- CONTENT -->
<?php include "../../_layout/admin_footer.php"; ?>