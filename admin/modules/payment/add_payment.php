
<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addPayment'])){
    $data['name'] = $_POST['name'];
    $data['description'] = $_POST['description'];
    
   
    $query = "select *from languages";
    $select_lang = mysqli_query($connection,$query);
      while($row_l = mysqli_fetch_assoc($select_lang)){
        $data['lang'] = $row_l['name'];
        $res_desc=insert('payment_method',$data,'addPayment'); 
        if( $res_desc['mysqli_error'] ) {
          echo "Query Failed: " . $result['mysqli_error'];
          die;
        }
        else{
          header("Location: ./payment.php");
        }
      } 
   
}


?>
   <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>THÊM PHƯƠNG THỨC THANH TOÁN</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Tên phương thức thanh toán</label>
          <input name="name" type="text" class="form-control">
          
        </div>
       
        
        <div style="margin-left: 10px;" class="form-group">
          <label for="inputPassword4">Nội dung</label>
          <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""></textarea>

        </div>

        
      <input type="submit" name="addPayment" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->