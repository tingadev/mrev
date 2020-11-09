<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
  include "functions_menu.php";
?>
<?php 

if(isset($_GET['act'])){

    $act= $_GET['act'];
    
}
else{
    $act= '';
                            
}
switch($act){

        case'add';
            include ROOT_MOD."/add_menu.php";
            break;

        case'update';
            include ROOT_MOD."/update_menu.php";
            break;

        default:
            include ROOT_MOD."/view_all_menu.php";
            break;
    }
?>


   
</div>
</div>


    <!-- CONTENT -->


<?php   include "../../_layout/admin_footer.php"; ?>