

    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>THÊM SOCIAL NETWORK</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        <div class="form-group col-md-6">
          <label for="inputEmail4">Name</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="">
        </div>

        <div class="form-group col-md-6">
          <label for="inputEmail4">Link</label>
          <input type="text" class="form-control" name="link" placeholder="">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Icon</label>
          <input type="text" class="form-control" name="icon" placeholder="">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Display Order</label>
          <input type="text" class="form-control" name="display_order" placeholder="">
        </div>
       
      <input type="submit" name="addSoical" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addSoical'])){

    $name=$_POST['name'];
    $title= $_POST['title'];
    $display_order=$_POST['display_order'];
    $link=$_POST['link'];
    $icon=$_POST['icon'];
    BUSaddSocial($name,$title,$icon,$link,$display_order);
    header("Location: ./social.php");
    
    
   
}


?>
<!-- ADD TO DATABASE -->