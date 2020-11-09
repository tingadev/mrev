<?php
   if(isset($_POST['checkBoxArray'])){
     
      foreach($_POST['checkBoxArray'] as $postValueId)
      {
      

       if(isset($_POST['delete'])){
            global $connection;
            $query_del="DELETE FROM order_sum where order_id={$postValueId}";
            $delete_del = mysqli_query($connection,$query_del);
            $query_del_de = "DELETE FROM order_detail where order_id={$postValueId}";
            $delete_del_de = mysqli_query($connection,$query_del_de);

            
            
        }
        if(isset($_POST['update'])){
            global $connection;
            foreach ($_POST['statusArray'] as $key => $value) {
                if($key == $postValueId){
                    $query="UPDATE order_sum set status = {$value} where order_id={$key} ";
                    $update_post_status = mysqli_query($connection,$query);
                }        
            }
            foreach ($_POST['billArray'] as $key => $value) {
                if($key == $postValueId){
                    $query_f="UPDATE order_sum set bill = {$value} where order_id={$key} ";
                    // die($query_f);
                    $update_post_status_f = mysqli_query($connection,$query_f);
                }        
            }
            
        }
        
          
      }
   }
   $get= '?';
   $where = '';
   $get_process ='';
   $get_payment = '';
   $get_type_keyword = '';
   $get_keyword = '';
   $search_process = -1;
   $search_payment = -1;
   $type_keyword = -1;
   $keywords = '';
    if(isset($_POST['all'])){
        $where = '';
        $search_payment = -1;
           $search_process = -1;
           $keywords = '';
           $type_keyword = -1;
           // unset($_SESSION['get']);
           $get = '';
           header('Location:./order.php');
            
    }


    if(isset($_GET['search_process'])){
        $search_process = $_GET['search_process'];
        if($search_process==-1){
            $where .='';
            $get .=''; 
            $get_process = 'get_process=-1&'; 
        }
        else{
            $where .= ' and status = '.$search_process;
            $get .= 'search_process='.$search_process.'&';
            $get_process = 'search_process='.$search_process.'&'; 
        }
       

    }
    if(isset($_GET['search_payment'])){
        $search_payment = $_GET['search_payment'];
        if($search_payment==-1){
            $where .='';
            $get .='';
            $get_payment = 'search_payment=-1&'; 
        }
        else{
            $where .= ' and bill = '.$search_payment;
            $get .= 'search_payment='.$search_payment.'&';
            $get_payment = 'search_payment='.$search_payment.'&'; 
        }
        

    }
    if(isset($_GET['keywords'])){
    $keywords = $_GET['keywords'];
    $get .= 'keywords='.$keywords.'&';
    $get_keyword = 'keywords='.$keywords.'&'; 
    
    
   }
   if(isset($_GET['type_keyword'])){
    $type_keyword = $_GET['type_keyword'];
    $get .= 'type_keyword='.$type_keyword.'&';
    $get_type_keyword = 'type_keyword='.$type_keyword.'&'; 
    switch ($type_keyword) {
        case 'order_code':
            $where .= " and order_code = '".$keywords."'";

            break;
        
        case 'd_name':
            $where .= " and d_name like '%".$keywords."%'"; 
            break;

        case 'd_email':
            $where .= " and d_email = '".$keywords."'"; 
            break;

        case 'd_phone':
            $where .= " and d_phone = '".$keywords."'"; 
            break;
        default:
            $where .='';
            $get .='';
            break;
    }
   }
 
?>




<!-- CONTENT -->
<div class="content">
    <h2>QUẢN LÝ HOÁ ĐƠN</h2>
    <div class="row">
        <div class="col-12">
            <form action="" method="post" id='formMain'>
                <div class="form-row" >
                        <input type="hidden" id="payment_t" value="<?php echo $get_payment; ?>">
                        <input type="hidden" id="process_t" value="<?php echo $get_process; ?>">
                        <input type="hidden" id="type_t" value="<?php echo $get_type_keyword; ?>">
                        <input type="hidden" id="keywords_t" value="<?php echo $get_keyword; ?>">
                        <h4 class="col-xl-12">Tìm kiếm</h4>
                        <div class="col-md-4">                
                            <select style="font-size: 16px; margin-top: 8px;" class="form-control" name="search_payment" id="" onchange="changePayment(this.value);">
                                <option value="-1" selected>Tình trạng thanh thoán</option>   
                                <?php echo GetStatusPayment($search_payment); ?>

                            </select>
                        </div>
                        <div class="col-md-4">  
                            <select style="font-size: 16px; margin-top: 8px;" class="form-control" name="search_process" id="" onchange="changeProcess(this.value);">
                                <option value="-1" selected>Tình trạng Xử lý</option>   
                                <?php echo GetStatusProcess($search_process); ?>

                            </select>  
                        </div>
                        <div class="col-md-4">  
                            <select style="font-size: 16px; margin-top: 8px;" class="form-control" name="type_keyword" id="" onchange="changeType(this.value);">
                                <?php echo GetOtherSearch($type_keyword); ?>
                            </select>  
                        </div>
                        <div class="col-md-4">  
                            <input style="font-size: 16px; margin-top: 8px;" type="text" class="form-control" name="keywords" placeholder="Email/Order-Code/Họ tên..." value="<?php echo $keywords; ?>" onchange="changeKeywords(this.value);">
                        </div>                   
                       
          
                        <div class="col-xl-12">
                            <input type="submit" class="btn btn-success" value="Search">   
                            <input type="submit" name='all' class="btn btn-success" value="Xem tất cả">   
                        </div>
                    </div>
                <div class="col-xs-6">
                        <input type="submit" name="update" class="btn btn-success" value="Update">
                        <input type="submit" name="delete" class="btn btn-success" value="Xoá">
                        
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                            <th>ORDER CODE</th>
                            <th>Info</th>
                            <th>Thanh toán</th>
                            <th>Xử lý</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            global $connection;
                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $no_of_records_per_page = 10;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $total_pages_sql = "SELECT * from order_sum where order_id != 0 $where order by order_id DESC";
                            // die($total_pages_sql);
                            $result = mysqli_query($connection,$total_pages_sql);
                            $totals = mysqli_num_rows($result);
                            $total_pages = ceil($totals / $no_of_records_per_page);
                            $query = "SELECT * from order_sum where order_id != 0 $where order by order_id DESC limit $offset, $no_of_records_per_page";
                            // die($query);
                            $select= mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select)){
                                $info = '<b>Họ tên:</b> '.$row['d_name'].'<br>';
                                $info.= '<b>Email:</b> '.$row['d_email'].'<br>';
                                $info.= '<b>SĐT:</b> '.$row['d_phone'].'<br>';
                                $info.= '<b>Ngày đặt hàng:</b> '.date('d-m-Y H:i:s', $row['date_order']).'<br>';                               
                                $order_code = $row['order_code'];
                                $id=$row['order_id'];
                                $bill = $row['bill'];
                                $status = $row['status'];
                                
                                ?>  
                                
                                <tr>
                                    <td width="6%"><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                    <td width="20%"><?php echo $order_code; ?></td>
                                    <td><a style="color: white;" href="modules/order/order.php?act=update&id=<?php echo $id; ?>"><?php echo $info; ?></a></td>
                                    
                                    <td>
                                        <select style="font-size: 16px; margin-top: 8px;" class="form-control" name="billArray[<?php echo $id; ?>]" id="">
                                        <?php echo GetStatusPayment($bill); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select style="font-size: 16px; margin-top: 8px;" class="form-control" name="statusArray[<?php echo $id; ?>]" id="">
                                        <?php echo GetStatusProcess($status); ?>
                                        </select>
                                    </td>
                                    <td class='td-actions text-right'>
                                        
                                        <button onclick="location.href='modules/order/order.php?act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-settings'></i>
                                        </button>
                                        <a rel='<?php echo $id; ?>' href='javascript:void(0)' class='delete_link' class='btn btn-danger btn-link btn-icon btn-sm'>
                                                            <i class='tim-icons icon-simple-remove'></i>
                                                        </a>
                                    </td>
                                 </tr>

                                   

                                  
                           <?php } 

                         ?>
                                   
                                   
                                     

                        
                            
                    </tbody>
                </table>
                <?php

                    if($total_pages > 1){
                        if($get){
                            // $get = $_SESSION['get'];
                        
                        }
                        else{
                            $get = "?";
                        }
                        echo '<nav aria-label="..." style="margin: 0 auto; width: 100%;">
                      <ul class="pagination">
                        ';
                        
                       
                          for($i=1;$i<=$total_pages;$i++){
                            if($pageno == $i){
                                $active = 'active';
                            }
                            else{
                                $active = ''; 
                              
                            }

                            echo "<li class='page-item'><a class='page-link ".$active."' href='modules/order/order.php".$get."pageno=$i'>$i</a></li>";
                            
                          }
                 
                        echo '
                      </ul>
                    </nav>';
                    }
                ?>
            </div>
        </form>

    </div>
</div>

    <!-- CONTENT -->


    <!-- DATABASE -->




          <?php

        if(isset($_GET['delete']))
        {

        $delete_id = $_GET['delete'];
          if($_SESSION['role'] == 'admin')
              {
                global $connection;
                $query_del="DELETE FROM order_sum where order_id=$delete_id";
                $delete_del = mysqli_query($connection,$query_del);
                $query_del_de = "DELETE FROM order_detail where order_id=$delete_id";
                $delete_del_de = mysqli_query($connection,$query_del_de);
                header("Location: ./order.php");

              }

            }
        ?>                  
                     
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/order/order.php?delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>

