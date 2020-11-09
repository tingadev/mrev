
<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
  
?>

<?php 
  global $connection;
  $query = "SELECT *from video limit 0,1";
  $select_com = mysqli_query($connection,$query);
  if(mysqli_num_rows($select_com)){
    if($row = mysqli_fetch_assoc($select_com)){
      $embed = $row['embed'];
      $position = $row['position'];
      $height = $row['height'];
      $width = $row['width'];
      $id = $row['id'];
      $display = $row['display'];
    }
  } 
?>

<?php

if(isset($_POST['updateVideo'])){
  $data['height']= $_POST['height'];
  $data['width']= $_POST['width'];
  $data['embed']= $_POST['embed'];
  $data['position']= $_POST['position'];
  $data['display'] = $_POST['display'];
  
  $res = update("video",$data,'id',$id);
  if( $res['mysqli_error'] ) {
    echo "Query Failed: " . $res['mysqli_error'];
    die;
  }
  header("Location: video.php");
}

?>


    <!-- CONTENT -->
  <div class="content">
    <div class="card">
      <div class="card-body">
        
        
          <div id="company" class="">
            <form action="" method="post">
              <div class="title" style="margin-top: 20px;"><h3>VIDEO</h3></div>
              <div class="">
                <div class="form-group">
                  <label for="inputEmail4">Embed</label>
                  <textarea type="text" class="form-control" name="embed" id="embed" ><?php echo $embed; ?></textarea>
                </div>
                <div class="form-group" style="max-width: 480px;">
                  <label for="inputEmail4">Width(px)</label> (Nếu giá trị bằng 0 thì video sẽ full màn hình)
                  <input type="text" class="form-control" name="width" value="<?php echo $width; ?>">
                </div>
                <div class="form-group" style="max-width: 480px;">
                  <label for="inputEmail4">Height(px)</label>
                  <input type="text" class="form-control" name="height" value="<?php echo $height; ?>">
                </div>
                <div class="form-group">
                  <label for="inputEmail4">Vị trí</label>
                  <select name="position" id="">
                    <?php
                     if($position == 0){
                       
                        echo '<option value="0" selected>Dưới Banner</option>
                    <option value="1">Dưới Giới thiệu & Dịch vụ</option>';
                      }
                      else{
                        $selected = '';
                        echo '<option value="0" >Dưới Banner</option>
                    <option value="1" selected>Dưới Giới thiệu & Dịch vụ</option>';
                      } 
                    ?>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputEmail4">Hiển thị</label>
                  <select name="display" id="">
                    <?php
                     if($display == 0){
                       
                        echo '<option value="0" selected>Ẩn</option>
                    <option value="1">Hiện</option>';
                      }
                      else{
                        $selected = '';
                        echo '<option value="0" >Ẩn</option>
                    <option value="1" selected>Hiện</option>';
                      } 
                    ?>
                    
                  </select>
                </div>
              </div>
              <button type="submit" name="updateVideo" class="btn btn-primary">Update Video</button>
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>

    <!-- CONTENT -->

<?php include "../../_layout/admin_footer.php"; ?>
