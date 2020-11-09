

<!-- ADD TO DATABASE -->
<?php 
if(isset($_GET['id']))
  global $connection;
  $edit_id = $_GET['id'];
  $query = "SELECT *from shipping_fee where id = $edit_id";
  $select = mysqli_query($connection,$query);
  if(mysqli_num_rows($select)){
    while ($row = mysqli_fetch_assoc($select)) {
        $info = $row;
    }
  }

  
?>
<?php

if(isset($_POST['updateShipping'])){
    $data['name'] = $_POST['name']; 
    $data['fee'] = $_POST['fee'];  
    $data['description'] = $_POST['description'];
    $res = update('shipping_fee',$data,"id",$edit_id);
    if($res['mysqli_error']){
      echo "Query Failed: " . $res['mysqli_error'];
    }
    else{
      header("Location: ./shipping.php");
    }   
}


?>
    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>UPDATE SHIPPING FEE</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Tên phương thức shipping</label>
          <input name="name" type="text" class="form-control" value="<?php echo $info['name']; ?>">
          
        </div>

        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Giá (USD)</label>
          <input name="fee" type="text" class="form-control" value="<?php echo $info['fee']; ?>">
          
        </div>
        
        
        <div style="margin-left: 10px;" class="form-group">
          <label for="inputPassword4">Nội dung</label>
          <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""><?php echo $info['description']; ?></textarea>

        </div>

      <input type="submit" name="updateShipping" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->
 
