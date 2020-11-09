<?php include "includes/admin_header.php"; ?>
<?php include "includes/functions.php"; ?>

    <div id="wrapper">

       
       
       
        <!-- Navigation -->
        
        
        
        
        <?php include "includes/admin_nav.php"; ?>
        
        
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin!
                            <small>Author</small>
                        </h1>
                       <?php 
                        
                        if(isset($_GET['type'])){
                            
                            $type= $_GET['type'];
                             switch($type){
                                
                            case'tintucthietke';
                                include "includes/view_all_news.php";
								
                                break;
                                
                            
                                
                           
                                
                        }
                            
                            
                        }
						if(isset($_GET['act'])){
							$act= $_GET['act'];
							
							 switch($act){
								case'update';
								include "includes/update_news.php";
								break;
							}
                        
						}
                       
                       
                       
                        ?>
                       
                       
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
</div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>