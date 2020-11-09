
<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
        if(isset($_POST['delete'])){
            global $connection;
            $query_menu="DELETE FROM color_table where id={$postValueId}";
            $delete_menu = mysqli_query($connection,$query_menu);
            
        }
        
           
      }
   }
?>

<!-- CONTENT -->
<div class="content">
    <div class="row">
      <div class="col-12">
        <h3>QUẢN LÝ MÀU SẮC</h3>
        <form action="" method="post">
                
                
                <div class="col-xs-6">
                        
                        <input type="submit" name="delete" class="btn btn-success" value="Xoá">
                        <a href="modules/products/products.php?mod=color_products&act=add" class="btn btn-primary">Add New</a>
                </div>
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllBoxes"></th>
                        <th>Name</th>
                        <th>Color</th>
                        
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        global $connection;
                            
                        $query = "SELECT * from color_table";
                        $select= mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select)){
                            $title=$row['name'];
                            $id= $row['id'];
                            $code = $row['code'];
                            
                        
                            ?>
                            
                            <tr>
                                <td><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                
                                <td><?php echo $title; ?></td>
                                <td><div class="box_color" style="background:#<?php echo $code; ?>; width: 30px; height: 30px;"></div></td>
                                
                                <td class='td-actions text-right'>
                                   
                                    <button onclick="location.href='modules/products/products.php?mod=color_products&act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
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
    // die($_SESSION['role'] . "ok!");
    $delete_id = $_GET['delete'];
    if($_SESSION['role'] == 'admin')
      {
        $query = "DELETE FROM color_table WHERE id = {$delete_id}";
        // die($query);
        $delete_query = mysqli_query($connection,$query);
               
        header("Location: ./products.php?mod=color_products");
      }
}
?>                  
         
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/products/products.php?mod=color_products&delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>

<!-- DELETE -->

