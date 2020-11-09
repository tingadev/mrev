<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
  include "function_order.php";
  $modules = 'order';
?>


<!-- CONTENT -->
<?php 

  if(isset($_GET['act'])){
    $act= $_GET['act'];   
  }
  else{
    $act= '';                            
  }
  switch($act){
    
    case 'update':
      include ROOT_MOD."/update_order.php";
      break;
    default:
      include ROOT_MOD."/view_all_order.php";
      break;
  }
?>
<!-- CONTENT -->
<?php include "../../_layout/admin_footer.php"; ?>




