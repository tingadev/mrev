

<!-- ADD TO DATABASE -->
<?php 
if(isset($_GET['id']))
  global $connection;
  $id = $_GET['id'];
  $query = "SELECT *from about a, about_desc ad where a.id = ad.aid and a.id = $id and lang ='".$lang."'";
  $select = mysqli_query($connection,$query);
  if(mysqli_num_rows($select)){
    while ($row = mysqli_fetch_assoc($select)) {
        $info = $row;
    }
  }

  
  $src_img = $info['photo'];
  $src_img_thumb = $info['thumb'];
  $root = "../uploads/about/$src_img_thumb";
  
?>
<?php

if(isset($_POST['updateAbout'])){
    $flg=0;
    $data['title'] = $_POST['title'];
    $data['link'] = makeUrl($_POST['title']);
    $data['mota'] = $_POST['mota'];
    $data['noidung'] = $_POST['noidung'];
    $data['keywords'] = $_POST['keywords'];
    $data['description'] = $_POST['description'];
    $photo_up= $_FILES['photo']['name'];
    $data['photo'] = $_FILES['photo']['name'];
    $photo_up_temp=$_FILES['photo']['tmp_name'];
    if($photo_up=="" || empty($photo_up)){
      $photo_up=$src_img;
      $data['photo'] = $src_img;
      $flg=1;
    }

    if($flg==0){
      move_uploaded_file($photo_up_temp,ROOT_SRC."/uploads/about/$photo_up");
      $info= pathinfo($photo_up);
      $file_name =  basename($photo_up,'.'.$info['extension']);
      $thumb_up= $file_name . "_thumb." . strtolower($info['extension']);
      make_thumb(ROOT_SRC."/uploads/about/$photo_up",ROOT_SRC."/uploads/about/$thumb_up",700);
      $data['thumb'] = $thumb_up;
    }
    // SEO URL
    $seo_url['url'] = makeUrl($_POST['title']);
    
    if($data['title']==$info['title']){  
    }
    else{
      $title_seo = checkTitleSEO($seo_url['url'],$lang);
        if($title_seo==false){
          $date_now = date("Y-m-d H:i:s");
          $seo_url['url'] = $data['link'] = makeUrl($_POST['title'])."-".strtotime($date_now);

        }
    }
    $res = update('about_desc',$data,"lang` ='".$lang."' and `aid",$id);
    $res_seo=update('seo_url',$seo_url,"lang` ='".$lang."' and modules = '".$modules."' and `itemid",$id);
    if($res['mysqli_error']){
      echo "Query Failed: " . $res['mysqli_error'];
    }
    else{
      header("Location: ./about.php");
    }   
}


?>
    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>UPDATE GIỚI THIỆU</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Tên bài viết</label>
          <input name="title" type="text" class="form-control" value="<?php echo $info['title']; ?>">
          
        </div>
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Link</label>
          <input name="link" type="text" class="form-control" value="<?php echo $info['link']; ?>" disabled>
          
        </div>
          <div style="margin-left: 10px;"  class="form-group">
          <label for="title">Mô tả ngắn</label>
          <textarea class="form-control" name="mota" id="mota" cols="20"><?php echo $info['mota']; ?></textarea>
          
        </div>
        <div style="margin-left: 10px;"  class="form-group custom-file col-md-6">

          <input name="photo" type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label"  for="customFile">Picture</label>
        </div>
        <div class="form-group col-md-4">
         <img id="blah" src="<?php echo $root; ?>">
       </div>
        
        <div style="margin-left: 10px;" class="form-group">
          <label for="inputPassword4">Nội dung</label>
          <textarea class="form-control" name="noidung" id="editor" cols="200" placeholder=""><?php echo $info['noidung']; ?></textarea>

        </div>

        <h3>SEO</h3>

        <div style="margin-left: 10px;"  class="form-group">
          <label for="title">Meta Keywords</label>
          <textarea class="form-control" name="keywords" id="keywords" rows="4" cols="50"><?php echo $info['keywords']; ?></textarea>
          
        </div>
        <div style="margin-left: 10px;"  class="form-group">
          <label for="title">Meta Description </label>
          <textarea class="form-control" name="description" id="description" cols="20"><?php echo $info['description']; ?></textarea>
          
        </div>
      <input type="submit" name="updateAbout" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->
    <script>
  // Add the following code if you want the name of the file appear on select
  var src_img = "<?php echo $src_img; ?>";
$(".custom-file-input").siblings(".custom-file-label").addClass("selected").html(src_img);
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
