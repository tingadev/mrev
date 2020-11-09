

<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
?>


<!-- CONTENT -->
<?php 
include "functions.php";
if(isset($_GET['act'])){
    $act= $_GET['act'];   
}
else{
    $act= '';                            
}
switch($act){
    case 'add':
      include ROOT_MOD."/add_banner.php";
      break;
    case 'update':
      include ROOT_MOD."/update_banner.php";
      break;
    default:
      include ROOT_MOD."/view_all_banner.php";
      break;
}
?>
<!-- CONTENT -->
<?php include "../../_layout/admin_footer.php"; ?>