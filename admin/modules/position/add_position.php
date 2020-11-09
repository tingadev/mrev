
<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addAbout'])){
  $data['title']=$_POST['title'];
  $data['pos']=$_POST['pos'];
  $result = insert('position',$data,"submit"); 
    echo "Query Failed: " . $result['mysqli_error'];
  if( $result['mysqli_error'] ) {
  } else {
    $insert_id = $result['mysqli_insert_id'];
  }
  echo "<script> loading(); </script>";
  header("Location: ./position.php");
}

?>
  <!-- CONTENT -->
  <div class="content">
    <div class="card">
      <div class="card-body">
        <form action='' method="post" enctype="multipart/form-data" target="_self">
          <div class="form-group" style="max-width: 500px;">
            <label for="inputPassword4">Position</label>
            <input name="pos" type="text" class="form-control" id="pos">
          </div>
          <div class="form-group" style="max-width: 500px;">
            <label for="inputPassword4">Title</label>
            <input name="title" type="text" class="form-control" id="title">
          </div>
          <input type="submit" name="addAbout" class="btn btn-primary" value="Submit">
        </form>
      </div>
    </div>
  </div>

    <!-- CONTENT -->




<!-- ADD TO DATABASE -->