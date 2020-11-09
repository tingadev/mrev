<?php require_once "_layout/admin_header.php"; ?>


    <!-- CONTENT -->
    <div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
       
        <?php include "_layout/admin_nav.php"; ?>
        
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include "_layout/admin_top.php"; ?>
      <!-- End Navbar -->
<?php 
include "modules/menu/functions.php";
if(isset($_GET['act'])){

    $act= $_GET['act'];
    
}
else{
    $act= '';
                            
}
switch($act){

        case'add';
            include "modules/menu/add_menu.php";
            break;

        case'update';
            include "modules/menu/update_menu.php";
            break;

        default:
            include "modules/menu/view_all_menu.php";
            break;
    }
?>


   
</div>
</div>


    <!-- CONTENT -->


<?php include "_layout/admin_footer.php"; ?>