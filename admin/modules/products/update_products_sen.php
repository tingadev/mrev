<?php

if(isset($_GET['id'])){
  $edit_id = $_GET['id'];
  global $connection;
  $query = "SELECT * from sen_table where id = $edit_id";
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
      <h3>UPDATE THÔNG SỐ SÊN SẢN PHẨM</h3>
      <form action='' method="post" enctype="multipart/form-data" target="_self">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Sến</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $item['name']; ?>">
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
    
    $data_desc['name'] = $_POST['name'];
    $result = update('sen_table',$data_desc,"id",$edit_id); 
    if($result['mysqli_error']){
      echo "Query Failed: " . $result['mysqli_error'];
    }
    else{
      header("Location: ./products.php?mod=sen_products");
    }
   
}


?>
<!-- ADD TO DATABASE -->