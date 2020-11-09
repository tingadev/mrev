
<?php require_once "_layout/admin_header.php"; ?>
    <!-- CONTENT -->
    <div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            CT
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            Creative Tim
          </a>

        </div>
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
            include "modules/company/add_company.php";
            break;

        case'update';
            include "modules/company/update_company.php";
            break;

        default:
            include "modules/company/view_all_company.php";
            break;
    }
?>


   
</div>
</div>


    <!-- CONTENT -->


<?php include "_layout/admin_footer.php"; ?>