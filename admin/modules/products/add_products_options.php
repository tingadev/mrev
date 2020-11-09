

    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
     <h3>THÊM THÔNG SỐ KỸ THUẬT SẢN PHẨM</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="">
        </div>       
        
      <input type="submit" name="addOptions" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addOptions'])){
    $data['op_order'] = 0;
    $data_desc['op_name']=$_POST['title'];
    $res = insert('product_option',$data,'addOptions');
    if( $res['mysqli_error'] ) {
          echo "Query Failed: " . $res['mysqli_error'];
    } else {
      $data_desc['op_id'] = $res['mysqli_insert_id'];
      
    }
    $query = "select *from languages";
    $select_lang = mysqli_query($connection,$query);
    while($row_l = mysqli_fetch_assoc($select_lang)){
      $data_desc['lang'] = $row_l['name'];
      $res_desc = insert('product_option_desc',$data_desc,'addOptions');
      if( $res_desc['mysqli_error'] ) {
          echo "Query Failed: " . $res_desc['mysqli_error'];
      } else {
        header("Location: ./products.php?mod=options_products");
      }
    }
    
    
   
}


?>
<!-- ADD TO DATABASE -->