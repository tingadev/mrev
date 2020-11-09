<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
            $bulk_options= $_POST['bulk_options'];

            switch($bulk_options) {
                   
               
                case 'update':
                    global $connection;
                    foreach ($_POST['displayArray'] as $key => $value) {
                        if($key == $postValueId){
                            $query="UPDATE product set display_order = {$value} where id={$key} ";
                            $update_post_status = mysqli_query($connection,$query);
                        }        
                    }
                    break;
                
                case 'delete':
                    global $connection;
                    $query_menu="DELETE FROM menu where id={$postValueId}";
                    $delete_menu = mysqli_query($connection,$query_menu);
                    $query_menu_desc="DELETE FROM menu_desc where m_id={$postValueId}";
                    $delete_menu_desc = mysqli_query($connection,$query_menu_desc);
                    break;

                case 'clone':
                    global $connection;
                    $query = "SELECT * FROM product where id={$postValueId}";
                    $select = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select)){
                        $data = $row;                     
                    }
                    $result = insert("product",$data,"id");
                    if($result['mysqli_error']){
                        echo $result['mysqli_error'];
                    }
                    break;                   
            }
          
      }
   }

 
?>




<!-- CONTENT -->
<div class="content">
    <div class="row">
        <div class="col-12">
            <form action="" method="post">
                <div id="buklOptionsContainer" class="col-md-6">                
                    <select style="font-size: 16px;" class="form-control" name="bulk_options" id="">     
                        <option value="">Select Options</option>     
                        <option value="delete">Delete</option>
                        <option value="update">Update</option>
                        <option value="clone">Duplicate</option>
                    </select>                    
                </div>
                <div class="col-xs-4">
                        <input type="submit" name="submit" class="btn btn-success" value="Apply">
                        <a href="menu.php?act=add" class="btn btn-primary">Add New</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                            <th>ID</th>
                            <th>Title</th>
                            <th max-width="300px">Image</th>
                            <th>Display Order</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            global $connection;
                                
                            $query = "select * from product";
                            $select= mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select)){
                                $title=$row['title'];
                                $short_desc=$row['short_desc'];
                                $thumb =$row['thumb'];
                                $display_order =$row['display_order'];
                                $id=$row['id'];
                                ?>  
                                
                                <tr>
                                    <td><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo "<img style='max-height:70px;' src='../assets/img/{$thumb}'>"; ?></td>
                                    <td><input type="text" name="displayArray[<?php echo $id; ?>]" style="width: 40px;" value="<?php echo $display_order; ?>"></td>
                                   
                                    <td class='td-actions text-right'>
                                        <button type='button' rel='tooltip' class='btn btn-info btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-single-02'></i>
                                        </button>
                                        <button onclick="location.href='./services.php?act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
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


    <!-- DATABASE -->




          <?php

        if(isset($_GET['delete']))
        {

        $delete_id = $_GET['delete'];
          if($_SESSION['role'] == 'admin')
              {
                $query = "DELETE FROM product WHERE id = $delete_id";
                
                $delete_query = mysqli_query($connection,$query);
                if($delete_query){
                    $query_img = "DELETE FROM product_images WHERE p_id = $delete_id";
                    $delete_img = mysqli_query($connection,$query_img);
                }
                

                header("Location: ./product.php");

              }

            }
        ?>                  
                     
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "product.php?delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>

