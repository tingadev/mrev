

<!-- ADD TO DATABASE -->
<?php 
if(isset($_GET['id']))
  global $connection;
  $edit_id = $_GET['id'];
  $query = "SELECT *from payment_method where id = $edit_id and lang ='".$lang."'";
  $select = mysqli_query($connection,$query);
  if(mysqli_num_rows($select)){
    while ($row = mysqli_fetch_assoc($select)) {
        $info = $row;
    }
  }

  
?>
<?php

if(isset($_POST['updatePayment'])){
    $data['name'] = $_POST['name'];  
    $data['description'] = $_POST['description'];
    $res = update('payment_method',$data,"lang` ='".$lang."' and `id",$edit_id);
    if($res['mysqli_error']){
      echo "Query Failed: " . $res['mysqli_error'];
    }
    else{
      header("Location: ./payment.php");
    }   
}


?>
    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>UPDATE PHƯƠNG THỨC THANH TOÁN</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Tên phương thức thanh toán</label>
          <input name="name" type="text" class="form-control" value="<?php echo $info['name']; ?>">
          
        </div>
        
        
        <div style="margin-left: 10px;" class="form-group">
          <label for="inputPassword4">Nội dung</label>
          <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""><?php echo $info['description']; ?></textarea>

        </div>

      <input type="submit" name="updatePayment" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->
 
