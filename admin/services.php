
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

if(isset($_GET['act'])){

    $act= $_GET['act'];
    
}
else{
    $act= '';
                            
}
switch($act){

        case'add';
            include "modules/services/add_services.php";
            break;

        case'update';
            include "modules/services/update_services.php";
            break;

        default:
            include "modules/services/view_all_services.php";
            break;
    }
?>


   
</div>
</div>


    <!-- CONTENT -->


<?php include "_layout/admin_footer.php"; ?>