<?php

if(isset($_GET['id'])){
  $edit_id = $_GET['id'];
  global $connection;
  $query = "SELECT * from product_option p, product_option_desc pd where p.op_id = pd.op_id and p.op_id = $edit_id and lang ='".$lang."'";
  $select_op = mysqli_query($connection,$query);
  if($select_op){
    while($row = mysqli_fetch_assoc($select_op)){
      $item = $row;
    }
  }

  
}

?>



<!-- CONTENT -->
<div class="content">
  <div class="card">
    <div class="card-body">
      <h3>UPDATE THÔNG SỐ KỸ THUẬT SẢN PHẨM</h3>
      <form action='' method="post" enctype="multipart/form-data" target="_self">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="" value="<?php echo $item['op_name']; ?>">
        </div>
        <input type="submit" name="editOptions" class="btn btn-primary" value="Submit">
      </form>
    </div>
  </div>
</div>

<!-- CONTENT -->



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['editOptions'])){
    
    $data_desc['op_name'] = $_POST['title'];
    $result = update('product_option_desc',$data_desc,"lang` ='".$lang."' and `op_id",$edit_id); 
    if($result['mysqli_error']){
      echo "Query Failed: " . $result['mysqli_error'];
    }
    else{
      header("Location: ./products.php?mod=options_products");
    }
   
}


?>
<!-- ADD TO DATABASE -->