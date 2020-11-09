
<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
        if(isset($_POST['delete'])){
            global $connection;
            $query_menu="DELETE FROM product_option where op_id={$postValueId}";
            $delete_menu = mysqli_query($connection,$query_menu);
            $query_menu_desc="DELETE FROM product_option_desc where op_id={$postValueId}";
            $delete_menu_desc = mysqli_query($connection,$query_menu_desc);
        }
        if(isset($_POST['update'])){
            global $connection;
            foreach ($_POST['displayArray'] as $key => $value) {
                if($key == $postValueId){
                    $query="UPDATE product_option set op_order = {$value} where op_id={$key} ";
                    $update_post_status = mysqli_query($connection,$query);
                }        
            }
        }
        if(isset($_POST['show'])){
            global $connection;
            $query="UPDATE product_option set display = 1 where op_id={$postValueId} ";
            $update_display = mysqli_query($connection,$query);  
        }   
        if(isset($_POST['hide'])){
            global $connection;
            $query="UPDATE product_option set display = 0 where op_id={$postValueId} ";
            $update_display = mysqli_query($connection,$query);
        }      
      }
   }
?>

<!-- CONTENT -->
<div class="content">
    <div class="row">
      <div class="col-12">
        <h3>QUẢN LÝ THÔNG SỐ KỸ THUẬT SẢN PHẨM</h3>
        <form action="" method="post">
                
                
                <div class="col-xs-6">
                        <input type="submit" name="update" class="btn btn-success" value="Update">
                        <input type="submit" name="hide" class="btn btn-success" value="Ẩn">
                        <input type="submit" name="show" class="btn btn-success" value="Hiện">
                        <input type="submit" name="delete" class="btn btn-success" value="Xoá">
                        <a href="modules/products/products.php?mod=options_products&act=add" class="btn btn-primary">Add New</a>
                </div>
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllBoxes"></th>
                        <th>Title</th>
                        <th>Display Order</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        global $connection;
                            
                        $query = "SELECT * from product_option p, product_option_desc pd where p.op_id = pd.op_id and lang ='".$lang."'";
                        $select= mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select)){
                            $title=$row['op_name'];
                            $id= $row['op_id'];
                            $display= $row['display'];
                            $display_order = $row['op_order'];
                            ?>
                            
                            <tr>
                                <td><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                
                                <td><?php echo $title; ?></td>
                                
                                <td><input type="text" name="displayArray[<?php echo $id; ?>]" style="width: 40px;" value="<?php echo $display_order; ?>"></td>
                               
                                <td class='td-actions text-right'>
                                    <button type='button' rel='tooltip' class='btn btn-info btn-link btn-icon btn-sm'>
                                        <?php
                                            if($display==1){
                                                echo '<i class="fas fa-eye"></i>';
                                            }
                                            else{
                                                echo '<i class="fas fa-eye-slash"></i>';
                                            }
                                        ?>
                                    </button>
                                    <button onclick="location.href='modules/products/products.php?mod=options_products&act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
                                        <i class='tim-icons icon-settings'></i>
                                    </button>
                                    <a rel='<?php echo $id; ?>' href='javascript:void(0)' class='delete_link' class='btn btn-danger btn-link btn-icon btn-sm'>
                                        <i class='tim-icons icon-simple-remove'></i>
                                    </a>
                                </td>
                             </tr>
                                    
                       <?php } 

                     ?>   
                </tbody>
            </table>
        </form>
        </div>
    </div>
</div>
<!-- CONTENT -->


<!-- DELETE -->
<?php

if(isset($_GET['delete']))
{
    $delete_id = $_GET['delete'];
    if($_SESSION['role'] == 'admin')
      {
        $query = "DELETE FROM product_option WHERE op_id = $delete_id";
        $delete_query = mysqli_query($connection,$query);
        if($delete_query){
            $query_desc = "DELETE FROM product_option_desc WHERE op_id = $delete_id";
            $delete_desc = mysqli_query($connection,$query_desc);
           
        }        
        header("Location: ./products.php?mod=options_products");
      }
}
?>                  
         
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/products/products.php?mod=options_products&delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>

<!-- DELETE -->

