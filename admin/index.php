
<?php include "_layout/admin_header.php"; ?>

<?php
  
   if($_SESSION['role']=='admin' && $_SESSION['success']=="ok"){
       
    }
    else{
       // die("ok");
        header("Location: ../login.php");
        
    }


 ?>

   <?php
   global $connection;
   $query_count = "SELECT * from order_sum where order_id != 0 and new = 0 order by order_id DESC";
      // die($query);
  $count_new= mysqli_num_rows(mysqli_query($connection,$query_count));
   $query = "SELECT * from order_sum where order_id != 0 order by new ASC, order_id DESC limit 0, 8";
      // die($query);
    $data = array();
      $select= mysqli_query($connection,$query);
      while($row = mysqli_fetch_assoc($select)){
        $info = $row;
          $info['customer'] = '<b>Họ tên:</b> '.$row['d_name'].'<br>';
          $info['customer'].= '<b>Email:</b> '.$row['d_email'].'<br>';
          $info['customer'].= '<b>SĐT:</b> '.$row['d_phone'].'<br>';
          $info['customer'].= '<b>Ngày đặt hàng:</b> '.date('d-m-Y H:i:s', $row['date_order']).'<br>';                               
          
          if($row['new']==0){
            $info['new'] = '(NEW)';
          }
          else{
            $info['new'] = '';
          }
          
          array_push($data, $info);
        }
   ?>
      <!-- End Navbar -->
      <div class="content">
        
        <div class="row">
          <div class="col-md-12">
            <div class="card card-tasks">
              <div class="card-header ">
                <h6 class="title d-inline">New Order(<?php echo $count_new; ?>)</h6>
                
                
              </div>
              <div class="card-body ">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                    <?php
                    foreach ($data as $key => $value) {
                      ?>
      
                        <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="checkBoxArray[]" value="<?php echo $value['order_id']; ?>">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title"><?php echo $value['order_code']; ?> <span style="font-weight: 100; color: red;"><?php echo $value['new']; ?></span></p>
                          <p class="text-muted"><a href="modules/order/order.php?act=update&id=<?php echo $value['order_id']; ?>" style="color: white;"><?php echo $value['customer']; ?></a></p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" onclick="location.href ='modules/order/order.php?act=update&id=<?php echo $value['order_id']; ?>'" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>

                      <?php
                    }
                    ?>
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>

     <!-- <script src="../3-js/scripts.js"></script> -->
  
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
<?php include "_layout/admin_footer.php"; ?>