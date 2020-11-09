
<!-- ADD TO DATABASE -->

<?php
if(isset($_GET['id'])){
  global $connection;
  $id= $_GET['id'];
  $query = "select * from position where id = $id";
  $res = mysqli_query($connection,$query);
  if(mysqli_num_rows($res)){
    if($row = mysqli_fetch_assoc($res)){
      $title = $row['title'];
      $pos= $row['pos'];
    }
  }
}
if(isset($_POST['updateAbout'])){
  $data['title']=$_POST['title'];
  $data['pos']=$_POST['pos'];
  $result = update('position',$data,"id",$id); 
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
            <input name="pos" type="text" class="form-control" id="pos" value="<?php echo $pos; ?>">
          </div>
          <div class="form-group" style="max-width: 500px;">
            <label for="inputPassword4">Title</label>
            <input name="title" type="text" class="form-control" id="title" value="<?php echo $title; ?>">
          </div>
          <input type="submit" name="updateAbout" class="btn btn-primary" value="Submit">
        </form>
      </div>
    </div>
  </div>

    <!-- CONTENT -->




<!-- ADD TO DATABASE -->