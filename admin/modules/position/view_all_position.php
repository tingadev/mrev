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
                            $query="UPDATE about set display_order = {$value} where id={$key} ";
                            $update_post_status = mysqli_query($connection,$query);
                        }        
                    }
                    break;
                
                case 'delete':
                    global $connection;
                    $query_menu="DELETE FROM about where id={$postValueId}";
                    $delete_menu = mysqli_query($connection,$query_menu);
                    $query_menu_desc="DELETE FROM menu_desc where m_id={$postValueId}";
                    $delete_menu_desc = mysqli_query($connection,$query_menu_desc);
                    break;

                case 'clone':
                    global $connection;
                    $query = "SELECT * FROM about where id={$postValueId}";
                    $select = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select)){
                        $data = $row;                     
                    }
                    $result = insert("about",$data,"id");
                    if($result['mysqli_error']){
                        echo $result['mysqli_error'];
                    }
                    break;
                case 'show':
                    global $connection;
                            $query="UPDATE about set display = 1 where id={$postValueId} ";
                            $update_display = mysqli_query($connection,$query);                
                    break;
                    case 'hide':
                    global $connection;
                            $query="UPDATE about set display = 0 where id={$postValueId} ";
                            $update_display = mysqli_query($connection,$query);                
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
                    </select>                    
                </div>
                <div class="col-xs-4">
                        <input type="submit" name="submit" class="btn btn-success" value="Apply">
                        <a href="./modules/position/position.php?act=add" class="btn btn-primary">Add New</a>
                    </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                            <th>Number</th>
                            <th>Title</th>
                            <th>POS</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            global $connection;
                                
                            $query = "select * from position";
                            $select= mysqli_query($connection,$query);
                            $i=0;
                            while($row = mysqli_fetch_assoc($select)){
                                $i++;
                                $title =$row['title'];
                                $pos=$row['pos'];
                                $id = $row['id']
                                ?>  
                                
                                <tr>
                                    <td width="5%"><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $pos; ?></td>
                                    <td class='td-actions text-right'>
                                        <button onclick="location.href='modules/position/position.php?act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
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
                $query = "DELETE FROM position WHERE id = $delete_id";               
                $delete_query = mysqli_query($connection,$query);
                header("Location: ./position.php");

              }

            }
        ?>                  
                     
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/about/about.php?delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>

