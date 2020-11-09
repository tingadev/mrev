<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
      

       if(isset($_POST['delete'])){
            global $connection;
            $query_menu="DELETE FROM banner where id={$postValueId}";
            $delete_menu = mysqli_query($connection,$query_menu);
            
        }
        if(isset($_POST['update'])){
            global $connection;
            foreach ($_POST['displayArray'] as $key => $value) {
                if($key == $postValueId){
                    $query="UPDATE banner set display_order = {$value} where id={$key} ";
                    $update_post_status = mysqli_query($connection,$query);
                }        
            }
        }
        if(isset($_POST['show'])){
            global $connection;
            $query="UPDATE banner set display = 1 where id={$postValueId} ";
            $update_display = mysqli_query($connection,$query);  
        }   
        if(isset($_POST['hide'])){
            global $connection;
            $query="UPDATE banner set display = 0 where id={$postValueId} ";
            $update_display = mysqli_query($connection,$query);
        }                       
            
          
      }
   }
   $where ="";
   if(isset($_POST['search'])){
    $search_pos = $_POST['search_pos'];
    // echo $search_pos; die;
    if($search_pos == "all"){
        $where ="";
    }
    else{
        $where = "where pos = '{$search_pos}'";
    }
   
   }

 
?>

<!-- CONTENT -->
      <div class="content">
        <div class="row">
          <div class="col-12">
            <h3>QUẢN LÝ BANNER/LOGO</h3>
            <form action="" method="post">
                <div class="form-group" style="display: flex;">
                        <div id="buklOptionsContainer" class="col-md-6">                
                            <select style="font-size: 16px; margin-top: 0px;padding: 5px 18px 5px 18px;" class="form-control" name="search_pos" id="">
                                <option value="all">Search</option>   
                                <?php
                                global $connection;
                                $pos=array();  
                                $query = "select p.title,b.pos from banner b, position p where b.pos = p.pos";
                                $select_banner= mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($select_banner)){
                                    // $pos['pos']=$row['pos'];
                                    // $pos['title']=$row['title'];
                                    array_push($pos, $row);
                                }
                                // var($pos);
                                // die;
                                // $res = array_unique($pos);
                                $res = array_intersect_key($pos, array_unique(array_map('serialize', $pos)));
                                // print_r($pos); die;
                                foreach ($res as $value ) {
                                    echo "<option value='".$value['pos']."'>".$value['title']."</option>"; 
                                }
                                ?>     

                            </select>                    
                        </div>
          
                        <div class="col-xs-4">
                            <input type="submit" name="search" class="btn btn-success" value="Search">   
                        </div>
                    </div>
                    <div class="form-group" style="display: flex;">
                        <div class="col-xs-6">
                        <input type="submit" name="update" class="btn btn-success" value="Update">
                        <input type="submit" name="hide" class="btn btn-success" value="Ẩn">
                        <input type="submit" name="show" class="btn btn-success" value="Hiện">
                        <input type="submit" name="delete" class="btn btn-success" value="Xoá">
                        <a href="modules/banner/banner.php?act=add" class="btn btn-primary">Add New</a>
                </div>
          
                        
                    </div>
                    
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllBoxes"></th>
                        <th class="text-center">Number</th>
                        <th>Title</th>
                        <th width="20%">Image</th>
                        <th>Display Order</th>
                        <th>POS</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
        <?php

            global $connection;
                
            $query = "select * from banner ".$where." order by display_order ASC, id DESC";
            $select_banner= mysqli_query($connection,$query);
            $i=0;
            while($row = mysqli_fetch_assoc($select_banner)){
                $i++;
                $title=$row['title'];
                $id= $row['id'];
                $src =$row['src'];
                $pos =$row['pos'];
                $display = $row['display'];
                $display_order =$row['display_order'];
                $root = "../uploads/weblink/";
                ?>
                
                
                <tr>
                            <td><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>">
                            <td class='text-center'><?php echo $i; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo "<img style='max-width:200px;' src='$root{$src}'>"; ?></td>
                            <td><input type="text" name="displayArray[<?php echo $id; ?>]" style="width: 40px;" value="<?php echo $display_order; ?>"></td>
                            <td><?php echo $pos; ?></td>
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
                                <button onclick="location.href='./modules/banner/banner.php?act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
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
                $query = "DELETE FROM banner WHERE id = $delete_id";

                $delete_query = mysqli_query($connection,$query);

                confirmQuery($delete_query);

                header("Location: ./banner.php");

              }

            }
        ?>                  
                     
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/banner/banner.php?delete="+ id;
            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>
        

