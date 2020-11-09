
<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addShipping'])){
    $data['name'] = $_POST['name'];
    $data['fee'] = $_POST['fee'];
    $data['description'] = $_POST['description'];
    
   

        $res_desc=insert('shipping_fee',$data,'addShipping'); 
        if( $res_desc['mysqli_error'] ) {
          echo "Query Failed: " . $result['mysqli_error'];
          die;
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
    <h3>THÊM SHIPPING FEE</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Tên phương thức shipping</label>
          <input name="name" type="text" class="form-control">
          
        </div>
       
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Giá (USD)</label>
          <input name="fee" type="text" class="form-control">
          
        </div>
        
        <div style="margin-left: 10px;" class="form-group">
          <label for="inputPassword4">Nội dung</label>
          <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""></textarea>

        </div>

        
      <input type="submit" name="addShipping" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->