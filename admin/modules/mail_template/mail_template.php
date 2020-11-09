<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
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
      include ROOT_MOD."/mail_template_update.php";
      break;
    default:
      include ROOT_MOD."/view_mail_template.php";
      break;
  }
?>
<!-- CONTENT -->

<?php include "../../_layout/admin_footer.php"; ?>
