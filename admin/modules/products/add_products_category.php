

    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>THÊM DANH MỤC SẢN PHẨM</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
         <div class="form-group col-md-6">
          <label for="cat_id">Category</label>
          
            <?php
              $category= getListCat($lang,0);
              echo $category;
            ?>
           
            
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="">
        </div>
        <h3>SEO</h3>
        <div class="form-group">
          <label for="inputEmail4">Meta Keywords</label>
          <textarea type="text" class="form-control" name="meta_key" placeholder="" ></textarea>
        </div>
        <div class="form-group">
          <label for="inputEmail4">Meta Description</label>
          <textarea type="text" class="form-control" name="meta_desc" placeholder="" ></textarea>
        </div>
        
        
        
        
      <input type="submit" name="addCategory" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addCategory'])){

    global $connection;
    $data_desc['title']=$_POST['title'];
    $data_desc['meta_desc']=$_POST['meta_desc'];
    $data_desc['meta_key']=$_POST['meta_key'];
    $data['display_order']=0;
    $data_desc['link'] = makeUrl($_POST['title']);
    $data['parentid'] = $_POST['parentid'];
    // SEO URL
    $seo_url['url'] = makeUrl($_POST['title']);
    $seo_url['modules'] = $modules;
    $seo_url['action'] = $mod;
    $title_seo = checkTitleSEO($data_desc['link'],$lang);
    if(!$title_seo){
      $date_now = date("Y-m-d H:i:s");
      $seo_url['url'] = makeUrl($_POST['title'])."-".strtotime($date_now);
      $data_desc['link'] = makeUrl($_POST['title'])."-".strtotime($date_now);
    }
  
    $res = insert('products_cat',$data,'addCategory');
    if( $res['mysqli_error'] ) {
          echo "Query Failed: " . $res['mysqli_error'];
          die;
    } else {
      $data_desc['cat_id'] = $res['mysqli_insert_id'];
      $seo_url['itemid'] = $res['mysqli_insert_id'];
      $query = "select *from languages";
      $select_lang = mysqli_query($connection,$query);
      while($row_l = mysqli_fetch_assoc($select_lang)){
        $data_desc['lang'] = $row_l['name'];
        $seo_url['lang'] = $row_l['name'];
        $res_desc = insert('products_cat_desc',$data_desc,'addCategory');
        $res_seo=insert('seo_url',$seo_url,'addCategory'); 
      }
      header("Location: ./products.php?mod=category");
    }
}

?>
<!-- ADD TO DATABASE -->