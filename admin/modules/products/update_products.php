    
<!-- ADD TO DATABASE -->

<?php
  if(isset($_GET['id'])){
    $edit_id = $_GET['id'];
    $query = "SELECT *from products n, products_desc nd where n.id =nd.p_id and p_id = $edit_id and lang ='".$lang."'";
    $select_query = mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($select_query)){
      $item = $row;
    }
  }
  $id_seo = getIDSEO($item['link'],$lang);
  $src_img = $item['picture'];
  $src_img_thumb = $item['thumb'];
?>

<?php

if(isset($_POST['updateProduct'])){

  global $connection ;

  $data_desc['title']=$_POST['title'];
  $title=$_POST['title'];
  $data['cat_id']=$_POST['parentid'];
  // die($data['cat_id']);
  $data['size'] =implode(",", $_POST['sizeArray']);
  $data['color'] =implode(",", $_POST['colorArray']);
  $data['sen'] =implode(",", $_POST['senArray']);
  $link_check=makeUrl($_POST['title']);
  $data_desc['description'] = $_POST['description'];
  $data_desc['short_desc'] = $_POST['short_desc'];
  $data_desc['price'] = $_POST['price'];
  $data_desc['stock'] = $_POST['stock'];
  $data_desc['meta_key'] = $_POST['meta_key'];
  $data_desc['meta_desc'] = $_POST['meta_desc'];
  $photo_up= $_FILES['photo']['name'];
  $data_desc['picture'] = $_FILES['photo']['name'];
  $photo_up_temp=$_FILES['photo']['tmp_name'];
  if($photo_up=="" || empty($photo_up)){
      $photo_up=$src_img;
      $data_desc['picture'] = $src_img;

      $flg=1;
  }
  if($flg==0){
    move_uploaded_file($photo_up_temp,ROOT_SRC."/uploads/products/$photo_up");
    $info= pathinfo($photo_up);
    $file_name =  basename($photo_up,'.'.$info['extension']);
    $thumb_up= $file_name . "thumb." . strtolower($info['extension']);
    make_thumb(ROOT_SRC."/uploads/products/$photo_up",ROOT_SRC."/uploads/products/thumb/$thumb_up",700);
    $data_desc['thumb'] = $thumb_up;

  }
  if($_POST['title']==$item['title']){  
  }
  else{
    // die("ok");
    $title_seo = checkTitleSEO($link_check,$lang);
    $seo_url['url'] = $data_desc['link'] = $link_check;
     
     // die($seo_url['url']);
      if($title_seo==false){

        $date_now = date("Y-m-d H:i:s");
        $seo_url['url'] = $data_desc['link'] = makeUrl($_POST['title'])."-".strtotime($date_now);
        

      }
      $res_seo=update('seo_url',$seo_url,"lang` ='".$lang."' and modules = '".$modules."' and action ='".$mod."' and `itemid",$edit_id);
  }  
  
    $res = update('products',$data,'id',$edit_id);
    
    $result = update('products_desc',$data_desc,"lang` ='".$lang."' and `p_id",$edit_id);  
    if( $res['mysqli_error'] ) {
          echo "Query Failed: " . $res['mysqli_error'];
    }
    //UPDATE OPTIONS
    foreach ($_POST['optionsArray'] as $key => $value) {

      $query_check_op = "SELECT *from products_options_value where op_id = '{$key}' and p_id ='{$edit_id}' and lang = '{$lang}'";
      // die($query_check_op);
      if(mysqli_num_rows(mysqli_query($connection,$query_check_op))){
        $query_op_up="UPDATE products_options_value set option_value ='{$value}' where lang ='".$lang."' and op_id = '{$key}' and p_id ='".$edit_id."'";
        // die($query_op_in);
        $edit_op = mysqli_query($connection,$query_op_up);
      }
      else{
        $query_op_in="INSERT into products_options_value(p_id,op_id,option_value,lang) values('{$edit_id}','{$key}','{$value}','{$lang}')";
          $insert_op = mysqli_query($connection,$query_op_in);
      }
      
       
    }
    //UPDATE IMAGES
    
    if(isset($_POST['img'])){
      $img = $_POST['img'];
      $sql ='';
      foreach ($img as $value) {
        // echo $p_id_img; die;
        $sql = "INSERT INTO product_images(picture,p_id,lang) values('{$value}','{$edit_id}','{$lang}')";
        $res_img = mysqli_query($connection,$sql);
      }
    }
    
      
        header("Location: ./products.php?mod=products");    
    
}


?>
  <!-- ADD TO DATABASE -->
<!-- CONTENT -->

<div class="content">
  <h3>UPDATE SẢN PHẨM</h3>
 <form action='' method="post" enctype="multipart/form-data" target="_self">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" class="btn-primary btn" href="#home">Home</a></li>
    <li><a data-toggle="tab" class="btn-primary btn" href="#menu1">Thông số kỹ thuật</a></li>
    <li><a data-toggle="tab" class="btn-primary btn" href="#menu3">Thông số răng</a></li>
     <li><a data-toggle="tab" class="btn-primary btn" href="#menu5">Thông số sên</a></li>
    <li><a data-toggle="tab" class="btn-primary btn" href="#menu4">Màu sắc</a></li>
    <li><a data-toggle="tab" class="btn-primary btn" href="#menu2">Hình ảnh</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active show">
     <div class="card">
      <div class="card-body">
        <div id="buklOptionsContainer" class="col-md-6 form-group">
          <label for="">Chọn danh mục </label>           
            <?php

              echo getListCat($lang,$item['cat_id']);
               // die($item['cat_id']);
            ?>                                  
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="" value="<?php echo $item['title']; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Link</label>
          <input type="text" class="form-control" name="link" id="title" placeholder="" value="<?php echo $item['link']; ?>" disabled>
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Short Desc</label>
          <textarea type="text" class="form-control" name="short_desc" placeholder=""><?php echo $item['short_desc']; ?></textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Price</label>
          <input type="text" class="form-control" name="price" id="price" placeholder="" value="<?php echo $item['price']; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Stock</label>
          <input type="text" class="form-control" name="stock" id="stock" placeholder="" value="<?php echo $item['stock']; ?>">
        </div>
        <div style="margin-left: 10px;"  class="form-group custom-file col-md-6">

          <input name="photo" type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label"  for="customFile">Picture</label>
        </div>
        <div class="form-group col-md-4">
         <img id="blah" src="../uploads/products/thumb/<?php echo $item['thumb']; ?>">
       </div>

    <div class="form-group">
      <label for="inputPassword4">Content</label>
      <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""><?php echo $item['description']; ?></textarea>

    </div>
    <h3>SEO</h3>
        <div class="form-group">
          <label for="inputEmail4">Meta Keywords</label>
          <textarea type="text" class="form-control" name="meta_key" placeholder="" ><?php echo $item['meta_key']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="inputEmail4">Meta Description</label>
          <textarea type="text" class="form-control" name="meta_desc" placeholder="" ><?php echo $item['meta_desc']; ?></textarea>
        </div>


  </div>
</div>
</div>
<div id="menu1" class="tab-pane fade in">
     <div class="card">
      <div class="card-body">
        <?php
        global $connection;
          
          $query_op = "SELECT * from product_option p, product_option_desc pd where p.op_id = pd.op_id and display =1 and lang ='".$lang."' order by op_order ASC";
          $select_op = mysqli_query($connection,$query_op);
          if($select_op){
            while($row = mysqli_fetch_assoc($select_op)){
               $title_op = $row['op_name'];
               $id_op =$row['op_id'];
               $id_up = $row['id'];
               $query_value = "SELECT * from products_options_value v, product_option o where v.op_id=o.op_id and display= 1 and p_id = $edit_id and v.op_id = $id_op and lang ='".$lang."' order by op_order ASC";
               // die($query_value);
               $select_op_value = mysqli_query($connection,$query_value);
               if($select_op_value){
                if($row_op_v = mysqli_fetch_assoc($select_op_value)){
                  $value_op=$row_op_v['option_value'];
                }
               }
               ?>
              <div class="form-group col-md-6">
                <label for="inputEmail4"><?php echo $title_op ?></label>
                <input type="text" class="form-control" name="optionsArray[<?php echo $id_op; ?>]" placeholder="" value="<?php echo $value_op; ?>">
              </div>

             <?php
            }
          }
        ?>
        
       
  </div>
</div>
</div>
<div id="menu3" class="tab-pane fade in">
  <div class="card">
    <div class="card-body">
      <div class="form-row">
        <?php
      global $connection;
        $size_arr = explode(',', $item['size']);
        $query_op = "SELECT * from size_table";
        // die($query_op);
        $select_op = mysqli_query($connection,$query_op);
        if($select_op){
          while($row = mysqli_fetch_assoc($select_op)){
             $name = $row['name'];
             $id =$row['id'];
             if(in_array($name, $size_arr)){
              $checked = 'checked';
             }
             else{
              $checked = '';
             }
             ?>
            <div class="form-group col-md-1">
              <label for="inputEmail4"><?php echo $name ?></label>
              <input class="checkBoxes" type='checkbox' name="sizeArray[]" value="<?php echo $name; ?>" <?php echo $checked; ?>>
            </div>

           <?php
          }
        }
      ?>
      </div>
    </div>
  </div>
</div>
<div id="menu5" class="tab-pane fade in">
  <div class="card">
    <div class="card-body">
      <div class="form-row">
        <?php
      global $connection;
        $sen_arr = explode(',', $item['sen']);
        $query_op = "SELECT * from sen_table";
        // die($query_op);
        $select_op = mysqli_query($connection,$query_op);
        if($select_op){
          while($row = mysqli_fetch_assoc($select_op)){
             $name = $row['name'];
             $id =$row['id'];
             if(in_array($name, $sen_arr)){
              $checked = 'checked';
             }
             else{
              $checked = '';
             }
             ?>
            <div class="form-group col-md-1">
              <label for="inputEmail4"><?php echo $name ?></label>
              <input class="checkBoxes" type='checkbox' name="senArray[]" value="<?php echo $name; ?>" <?php echo $checked; ?>>
            </div>

           <?php
          }
        }
      ?>
      </div>
    </div>
  </div>
</div>
<div id="menu4" class="tab-pane fade in">
     <div class="card">
      <div class="card-body">
        <div class="form-row">
          <?php
        global $connection;
          $color_arr = explode(',', $item['color']);
          $query_op = "SELECT * from color_table";
          // die($query_op);
          $select_op = mysqli_query($connection,$query_op);
          if($select_op){
            while($row = mysqli_fetch_assoc($select_op)){
               $name = $row['name'];
               $id =$row['id'];
               $code = $row['code'];
               if(in_array($code, $color_arr)){
                $checked = 'checked';
               }
               else{
                $checked = '';
               }
               ?>
              <div class="form-group col-md-1">
                <label for="inputEmail4"><?php echo $name ?></label>
                <div class="box_color" style="width: 25px; height: 25px; background: #<?php echo $code;?>"></div>
                <input class="checkBoxes" type='checkbox' name="colorArray[]" value="<?php echo $code; ?>" <?php echo $checked; ?>>
              </div>

             <?php
            }
          }
        ?>
        </div>

        
        
       
  </div>
</div>
</div>
<div id="menu2" class="tab-pane fade">
  <script>
  function load_ajax(){
      var form_data = new FormData();
                    var ins = document.getElementById('images_array').files.length;
                    for (var x = 0; x < ins; x++) {
                        form_data.append("images[]", document.getElementById('images_array').files[x]);
                    }
                    $('#progress').css('display','block');
                $.ajax({
                  xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $('#progress .bar_progress').css('width',percentComplete);
                                // $('#progress .bar_text').html(percentComplete);
                            }
                       }, false);
                       return xhr;
                    },
                    url : "./includes/upload.php?ajax=upload",            
                    dataType: 'text', // what to expect back from the PHP script
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type : "post",
                    
                    success:function(response){
                       
                        $('#uploadStatus ul').append(response);
                         $('#progress .bar_progress').css('width','100%');
                         $('#progress .bar_text').html('100%');
                         setTimeout(function(){ $('#progress').css('display','none'); $('#progress .bar_progress').css('width','0%');
                         $('#progress .bar_text').html('0%'); }, 1500);

                    },
                    error:function(response){
                        $('#uploadStatus ul').append('Images upload failed, please try again.');
                    }
                });
            }
  function delele_img($this,$id,$lang){
      // 
      var mydata =  "id="+$id+"&lang="+$lang;
      $.ajax({
              dataType: 'html',
              url : "./includes/upload.php?ajax=del_img",  
              type: 'POST',
              data: mydata ,
              success:function(response){
                  $($this).parent().remove();
              },
              error:function(response){
                  $('#uploadStatus ul').append(response);
              }
             });
  }

</script>
<div class="box-img col-md-6 ">
  <p>Maximum : 8 images</p>
  <div class="form-control">

    <label>Choose Images</label>
    <input type="file" name="images[]" id="images_array" multiple >
    <input type="button" onclick="load_ajax();" name="submit" value="UPLOAD"/>
  </div>
</div>

    
<div id="progress">
    <div class="bar_progress"></div>
     <div class="bar_text"></div>
</div>

<!-- display upload status -->
<div id="uploadStatus">
  <ul>
  <?php
  global $connection;
    $query = "SELECT *from product_images where p_id =$edit_id and lang ='".$lang."'";
    $select_img_up = mysqli_query($connection,$query);
    $count_rows = mysqli_num_rows($select_img_up);
    if($count_rows){
      while($row_img = mysqli_fetch_assoc($select_img_up)){
        $src_img_up = $row_img['picture'];
        $id_img_up = $row_img['id'];
        ?>

         <li>
          <img src="../uploads/products/<?php echo $src_img_up; ?>" alt="">
          <input type="hidden" name="img_up[]" value="<?php echo $src_img_up; ?>">
          <div class="close_img" onclick="delele_img(this,<?php echo $id_img_up; ?>,'<?php echo $lang ?>');"></div>
        </li>

          <?php          
      }
    }


  ?>
  </ul>

</div>

<!-- gallery view of uploaded images --> 
<div class="gallery" id="imagesPreview"></div>
</div>
</div>
<input type="submit" name="updateProduct" class="btn btn-primary" value="Submit">
</form>
</div>
<script>
   var fileName_default = "<?php echo $item['picture']; ?>";
  $("#customFile").siblings(".custom-file-label").addClass("selected").html(fileName_default);
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);


  });

  //demo image before upload
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);

      }

      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $("#customFile").change(function(){
    readURL(this);
  });

</script>
<!-- CONTENT -->



