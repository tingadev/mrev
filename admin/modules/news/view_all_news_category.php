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
                            $query="UPDATE news_cat set display_order = {$value} where id={$key} ";
                            $update_post_status = mysqli_query($connection,$query);
                        }        
                    }
                    break;
                
                case 'delete':
                    global $connection;
                    $query_menu="DELETE FROM news where id={$postValueId}";
                    $delete_menu = mysqli_query($connection,$query_menu);
                    $query_menu_desc="DELETE FROM menu_desc where m_id={$postValueId}";
                    $delete_menu_desc = mysqli_query($connection,$query_menu_desc);
                    break;

                case 'show':
                    global $connection;
                            $query="UPDATE services set display = 1 where id={$postValueId} ";
                            $update_display = mysqli_query($connection,$query);                
                    break;
                    case 'hide':
                    global $connection;
                            $query="UPDATE services set display = 0 where id={$postValueId} ";
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
                        <option value="clone">Duplicate</option>
                    </select>                    
            </div>
            <div class="col-xs-4">
                    <input type="submit" name="submit" class="btn btn-success" value="Apply">
                    <a href="modules/news/news.php?mod=category&act=add" class="btn btn-primary">Add New</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllBoxes"></th>
                        <th>#</th>
                        <th>Title</th>
                        <th>Link</th>
                        
                        <th>Display Order</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    global $connection;
                        
                    $query = "SELECT * from news_cat n, news_cat_desc nd where n.id = nd.cat_id order by n.display_order ASC";
                    $select= mysqli_query($connection,$query);
                    $i=0;
                    while($row = mysqli_fetch_assoc($select)){
                        
                        $title=$row['title'];
                        $id= $row['cat_id'];
                        $link =$row['link'];
                        $pid =$row['parentid'];
                        $display_order = $row['display_order'];
                        $stt = $i; 
                        $i++;
                        if($pid==0){
                        ?>
                        
                        
                        <tr>
                                    <td><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                    <td><?php echo $stt; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $link; ?></td>
                                    
                                   <td><input type="text" name="displayArray[<?php echo $id; ?>]" style="width: 40px;" value="<?php echo $display_order; ?>"></td>
                                   
                                    <td class='td-actions text-right'>
                                        <button type='button' rel='tooltip' class='btn btn-info btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-single-02'></i>
                                        </button>
                                        <button type='button' onclick="location.href='modules/news/news.php?mod=category&act=update&id=<?php echo $id; ?>'" rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-settings'></i>
                                        </button>
                                        <button type='button' rel='tooltip' class='btn btn-danger btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-simple-remove'></i>
                                        </button>
                                    </td>
                             </tr>

                             <?php 
                             $query_sub = "SELECT * from news_cat n, news_cat_desc nd where n.id = nd.cat_id and parentid != 0 order by n.display_order ASC";
                               
                                $select_sub= mysqli_query($connection,$query_sub);

                                 while($row = mysqli_fetch_assoc($select_sub)){
                                    $pid_sub=$row['parentid'];
                                    $id_sub = $row['cat_id'];
                                    $title_sub=$row['title'];                          
                                    $link_sub =$row['link'];
                                    $display_order_sub=$row['display_order'];
                                    if($id==$pid_sub){
                                        $i_s = $i++;
                                        $i = $i_s++; 
                                        $stt_sub = $i_s;
                                        echo "<tr>
                                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]'' value='{$id_sub}'></td>
                                    <td>{$stt_sub}</td>
                                    <td>----- {$title_sub}</td>
                                    <td>{$link_sub}</td>
                                   
                                   <td><input type='text' name='displayArray[{$id_sub}]' style='width: 40px;' value='{$display_order_sub}'></td>
                                   
                                    <td class='td-actions text-right'>
                                        <button type='button' onclick='location.href='modules/news/news.php?mod=category&act=update&id=$id'' rel='tooltip' class='btn btn-info btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-single-02'></i>
                                        </button>
                                        <button type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-settings'></i>
                                        </button>
                                        <button type='button' rel='tooltip' class='btn btn-danger btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-simple-remove'></i>
                                        </button>
                                    </td>
                                    </tr>";
                                    }
                                    
                                }

                             }  ?>

                        <?php
                           
                           
                         ?>

                    
                   <?php

                    } 

                 ?>
                           
                           
                             

                
                
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

    <!-- CONTENT -->

