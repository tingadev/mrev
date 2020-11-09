    
<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addProduct'])){
  
  global $connection ;

  $data_desc['title']=$_POST['title'];
  $title=$_POST['title'];
  $data['cat_id']=$_POST['parentid'];
  $data['cat_list'] = getCatCode($data['cat_id'],$lang);
  $data['size'] =implode(",", $_POST['sizeArray']);
  $data['color'] =implode(",", $_POST['colorArray']);
  $data['sen'] =implode(",", $_POST['senArray']);
  $data_desc['link']=makeUrl($_POST['title']);
  $data_desc['description'] = $_POST['description'];
  $data_desc['short_desc'] = $_POST['short_desc'];
  $data_desc['price'] = $_POST['price'];
  $data_desc['stock'] = $_POST['stock'];
  $data_desc['stock'] = $_POST['stock'];
  $data_desc['meta_key'] = $_POST['meta_key'];
  $data_desc['meta_desc'] = $_POST['meta_desc'];
  $data_desc['date_post'] = strtotime(date("Y-m-d H:i:s"));
  $photo_up= $_FILES['photo']['name'];
  $data_desc['picture'] = $_FILES['photo']['name'];
  $photo_up_temp=$_FILES['photo']['tmp_name'];
  

    
    move_uploaded_file($photo_up_temp,ROOT_SRC."/uploads/products/$photo_up");
    $info= pathinfo($photo_up);
    $file_name =  basename($photo_up,'.'.$info['extension']);
    $thumb_up= $file_name . "thumb." . strtolower($info['extension']);
    make_thumb(ROOT_SRC."/uploads/products/$photo_up",ROOT_SRC."/uploads/products/thumb/$thumb_up",700);
    $data_desc['thumb'] = $thumb_up;

    // SEO URL
    $seo_url['url'] = makeUrl($_POST['title']);
    $seo_url['modules'] = $modules;
    $seo_url['action'] = $mod;
    $title_seo = checkTitleSEO($data_desc['link'],$lang);
    if(!$title_seo){
      $date_now = date("Y-m-d H:i:s");
      $seo_url['url'] = makeUrl($_POST['title'])."-".strtotime($date_now);
      $data_desc['link'] = makeUrl($_POST['title'])."-".strtotime($date_now);
    }

    $res = insert('products',$data,'addProduct');
    if( $res['mysqli_error'] ) {
          echo "Query Failed: " . $res['mysqli_error'];
    } else {
      $data_desc['p_id'] = $res['mysqli_insert_id'];
      $p_id_img = $res['mysqli_insert_id'];
      $seo_url['itemid'] = $res['mysqli_insert_id'];
      
    }
    
    //ADD IMAGES
    $img = $_POST['img'];
    $sql ='';
    

    $query = "select *from languages";
    $select_lang = mysqli_query($connection,$query);
    while($row_l = mysqli_fetch_assoc($select_lang)){
        $data_desc['lang'] = $row_l['name'];
        $seo_url['lang'] = $row_l['name'];
        $res_seo=insert('seo_url',$seo_url,'addProduct');
        $lang_img = $row_l['name'];
        //ADD IMAGES
        foreach ($img as $value) {
          // echo $p_id_img; die;
          $sql = "INSERT INTO product_images(picture,p_id,lang) values('{$value}','{$p_id_img}','{$lang_img}')";
          $res_img = mysqli_query($connection,$sql);
        }
        //ADD OPTIONS
        foreach ($_POST['optionsArray'] as $key => $value) {
          $query_op_in="INSERT into products_options_value(p_id,op_id,option_value,lang) values('{$p_id_img}','{$key}','{$value}','{$lang_img}')";
          $insert_op = mysqli_query($connection,$query_op_in);
           
        }
        $result = insert('products_desc',$data_desc,"addProduct"); 
        if( $result['mysqli_error'] ) {
          echo "Query Failed: " . $result['mysqli_error'];
        } else {   
          header("Location: ./products.php?mod=products");          
        }
    }
}


?>
  <!-- ADD TO DATABASE -->
<!-- CONTENT -->

<div class="content">
  <h3>THÊM SẢN PHẨM</h3>
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
              echo getListCat($lang,0);
            ?>                                  
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Short Desc</label>
          <textarea type="text" class="form-control" name="short_desc" placeholder=""></textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Price</label>
          <input type="text" class="form-control" name="price" id="price" placeholder="">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Stock</label>
          <input type="text" class="form-control" name="stock" id="stock" placeholder="">
        </div>
        <div style="margin-left: 10px;"  class="form-group custom-file col-md-6">

          <input name="photo" type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label"  for="customFile">Picture</label>
        </div>
        <div class="form-group col-md-4">
         <img id="blah" src="">
       </div>

    <div class="form-group">
      <label for="inputPassword4">Content</label>
      <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""></textarea>

    </div>
    <h3>SEO</h3>
        <div class="form-group">
          <label for="inputEmail4">Meta Keywords</label>
          <textarea type="text" class="form-control" name="meta_key" placeholder="" ></textarea>
        </div>
        <div class="form-group">
          <label for="inputEmail4">Meta Description</label>
          <textarea type="text" class="form-control" name="meta_desc" placeholder="" ></textarea>
        </div>


  </div>
</div>
</div>
<div id="menu1" class="tab-pane fade in">
     <div class="card">
      <div class="card-body">
        <?php
        global $connection;
          
          $query_op = "SELECT * from product_option p, product_option_desc pd where p.op_id = pd.op_id and display = 1 and lang ='".$lang."' order by op_order ASC";
          // die($query_op);
          $select_op = mysqli_query($connection,$query_op);
          if($select_op){
            while($row = mysqli_fetch_assoc($select_op)){
               $title_op = $row['op_name'];
               $id_op =$row['op_id'];
               ?>
              <div class="form-group col-md-6">
                <label for="inputEmail4"><?php echo $title_op ?></label>
                <input type="text" class="form-control" name="optionsArray[<?php echo $id_op; ?>]" placeholder="">
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
          
          $query_op = "SELECT * from size_table";
          // die($query_op);
          $select_op = mysqli_query($connection,$query_op);
          if($select_op){
            while($row = mysqli_fetch_assoc($select_op)){
               $name = $row['name'];
               $id =$row['id'];
               ?>
              <div class="form-group col-md-1">
                <label for="inputEmail4"><?php echo $name ?></label>
                <input class="checkBoxes" type='checkbox' name="sizeArray[]" value="<?php echo $name; ?>">
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
          
          $query_op = "SELECT * from color_table";
          // die($query_op);
          $select_op = mysqli_query($connection,$query_op);
          if($select_op){
            while($row = mysqli_fetch_assoc($select_op)){
               $name = $row['name'];
               $id =$row['id'];
               $code = $row['code'];
               ?>
              <div class="form-group col-md-1">
                <label for="inputEmail4"><?php echo $name ?></label>
                <div class="box_color" style="width: 25px; height: 25px; background: #<?php echo $code;?>"></div>
                <input class="checkBoxes" type='checkbox' name="colorArray[]" value="<?php echo $code; ?>">
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
          
          $query_op = "SELECT * from sen_table";
          // die($query_op);
          $select_op = mysqli_query($connection,$query_op);
          if($select_op){
            while($row = mysqli_fetch_assoc($select_op)){
               $name = $row['name'];
               $id =$row['id'];
               ?>
              <div class="form-group col-md-1">
                <label for="inputEmail4"><?php echo $name ?></label>
                <input class="checkBoxes" type='checkbox' name="senArray[]" value="<?php echo $name; ?>">
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
function delele_img($this){
      // 
     $($this).parent().remove();
      
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
  <ul></ul>
</div>

<!-- gallery view of uploaded images --> 
<div class="gallery" id="imagesPreview"></div>
</div>
</div>
<input type="submit" name="addProduct" class="btn btn-primary" value="Submit">
</form>
</div>
<script>
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



