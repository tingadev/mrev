
<style>
  .card label{
  font-size: 16px !important;
}
</style>

<!-- CONTENT -->
<div class="content">
  <div class="card">
    <div class="card-body">
      <h3>THÊM BANNER/LOGO</h3>
      <form action='' method="post" enctype="multipart/form-data" target="_self">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="">
        </div>
      <div style="margin-left: 10px;"  class="form-group custom-file col-md-6">
        <input type="file" class="custom-file-input" name="pic" id="customFile">
        <label class="custom-file-label" for="customFile">Picture</label>
      </div>
      <div class="form-group col-md-4">
        <img id="blah" src="">
      </div>
      <div class="form-group">
          <label for="inputPassword4">Description</label>
          <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""></textarea>
        </div>
      <div class="form-group col-md-4">
        <label for="inputEmail4">Position</label>
        <?php echo getPos(0); ?>
      </div>
      <div class="form-group col-md-4">
      <label for="inputEmail4">Display</label>
        <select style="font-size: 16px; margin-top: 8px; width: 100px;" class="form-control" name="display" id="">     
          <option value="1">Show</option>
          <option value="0">Hide</option>
        </select>  
      </div>
      <input type="submit" name="addBanner" class="btn btn-primary" value="Submit">
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



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addBanner'])){
    
    $data['title']=$_POST['title'];
    $banner_img = $_FILES['pic']['name'];
    $data['src']= $banner_img;
    $banner_img_temp=$_FILES['pic']['tmp_name'];
    $data['description']=$_POST['description'];
    $data['display_order']=0;
    $data['display']=$_POST['display'];
    $data['pos']=$_POST['pos'];
    $result = insert('banner',$data,"submit"); 
    if( $result['mysqli_error'] ) {
      echo "Query Failed: " . $result['mysqli_error'];
    } else {
      $insert_id = $result['mysqli_insert_id'];
      if($data['pos']=='logo'){
        move_uploaded_file($banner_img_temp,ROOT_SRC."/uploads/weblink/$banner_img");
      }
      else{
        move_uploaded_file($banner_img_temp,ROOT_SRC."/uploads/weblink/$banner_img");
        $info= pathinfo($banner_img);
        $file_name =  basename($banner_img,'.'.$info['extension']);
        $thumb= $file_name . "thumb" . strtolower($info['extension']);
        make_thumb("../assets/img/banner/$banner_img",ROOT_SRC."/uploads/weblink/$thumb",800);
      }
    }
    header("Location: ./banner.php");
    
    
   
}


?>
<!-- ADD TO DATABASE -->