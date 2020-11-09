<!-- CONTENT -->
<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
        if(isset($_POST['delete'])){
            global $connection;
            $query_menu="DELETE FROM menu where id={$postValueId}";
            $delete_menu = mysqli_query($connection,$query_menu);
            $query_menu_desc="DELETE FROM menu_desc where m_id={$postValueId}";
            $delete_menu_desc = mysqli_query($connection,$query_menu_desc);
            
        }
        if(isset($_POST['update'])){
            global $connection;
            foreach ($_POST['displayArray'] as $key => $value) {
                if($key == $postValueId){
                    $query="UPDATE menu set display_order = {$value} where id={$key} ";
                    $update_post_status = mysqli_query($connection,$query);
                }        
            }
        }
        if(isset($_POST['show'])){
            global $connection;
            $query="UPDATE menu set display = 1 where id={$postValueId} ";
            $update_display = mysqli_query($connection,$query);  
        }   
        if(isset($_POST['hide'])){
            global $connection;
            $query="UPDATE menu set display = 0 where id={$postValueId} ";
            $update_display = mysqli_query($connection,$query);
        }                       
            
          
      }
          
   
   }

 
?>



    
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h3>QUẢN LÝ MENU</h3>
                <form action="" method="post">
                   <div class="col-xs-6">
                        <input type="submit" name="update" class="btn btn-success" value="Update">
                        <input type="submit" name="hide" class="btn btn-success" value="Ẩn">
                        <input type="submit" name="show" class="btn btn-success" value="Hiện">
                        <input type="submit" name="delete" class="btn btn-success" value="Xoá">
                        <a href="modules/menu/menu.php?act=add" class="btn btn-primary">Add New</a>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" class="btn-red btn active show" href="#main_menu">Menu Chính</a></li>
                    <li><a data-toggle="tab" class="btn-red btn" href="#quick_menu">Menu Link Nhanh</a></li>
                </ul>
                <div class="tab-content">
                    <div id="main_menu" class="tab-pane fade in active show">
                        <h4>Menu Chính</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>                          
                                    <th>Title</th>
                                    <th>Link</th>
                                    
                                    <th>Display Order</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    echo getListMenuView($lang,'main');

                                 ?>   
                            </tbody>
                        </table>
                    </div>
                    <div id="quick_menu" class="tab-pane fade">
                         <h4>Menu Link Nhanh</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>                          
                                    <th>Title</th>
                                    <th>Link</th>
                                    
                                    <th>Display Order</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    echo getListMenuView($lang,'quick');

                                 ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
                
                </form>
            </div>
        </div>
    </div>

    <!-- CONTENT -->




<!-- DATABASE -->




          <?php

        if(isset($_GET['delete']))
        {

        $delete_id = $_GET['delete'];
          if($_SESSION['role'] == 'admin')
              {
                $query = "DELETE FROM menu WHERE id = $delete_id";
                $delete_query = mysqli_query($connection,$query);
                $query_menu_desc="DELETE FROM menu_desc where m_id=$delete_id";
                $delete_menu_desc = mysqli_query($connection,$query_menu_desc);
                confirmQuery($delete_query);

                header("Location: ./menu.php");

              }

            }
        ?>                  
                     
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/menu/menu.php?delete="+ id +"";
            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>
        

