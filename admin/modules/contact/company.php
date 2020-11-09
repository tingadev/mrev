
<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
  include "../../../lang/config.php";
?>

<?php 
  global $connection;
  $query = "SELECT *from company where lang = '".$lang."' order by id DESC limit 0,1";
  $select_com = mysqli_query($connection,$query);
  if(mysqli_num_rows($select_com)){
    if($row = mysqli_fetch_assoc($select_com)){
      $id = $row['id'];
      $name = $row['name'];
      $email = $row['email'];
      $phone = $row['phone'];
      $meta_key = $row['meta_key'];
      $meta_desc = $row['meta_desc'];
      $title = $row['title'];
      $address = $row['address'];
      $website = $row['website'];
      $map = $row['map'];
    }
  } 
?>

<?php

if(isset($_POST['contact_submit'])){

  //INFO
  $data['name'] = $_POST['name'];
  $data['email'] = $_POST['email'];
  $data['phone'] = $_POST['phone'];
  $data['address'] = $_POST['address'];
  $data['website'] = $_POST['website'];
  $data['meta_key'] = $_POST['meta_key'];
  $data['meta_desc'] = $_POST['meta_desc'];
  $data['title'] = $_POST['title'];
  $data['map'] = $_POST['map'];
  $data['display_order'] = 0;
  $res = update("company",$data,"lang` ='".$lang."' and `id",$id);
  if( $res['mysqli_error'] ) {
    echo "Query Failed: " . $res['mysqli_error'];
  }
  header("Location: company.php");
}
if(isset($_POST['config_submit'])){
  //CONFIG
 $content = "<?php \r\n \r\n";
 $content .= " $"."config". "= array(\r\n";
    foreach ($config as $key =>$value) {
      
      $content .= "'{$key}' => '{$_POST[$key]}',\r\n";
      
     
    }
  $content .="); \r\n \r\n";
  $content .= "?>";
  file_put_contents(ROOT_SRC.'/lang/config.php', $content);   
  header("Location: company.php");  
   
}
?>


    <!-- CONTENT -->
  <div class="content">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" class="btn-red btn active show" href="#company">Global</a></li>
          <li><a data-toggle="tab" class="btn-red btn" href="#config">Config</a></li>
        </ul>
        <div class="tab-content">
          <div id="company" class="tab-pane fade in active show">
            <form action="" method="post">
              <div class="title" style="margin-top: 20px;"><h3>INFOMATION OF STORE</h3></div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Công ty</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Name Store" value="<?php echo $name; ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Phone</label>
                  <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Phone">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" name="address" id="address" value="<?php echo $address; ?>" placeholder="1234 Main St">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">Website</label>
                  <input type="text" class="form-control" name="website" id="website" value="<?php echo $website; ?>" placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" placeholder="">
                </div>
                <div class="clear"></div>
                <div class="form-group" style="width: 100%;">
                  <label for="inputAddress">Meta Key</label>
                  <textarea class="form-control" name="meta_key" id="meta_key"  placeholder=""><?php echo $meta_key; ?></textarea>
                </div>
                <div class="form-group" style="width: 100%;">
                  <label for="inputAddress">Meta Desc</label>
                  <textarea class="form-control" name="meta_desc" id="meta_desc"  placeholder=""><?php echo $meta_desc; ?></textarea>
                </div>
                <div class="form-group" style="width: 100%;">
                  <label for="inputAddress">Map</label>
                  <textarea class="form-control" name="map" id="map"  placeholder=""><?php echo $map; ?></textarea>
                </div>
              </div>
              <button type="submit" name="contact_submit" class="btn btn-primary">Update Company</button>
            </form>
          </div>
          <div id="config" class="tab-pane fade">
            <form method="post" action="">
              <div class="title" style="margin-top: 20px;"><h3>CONFIG OF STORE</h3></div>
              <div class="form-row">
                <?php
                foreach ($config as $key => $value) {
                echo "
                <div class='form-group col-md-6'>
                <label for='{$key}'>{$key}</label>
                <input type='text' class='form-control' name='{$key}' id='{$key}' placeholder='' value='{$value}'>
                </div>
                ";
                }
                ?>
              </div>
              <button type="submit" name="config_submit" class="btn btn-primary">Update Config</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- CONTENT -->

<?php include "../../_layout/admin_footer.php"; ?>
