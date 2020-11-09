
<?php

if(isset($_GET['id'])){
    
    $edit_id = $_GET['id'];
    
    $query = "select *from services where id = $edit_id";
    $select_query = mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($select_query)){
        $title=$row['title'];
        $content=$row['content'];
        $display_order=$row['display_order'];
        $picHome=$row['pic_home'];
        $picModal=$row['pic_mod'];
        $short=$row['short_desc'];
        
    }

}


?>

    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="" value="<?php echo $title; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Short Desc</label>
          <textarea type="text" class="form-control" name="desc" placeholder="" ><?php echo $short; ?></textarea>
        </div>
        <div style="margin-left: 10px;"  class="form-group custom-file col-md-6">
          
          <input name="picHome" type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label"  for="customFile">Picture of Home</label>
        </div>
         <div class="form-group col-md-4">
         <img id="blah" src="../assets/img/<?php echo $picHome; ?>">
        </div>
        <div style="margin-left: 10px;"  class="form-group custom-file col-md-6">
          
          <input name="picModal" type="file" class="custom-file-input" id="customFile1">
          <label class="custom-file-label"  for="customFile">Picture of Modal</label>
        </div>
         <div class="form-group col-md-4">
         <img id="blah1" src="../assets/img/<?php echo $picModal; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Display Order</label>
          <input type="text" class="form-control" name="display_order" id="display_order" placeholder="" value="<?php echo $display_order; ?>">
        </div>
        <div class="form-group">
          <label for="inputPassword4">Content</label>
          <textarea class="form-control" name="content" id="editor" cols="200" placeholder=""><?php echo $content; ?></textarea>

        </div>
      <input type="submit" name="updateService" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>
<script>
  
  var fileName_default = "<?php echo $picHome; ?>";
  $("#customFile").siblings(".custom-file-label").addClass("selected").html(fileName_default);
  var fileName_default1 = "<?php echo $picModal; ?>";
  $("#customFile1").siblings(".custom-file-label").addClass("selected").html(fileName_default1);
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
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah1').attr('src', e.target.result);

            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#customFile").change(function(){
        readURL(this);
    });
    $("#customFile1").change(function(){
        readURL1(this);
    });
</script>
    <!-- CONTENT -->



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['updateService'])){
    
    $title=$_POST['title'];
    $display_order=$_POST['display_order'];
    $desc=$_POST['desc'];
    $img_home=$_FILES['picHome']['name'];
    $img_home_temp=$_FILES['picHome']['tmp_name'];
    $img_mod=$_FILES['picModal']['name'];
    $img_mod_temp=$_FILES['picModal']['tmp_name'];
    $content=escape($_POST['content']);
    

    
    if($img_home=="" || empty($img_home)){
        $img_home="noimg.jpg";
        $thumb_home="noimg.jpg";
    }
    else{
        move_uploaded_file($img_home_temp,"../assets/img/$img_home");
        $info= pathinfo($img_home);
        $file_name =  basename($img_home,'.'.$info['extension']);
        $thumb_home= $file_name . "thumb" . ".jpg";
        make_thumb("../assets/img/$img_home","../assets/img/$thumb_home",1000);
    }
    if($img_mod=="" || empty($img_mod)){
        $img_mod="noimg.jpg";
            
    }
    else{
        move_uploaded_file($img_mod_temp,"../assets/img/$img_mod");
        $info= pathinfo($img_mod);
        $file_name =  basename($img_mod,'.'.$info['extension']);
        $thumb_mod= $file_name . "thumb" . ".jpg";
        make_thumb("../assets/img/$img_mod","../assets/img/$thumb_mod",1000);
    }
    BUSupdateService($edit_id,$title,$desc,$content,$img_home,$img_mod,$thumb_home,$display_order);
    
    header("Location: ./services.php");
    
    
   
}


?>
<!-- ADD TO DATABASE -->