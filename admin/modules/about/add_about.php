
<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addAbout'])){
    $data['display'] = 1;
    $data['display_order'] = 0;
    $_POST['link'] = makeUrl($_POST['title']);

    $photo_up= $_FILES['photo']['name'];
    $_POST['photo'] = $_FILES['photo']['name'];
    $photo_up_temp=$_FILES['photo']['tmp_name'];

    move_uploaded_file($photo_up_temp,ROOT_SRC."/uploads/about/$photo_up");
    $info= pathinfo($photo_up);
    $file_name =  basename($photo_up,'.'.$info['extension']);
    $thumb_up= $file_name . "thumb." . strtolower($info['extension']);
    make_thumb(ROOT_SRC."/uploads/about/$photo_up",ROOT_SRC."/uploads/about/$thumb_up",700);
    $_POST['thumb'] =$thumb_up;
    // SEO URL
    $seo_url['url'] = makeUrl($_POST['title']);
    $seo_url['modules'] = $modules;
    $title_seo = checkTitleSEO($_POST['link'],$lang);
    if(!$title_seo){
      $date_now = date("Y-m-d H:i:s");
      $seo_url['url'] = makeUrl($_POST['title'])."-".strtotime($date_now);
      $_POST['link'] = makeUrl($_POST['title'])."-".strtotime($date_now);
    }


    //ABOUT
    $res=insert('about',$data,'addAbout');
    $query = "select *from languages";
    $select_lang = mysqli_query($connection,$query);
      while($row_l = mysqli_fetch_assoc($select_lang)){
        $_POST['lang'] = $row_l['name'];
        
        if($res['mysqli_insert_id']) {
        $_POST['aid'] = $res['mysqli_insert_id'];
        $seo_url['itemid'] = $_POST['aid'];
        // ABOUT DESC
        $seo_url['lang'] = $row_l['name'];
        $res_desc=insert('about_desc',$_POST,'addAbout'); 
        $res_seo=insert('seo_url',$seo_url,'addAbout'); 
        if( $res_seo['mysqli_error'] ) {
          echo "Query Failed: " . $res_seo['mysqli_error'];
          die;
        }
        if( $res_desc['mysqli_error'] ) {
          echo "Query Failed: " . $result['mysqli_error'];
          die;
        }
        else{
          header("Location: ./about.php");
        }
      }
    }
    
    
    
    
   
}


?>
   <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>THÊM GIỚI THIỆU</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Tên bài viết</label>
          <input name="title" type="text" class="form-control">
          
        </div>
        
          <div style="margin-left: 10px;"  class="form-group">
          <label for="title">Mô tả ngắn</label>
          <textarea class="form-control" name="mota" id="mota" cols="20"></textarea>
          
        </div>

        <div style="margin-left: 10px;"  class="form-group custom-file col-md-6">

          <input name="photo" type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label"  for="customFile">Picture</label>
        </div>
        <div class="form-group col-md-4">
         <img id="blah" src="">
       </div>
        
        <div style="margin-left: 10px;" class="form-group">
          <label for="inputPassword4">Nội dung</label>
          <textarea class="form-control" name="noidung" id="editor" cols="200" placeholder=""></textarea>

        </div>

        <h3>SEO</h3>

        <div style="margin-left: 10px;"  class="form-group">
          <label for="title">Meta Keywords</label>
          <textarea class="form-control" name="keywords" id="keywords" rows="4" cols="50"></textarea>
          
        </div>
        <div style="margin-left: 10px;"  class="form-group">
          <label for="title">Meta Description </label>
          <textarea class="form-control" name="description" id="description" cols="20"></textarea>
          
        </div>
      <input type="submit" name="addAbout" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
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