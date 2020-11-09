<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
      

       if(isset($_POST['delete'])){
            global $connection;
            $query_menu="DELETE FROM shipping_fee where id={$postValueId}";
            $delete_menu = mysqli_query($connection,$query_menu);
            
        }
        if(isset($_POST['update'])){
            global $connection;
            foreach ($_POST['displayArray'] as $key => $value) {
                if($key == $postValueId){
                    $query="UPDATE shipping_fee set display_order = {$value} where id={$key} ";
                    $update_post_status = mysqli_query($connection,$query);
                }        
            }
        }
        if(isset($_POST['show'])){
            global $connection;
            $query="UPDATE shipping_fee set display = 1 where id={$postValueId} ";
            $update_display = mysqli_query($connection,$query);  
        }   
        if(isset($_POST['hide'])){
            global $connection;
            $query="UPDATE shipping_fee set display = 0 where id={$postValueId} ";
            $update_display = mysqli_query($connection,$query);
        }                       
            
          
      }
   }

 
?>




<!-- CONTENT -->
<div class="content">
    <div class="row">
        <div class="col-12">
            <h3>QUẢN LÝ SHIPPING INTERNATIONAL</h3>
            <form action="" method="post">
                <div class="col-xs-6">
                        <input type="submit" name="update" class="btn btn-success" value="Update">
                        <input type="submit" name="hide" class="btn btn-success" value="Ẩn">
                        <input type="submit" name="show" class="btn btn-success" value="Hiện">
                        <input type="submit" name="delete" class="btn btn-success" value="Xoá">
                        <a href="modules/shipping/shipping.php?act=add" class="btn btn-primary">Add New</a>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                            <th>Name</th>
                            <th>Fee</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            global $connection;
                                
                            $query = "SELECT * from shipping_fee";
                            $select= mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select)){
                                $title = $row['name'];                               
                                $display = $row['display'];
                                $id=$row['id'];
                                $fee = $row['fee'];
                                ?>  
                                
                                <tr>
                                    <td width="5%"><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                    
                                    <td><a href="modules/shipping/shipping.php?act=update&id=<?php echo $id; ?>"><?php echo $title; ?></a></td>
                                    <td><?php echo $fee; ?></td>

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
                                        <button onclick="location.href='modules/shipping/shipping.php?act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
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
            </div>
        </form>

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
                $query = "DELETE FROM shipping_fee WHERE id = $delete_id";               
                $delete_query = mysqli_query($connection,$query);

                header("Location: ./shipping.php");

              }

            }
        ?>                  
                     
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/shipping/shipping.php?delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>

