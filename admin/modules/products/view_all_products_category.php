
<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
            if(isset($_POST['update'])){
                global $connection;
                foreach ($_POST['displayArray'] as $key => $value) {
                    if($key == $postValueId){
                        $query="UPDATE products_cat set display_order = {$value} where id={$key} ";
                        $update_post_status = mysqli_query($connection,$query);
                    }        
                }
                foreach ($_POST['focusArray'] as $key => $value) {
                    if($key == $postValueId){
                        $query_f="UPDATE products_cat set focus_main = {$value} where id={$key} ";
                        $update_post_status_f = mysqli_query($connection,$query_f);
                    }        
                }
                foreach ($_POST['catArray'] as $key => $value) {
                    if($key == $postValueId){
                        $query_f="UPDATE products_cat set cat_id = {$value} where id={$key} ";
                        $update_post_status_f = mysqli_query($connection,$query_f);
                    }        
                }
            }
               
            
           if(isset($_POST['delete'])){
                global $connection;
                $query="DELETE FROM products_cat where id={$postValueId}";
                $delete = mysqli_query($connection,$query);
                $query_desc="DELETE FROM products_cat_desc where cat_id={$postValueId}";
                $delete_desc = mysqli_query($connection,$query_desc);
                $query_delete_deo="DELETE FROM seo_url where itemid={$postValueId} and modules = '{$modules}' and action = '{$mod}'";
                $delete_deo = mysqli_query($connection,$query_delete_deo);
           }
                
           if(isset($_POST['show'])){
                 global $connection;
                $query="UPDATE products_cat set display = 1 where id={$postValueId} ";
                $update_display = mysqli_query($connection,$query);   
           }
           if(isset($_POST['hide'])){
                 global $connection;
                $query="UPDATE products_cat set display = 0 where id={$postValueId} ";
                $update_display = mysqli_query($connection,$query);   
           }
       }
                
   }
   
   if(isset($_POST['search'])){
    
    $keywords = $_POST['keywords'];
    // echo $search_pos; die;
    
    if($keywords){
        $where .= " AND title like '%".$keywords."%'";
    }
   }

 
?>



<!-- CONTENT -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h3>QUẢN LÝ DANH MỤC SẢN PHẨM</h3>
                <form action="" method="post">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Nhập tên danh mục cần tìm...">
                        <input type="submit" name="search" class="btn btn-success" value="Search">
                    </div>
                    <div class="col-xs-6">
                            <input type="submit" name="update" class="btn btn-success" value="Update">
                            <input type="submit" name="hide" class="btn btn-success" value="Ẩn">
                            <input type="submit" name="show" class="btn btn-success" value="Hiện">
                            <input type="submit" name="delete" class="btn btn-success" value="Xoá">
                            <a href="modules/products/products.php?mod=category&act=add" class="btn btn-primary">Add New</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Display Order</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                echo getListCatView($lang);
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
<?php

if(isset($_GET['delete']))
{
    $delete_id = $_GET['delete'];
    if($_SESSION['role'] == 'admin')
      {
        $query = "DELETE FROM products_cat WHERE id = $delete_id";
        $delete_query = mysqli_query($connection,$query);
        if($delete_query){
            $query_desc="DELETE FROM products_cat_desc where cat_id={$delete_id}";
                $delete_desc = mysqli_query($connection,$query_desc);
                $query_delete_deo="DELETE FROM seo_url where itemid={$delete_id} and modules = '{$modules}' and action = '{$mod}'";
                // die($query_delete_deo);
                $delete_deo = mysqli_query($connection,$query_delete_deo);
        }        
        header("Location: ./products.php?mod=category");
      }
}
?>                  
         
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/products/products.php?mod=category&delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>
