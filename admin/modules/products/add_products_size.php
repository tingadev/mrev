

    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
     <h3>THÊM SỐ KÍCH CỠ RĂNG</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Size</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="">
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

    $data_desc['name']=$_POST['name'];
    $res = insert('size_table',$data_desc,'addOptions');
    if( $res['mysqli_error'] ) {
          echo "Query Failed: " . $res['mysqli_error'];
    } else {
      header("Location: ./products.php?mod=size_products");
      
    }
    
        
     
    
    
   
}


?>
<!-- ADD TO DATABASE -->