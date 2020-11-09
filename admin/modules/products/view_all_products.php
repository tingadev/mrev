
<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
            if(isset($_POST['update'])){
                global $connection;
                foreach ($_POST['displayArray'] as $key => $value) {
                    if($key == $postValueId){
                        $query="UPDATE products set display_order = {$value} where id={$key} ";
                        $update_post_status = mysqli_query($connection,$query);
                    }        
                }
                foreach ($_POST['focusArray'] as $key => $value) {
                    if($key == $postValueId){
                        $query_f="UPDATE products set focus_main = {$value} where id={$key} ";
                        $update_post_status_f = mysqli_query($connection,$query_f);
                    }        
                }
                foreach ($_POST['catArray'] as $key => $value) {
                    if($key == $postValueId){
                        $query_f="UPDATE products set cat_id = {$value} where id={$key} ";
                        $update_post_status_f = mysqli_query($connection,$query_f);
                    }        
                }
            }
               
            
           if(isset($_POST['delete'])){
                global $connection;
                $query = "DELETE FROM products WHERE id = {$postValueId}";
                $delete = mysqli_query($connection,$query);
                $query_menu_desc="DELETE FROM products_desc where p_id={$postValueId}";
                $delete_menu_desc = mysqli_query($connection,$query_menu_desc);
                $query_img = "DELETE FROM product_images WHERE p_id = {$postValueId}";
                $delete_img = mysqli_query($connection,$query_img);
                $query_seo = "DELETE FROM seo_url WHERE itemid = {$postValueId}";
                $delete_seo = mysqli_query($connection,$query_seo);
                $query_op = "DELETE FROM products_options_value WHERE p_id = {$postValueId}";
                $delete_op = mysqli_query($connection,$query_op);
           }
                
           if(isset($_POST['show'])){
                 global $connection;
                $query="UPDATE products set display = 1 where id={$postValueId} ";
                $update_display = mysqli_query($connection,$query);   
           }
           if(isset($_POST['hide'])){
                 global $connection;
                $query="UPDATE products set display = 0 where id={$postValueId} ";
                $update_display = mysqli_query($connection,$query);   
           }
       }
                
   }
   
   $get= '&';
   $where = '';
   
   $get_type_keyword = '';
   $get_keyword = '';
   
   $type_keyword = 0;
   $keywords = '';
    if(isset($_POST['all'])){
        $where = '';
        
           $keywords = '';
           $type_keyword = -1;
           // unset($_SESSION['get']);
           $get = '';
           header('Location:./products.php?mod=products');
            
    }


    if(isset($_GET['keywords'])){
    $keywords = $_GET['keywords'];
    $get .= 'keywords='.$keywords.'&';
    $get_keyword = 'keywords='.$keywords.'&'; 
    $where .= " and title like '%".$keywords."%'";
    
   }
   if(isset($_GET['cat_id'])){
    $type_keyword = $_GET['cat_id'];
    $cat_code = array();
    $query_cat = "SELECT * from products_cat n, products_cat_desc nd where n.id = nd.cat_id and parentid = $type_keyword and lang = '".$lang."'";
        // die($query_cat);
        $select_cat_id = mysqli_query($connection,$query_cat);
        if($select_cat_id){
            while($row = mysqli_fetch_assoc($select_cat_id)){
                $cat_id = $row['cat_id'];
                array_push($cat_code, $row['cat_id']);
                
            }
            array_push($cat_code, $type_keyword);
            $cat_id_all = implode(",", $cat_code);
            
        }
    
    $get .= 'cat_id='.$type_keyword.'&';
    $get_type_keyword = 'cat_id='.$type_keyword.'&'; 
    $where .= " and FIND_IN_SET(cat_id,'".$cat_id_all."')";
   }


 
?>




<!-- CONTENT -->
<div class="content">
    <div class="row">
        <div class="col-12">
            <h3>QUẢN LÝ SẢN PHẨM</h3>
            <form action="" method="post" id="formMain">
                <div class="form-row" >
                        
                        <input type="hidden" id="type_t" value="<?php echo $get_type_keyword; ?>">
                        <input type="hidden" id="keywords_t" value="<?php echo $get_keyword; ?>">
                        <h4 class="col-xl-12">Tìm kiếm</h4>
                        
                        <div class="col-md-4">  
                            <select style="font-size: 16px; margin-top: 8px;" class="form-control" name="cat_id" id="" onchange="changeType_P(this.value);">
                                <?php
                                  echo getListCat_Search($lang,$type_keyword);
                                ?>   
                            </select>  
                        </div>
                        <div class="col-md-4">  
                            <input style="font-size: 16px; margin-top: 8px;" type="text" class="form-control" name="keywords" placeholder="Nhập tên sản phẩm cần tìm..." value="<?php echo $keywords; ?>" onchange="changeKeywords_P(this.value);">
                        </div>                   
                       
          
                        <div class="col-xl-12" style="margin-top: 20px; margin-bottom: 20px;">
                            <input type="submit" class="btn btn-success" value="Search">   
                            <input type="submit" name='all' class="btn btn-success" value="Xem tất cả">   
                        </div>
                    </div>
                <div class="col-xs-6">
                        <input type="submit" name="update" class="btn btn-success" value="Update">
                        <input type="submit" name="hide" class="btn btn-success" value="Ẩn">
                        <input type="submit" name="show" class="btn btn-success" value="Hiện">
                        <input type="submit" name="delete" class="btn btn-success" value="Xoá">
                        <a href="modules/products/products.php?mod=products&act=add" class="btn btn-primary">Add New</a>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>                           
                            <th>Title</th>
                            <th>Link</th>
                            <th max-width="300px">Image</th>
                            <th>Display Order</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            global $connection;
                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $no_of_records_per_page = 15;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $total_pages_sql = "SELECT n.id from products n, products_desc nd where n.id = nd.p_id $where and lang = '".$lang."' order by display_order ASC, p_id DESC";
                            // die($total_pages_sql);
                            $result = mysqli_query($connection,$total_pages_sql);
                            $totals = mysqli_num_rows($result);
                            $total_pages = ceil($totals / $no_of_records_per_page);
                            // die($total_pages);
                            $query = "SELECT n.id,n.cat_id,n.display,n.focus_main,n.display_order,nd.title,nd.thumb,nd.link,nd.date_post from products n, products_desc nd where n.id = nd.p_id $where and lang = '".$lang."' order by display_order ASC, p_id DESC limit $offset, $no_of_records_per_page";
                            // die($query);
                            $select= mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select)){
                                $title=$row['title'];
                                $title.= '<br><b>Ngày đăng bài:</b> '.date('d-m-Y', $row['date_post']);  
                                $thumb = $row['thumb'];
                                $display = $row['display'];
                                $link = $row['link']; 
                                $n_cat_id = $row['cat_id'];   
                                $focus = $row['focus_main'];                     
                                $display_order =$row['display_order'];
                                $id=$row['id'];
                                ?>  
                                
                                <tr>
                                    <td><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                    
                                    <td><?php echo $title; ?></td>

                                    <td><?php echo $link; ?></td>
                                    <td><?php echo "<img style='max-height:70px;' src='../uploads/products/thumb/{$thumb}'>"; ?></td>
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
                                        <button onclick="location.href='modules/products/products.php?mod=products&act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
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
                <?php

                    if($total_pages > 1){
                        if($get){
                           
                        
                        }
                        else{
                            $get = "?";
                        }
                        echo '<nav aria-label="..." style="margin: 0 auto; width: 100%;">
                      <ul class="pagination">
                        ';
                        
                       
                          for($i=1;$i<=$total_pages;$i++){
                            if($pageno == $i){
                                $active = 'active';
                            }
                            else{
                                $active = ''; 
                              
                            }

                            echo "<li class='page-item'><a class='page-link ".$active."' href='modules/products/products.php?mod=products".$get."pageno=$i'>$i</a></li>";
                            
                          }
                 
                        echo '
                      </ul>
                    </nav>';
                    }
                ?>
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
        $query = "DELETE FROM products WHERE id = $delete_id";
        $delete_query = mysqli_query($connection,$query);
        if($delete_query){
            $query = "DELETE FROM products WHERE id = $delete_id";
            $delete = mysqli_query($connection,$query);
            $query_desc = "DELETE FROM products_desc WHERE p_id = $delete_id";
            $delete_desc = mysqli_query($connection,$query_desc);
            $query_img = "DELETE FROM product_images WHERE p_id = $delete_id";
            $delete_img = mysqli_query($connection,$query_img);
            $query_seo = "DELETE FROM seo_url WHERE itemid = $delete_id";
            $delete_seo = mysqli_query($connection,$query_seo);
            $query_op = "DELETE FROM products_options_value WHERE p_id = $delete_id'";
            $delete_op = mysqli_query($connection,$query_op);
        }        
        header("Location: ./products.php?mod=products");
      }
}
?>                  
         
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/products/products.php?mod=products&delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>

