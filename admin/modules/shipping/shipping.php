<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
  $modules = 'shipping';
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
    case 'add':
      include ROOT_MOD."/add_shipping.php";
      break;
    case 'update':
      include ROOT_MOD."/update_shipping.php";
      break;
    default:
      include ROOT_MOD."/view_all_shipping.php";
      break;
  }
?>
<!-- CONTENT -->
<?php include "../../_layout/admin_footer.php"; ?>