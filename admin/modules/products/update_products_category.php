<?php 
if(isset($_GET['id']))
  global $connection;
  $edit_id = $_GET['id'];
  $query = "SELECT *from products_cat a, products_cat_desc ad where a.id = ad.cat_id and a.id = $edit_id and lang ='".$lang."'";
  $select = mysqli_query($connection,$query);
  if(mysqli_num_rows($select)){
    while ($row = mysqli_fetch_assoc($select)) {
        $info = $row;
    }
  }


  
  
?>

<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['updateCategory'])){

    global $connection;
    $data_desc['title']=$_POST['title'];
    $data_desc['meta_desc']=$_POST['meta_desc'];
    $data_desc['meta_key']=$_POST['meta_key'];
    $data['parentid'] = $_POST['parentid'];
    // SEO URL
    // die($data['parentid']);
    // $seo_url['url'] = makeUrl($_POST['title']);
    $link_check = makeUrl($_POST['title']);
    $seo_url['modules'] = $modules;
    $seo_url['action'] = $mod;
    $title_seo = checkTitleSEO($data_desc['link'],$lang);
    if($_POST['title']==$info['title']){  
       // header("Location: ./products.php?mod=category");
    }
    else{
      $title_seo = checkTitleSEO($link_check,$lang);
        if($title_seo==false){
          $date_now = date("Y-m-d H:i:s");
          $seo_url['url'] = $data_desc['link'] = makeUrl($_POST['title'])."-".strtotime($date_now);

        }
    }
  
    $res = update('products_cat',$data,"id",$edit_id);
    $res_desc = update('products_cat_desc',$data_desc,"lang` ='".$lang."' and `cat_id",$edit_id);
    $res_seo=update('seo_url',$seo_url,"lang` ='".$lang."' and modules = '".$modules."' and action ='".$mod."' and `itemid",$edit_id); 
    
    header("Location: ./products.php?mod=category");
    
}

?>
<!-- ADD TO DATABASE -->
    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>CẬP NHẬT DANH MỤC SẢN PHẨM</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
         <div class="form-group col-md-6">
          <label for="cat_id">Category</label>
          
            <?php
              $category= getListCat($lang,$info['parentid']);
              echo $category;
            ?>
           
            
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="" value="<?php echo $info['title']; ?>">
        </div>
        <h3>SEO</h3>
        <div class="form-group">
          <label for="inputEmail4">Meta Keywords</label>
          <textarea type="text" class="form-control" name="meta_key" placeholder="" ><?php echo $info['meta_key']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="inputEmail4">Meta Description</label>
          <textarea type="text" class="form-control" name="meta_desc" placeholder="" ><?php echo $info['meta_desc']; ?></textarea>
        </div>
        
        
        
      <input type="submit" name="updateCategory" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->



