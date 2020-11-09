<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
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
  
    if($mod=='product'){
        switch($act){
            case'add';
                include ROOT_MOD."/add_product.php";
                break;

            case'update';
                include ROOT_MOD."/update_product.php";
                break;

            default:
                include ROOT_MOD."/view_all_product.php";
                break;
        }
    }
    else if($mod=='category'){
        switch($act){

            case'add';
                include ROOT_MOD."/add_product_category.php";
                break;

            case'update';
                include ROOT_MOD."/update_product_category.php";
                break;

            default:
                include ROOT_MOD."/view_all_product_category.php";
                break;
        }
    }
    else{
        include ROOT_MOD."/view_all_product.php";
    }


?>

    <!-- CONTENT -->
<?php include "../../_layout/admin_footer.php"; ?>