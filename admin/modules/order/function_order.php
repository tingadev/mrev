<?php
  function GetStatusPayment($bill){

    $arr_payment= array('0' => 'Chưa thanh toán', '1' => 'Đã thanh toán');
    $res = "";
    foreach ($arr_payment as $key => $value) {
        if($bill == $key){
          $selected = 'selected';
        }
        else{
          $selected = '';
        }
        $res .= "<option value='{$key}' $selected>{$value}</option>";

    }
    
    return $res;
  }
  function GetStatusProcess($bill){

    $arr_process= array('0' => 'Chưa xử lý', '1' => 'Đang xử lý', '2' => 'Đã xử lý');
    $res = "";
    foreach ($arr_process as $key => $value) {
        if($bill == $key){
          $selected = 'selected';
        }
        else{
          $selected = '';
        }
        $res .= "<option value='{$key}' $selected>{$value}</option>";

    }
    
    return $res;
  }
  function GetOtherSearch($bill){

    $arr_other= array('-1' => 'Tìm kiếm khác', 'order_code' => 'Order Code', 'd_name' => 'Họ tên', 'd_email' => 'Email', 'd_phone' => 'SĐT');
    $res = "";
    foreach ($arr_other as $key => $value) {
        if($bill == $key){
          $selected = 'selected';
        }
        else{
          $selected = '';
        }
        $res .= "<option value='{$key}' $selected>{$value}</option>";

    }
    
    return $res;
  }
  

?>