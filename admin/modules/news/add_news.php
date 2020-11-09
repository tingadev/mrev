    <?php


      if(isset($_POST['test'])){

       echo $_POST['test'];

      }
      ?>

<!-- CONTENT -->

<div class="content">
 <form action='' method="post" enctype="multipart/form-data" target="_self">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" class="btn-primary btn" href="#home">Home</a></li>
    <li><a data-toggle="tab" class="btn-primary btn" href="#menu1">Menu 1</a></li>
    <li><a data-toggle="tab" class="btn-primary btn" href="#menu2">Menu 2</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active show">
     <div class="card">
      <div class="card-body">


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

          <input name="picture" type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label"  for="customFile">Picture</label>
        </div>
        <div class="form-group col-md-4">
         <img id="blah" src="">
       </div>

    <div class="form-group">
      <label for="inputPassword4">Content</label>
      <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""></textarea>

    </div>


  </div>
</div>
</div>
<div id="menu1" class="tab-pane fade">
<script>
  function load_ajax(){
      var form_data = new FormData();
                    var ins = document.getElementById('images_array').files.length;
                    for (var x = 0; x < ins; x++) {
                        form_data.append("images[]", document.getElementById('images_array').files[x]);
                    }
                $.ajax({
                    url : "./includes/upload.php",            
                    dataType: 'text', // what to expect back from the PHP script
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type : "post",
                    success:function(response){
                       
                        $('#uploadStatus').html(response);
                    },
                    error:function(response){
                        $('#uploadStatus').html('Images upload failed, please try again.');
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

    


<!-- display upload status -->
<div id="uploadStatus">
</div>

<!-- gallery view of uploaded images --> 
<div class="gallery" id="imagesPreview"></div>
</div>
<div id="menu2" class="tab-pane fade">
  <h3>Menu 2</h3>
  <p>Some content in menu 2.</p>
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



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addProduct'])){

  $data['title']=$_POST['title'];
  $data['short_desc']=$_POST['short_desc'];
  // $short_desc=$_POST['short_desc'];
  // $picture=$_FILES['picture']['name'];
  // $picture_tmp=$_FILES['picture']['tmp_name'];
  // $description=escape($_POST['description']);
  // $price = $_POST['price'];
  // $stock = 1;
  // $date_post = 0;
  // $focus_main =0;
  // $focus_order = 0;
  // $display = 1;
  // $link = makeUrl($title);

 
$img = $_POST['img'];
$sql ='';
foreach ($img as $value) {
  $sql .= "INSERT INTO product_images(picture) values('{$value}');";
}
global $connection ;
// echo $sql; die;
$res = mysqli_multi_query($connection,$sql);
// $res_img = insert('product_images',$img,"submit");
// $result = insert('product',$data,"submit"); 

// if( $res_img['mysqli_error'] ) {
//     echo "Query Failed: " . $res_img['mysqli_error'];
// } else {
   
//     // $insert_id = $result['mysqli_insert_id'];

    
// }



  // if($picture=="" || empty($picture)){
  //   $picture="noimg.jpg";
  //   $thumb="noimg.jpg";
  // }
  // else{
  //   move_uploaded_file($picture_tmp,"../assets/img/$picture");
  //   $info= pathinfo($picture);
  //   $file_name =  basename($picture,'.'.$info['extension']);
  //   $thumb= $file_name . "thumb" . ".jpg";
  //   make_thumb("../assets/img/$picture","../assets/img/$thumb",1000);
  // }
  
  // BUSaddProduct(1,$title,$description,$short_desc,$picture,$price,$stock,$link,$thumb,$focus_main,$focus_order,$display,$display_order,$date_post);
  
  // $insert_id = mysqli_insert_id($connection);
  // $pic_array=array();
  // $pic_array=$_FILES['images']['name'];
  // $cot = array('p_id','picture'); 
  // foreach ($pic_array as $key => $value) {

  //   $query = "INSERT product_images(p_id,picture) values($insert_id,'{$value}')";
  //   $insert = mysqli_query($connection,$query);
  // }
  


  // header("Location: ./product.php");



}


?>
  <!-- ADD TO DATABASE -->