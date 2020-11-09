

<!-- ADD TO DATABASE -->
<?php 
if(isset($_GET['id']))
  global $connection;
  $edit_id = $_GET['id'];
  $query_up_new = "UPDATE order_sum set new = 1 where order_id = $edit_id";
  $up_new = mysqli_query($connection,$query_up_new);
  $query = "SELECT * from order_sum where order_id = $edit_id";
  // die($query);
  $select= mysqli_query($connection,$query);
  if(mysqli_num_rows($select)){
    while ($row = mysqli_fetch_assoc($select)) {
      $info = $row;
      $info['date_order'] = date('d-m-Y H:i:s', $row['date_order']);
        
    }
  }
  
?>
<?php

if(isset($_POST['updateOrder'])){
  unset($_POST['updateOrder']);
    // print_r($_POST); die;
    $res = update('order_sum',$_POST,"order_id",$edit_id);
    if($res['mysqli_error']){
      echo "Query Failed: " . $res['mysqli_error'];
    }
    else{
      header("Location: ./order.php");
    }   
}


?>
    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h1>UPDATE HOÁ ĐƠN</h1>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
        <div class="form-row" >
          <h3 class="col-xl-12">Tình trạng hoá đơn</h3>
          <div class="col-md-4">                
              <select style="font-size: 16px; margin-top: 8px;" class="form-control" name="bill" id="">
                  <option value="-1" selected>Tình trạng thanh thoán</option>   
                  <?php echo GetStatusPayment($info['bill']); ?>

              </select>
          </div>
          <div class="col-md-4">  
              <select style="font-size: 16px; margin-top: 8px;" class="form-control" name="status" id="">
                  <option value="-1" selected>Tình trạng Xử lý</option>   
                  <?php echo GetStatusProcess($info['status']); ?>

              </select>  
          </div>
        </div>

         
          <div class="form-row" style="margin-top: 30px;">
             <h3 class="col-xl-12">THÔNG TIN KHÁCH HÀNG</h3>
             <div class="form-group col-md-6">
            <label for="title">Ngày đặt hàng</label>
            <input name="date_order" type="text" class="form-control" value="<?php echo $info['date_order']; ?>" disabled>
            
          </div>
            <div class="form-group col-md-6">
            <label for="title">Họ tên</label>
            <input name="d_name" type="text" class="form-control" value="<?php echo $info['d_name']; ?>" disabled>
            
          </div>
          <div class="form-group col-md-6">
            <label for="title">Email</label>
            <input name="d_email" type="text" class="form-control" value="<?php echo $info['d_email']; ?>" disabled>
            
          </div>
          <div class="form-group col-md-6">
            <label for="title">SĐT</label>
            <input name="d_phone" type="text" class="form-control" value="<?php echo $info['d_phone']; ?>" disabled>
            
          </div>
          <div class="form-group col-md-6">
            <label for="title">Địa chỉ</label>
            <input name="d_address" type="text" class="form-control" value="<?php echo $info['d_address']; ?>" disabled>
            
          </div>
            <div class="form-group col-md-6">
            <label for="title">Ghi chú của khách hàng</label>
            <textarea class="form-control" name="note" cols="20" disabled=""><?php echo $info['note']; ?></textarea>
            
          </div>
          </div>
            <div class="form-group col-md-6">
            <label for="title">Ghi chú của MREV</label>
            <textarea class="form-control" name="comment" cols="20" ><?php echo $info['comment']; ?></textarea>
            
          </div>
          <h3>THÔNG TIN ĐƠN HÀNG</h3>
       <table class="table">
                    <thead>
                        <tr>
                           
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Số răng</th>
                            <th>Số sên</th>
                            <th>Màu sắc</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            global $connection;
                                
                            $query = "SELECT * from order_detail d, order_sum s where d.order_id = s.order_id and s.order_id =$edit_id";
                            $select= mysqli_query($connection,$query);
                            $total = 0;
                            while($row = mysqli_fetch_assoc($select)){
                                $title = $row['item_title'];
                                $quantity = $row['quantity'];
                                $item_id = $row['item_id'];
                                $color = $row['color'];
                                $color = explode(',', $color);
                                $size = $row['size'];
                                $sen = $row['sen'];
                                $src = '../'.$row['item_picture'];
                                $price = (float)$row['item_price'];
                                $total = $total + ($price * $quantity);
                                $total_t = $price * $quantity;
                                $total_s = number_format($total_t,0,'','.');
                                $unit = 'VND';
                                $total_s = $total_s .' '.$unit;
                                if($row['lang'] == 'en'){
                                  $unit = 'USD';
                                  $total_s = $total_t;
                                  $total_s = $total_s .' '.$unit;
                                }
                                
                                
                                ?>  
                                
                                <tr>
                                    <td width="15%"><?php echo $title; ?></td>
                                    <td><img style='max-height:70px;' src="<?php echo $src; ?>" alt=""></td>
                                     <td><?php echo $size; ?></td>
                                     <td><?php echo $sen; ?></td>
                                    <td><div class="box_color" style="background:#<?php echo $color[0]; ?>; width: 30px; height: 30px;"></div><?php echo $color[1]; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $total_s; ?></td>
                                    
                                    

                                    
                                 </tr>

                                   

                                  
                           <?php } 

                         ?>
                                   <?php
                                   
                                    $total = number_format($total,0,'','.').' '.$unit;
                                    
                                    

                                  ?>
                                  <tr>
                                    <td width="15%">Tổng đơn hàng</td>
                                    <td width="15%"><?php echo $total; ?></td>
                                    
                                    
                                    

                                    
                                 </tr>
                                     

                        
                            
                    </tbody>
                </table>
                <input type="submit" name="updateOrder" class="btn btn-primary" value="Submit">
        </div>

        
      
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->

