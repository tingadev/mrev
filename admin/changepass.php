
<?php require_once "_layout/admin_header.php"; ?>
    <!-- CONTENT -->
 
      <div class="content">
        <div class="card">
  <div class="card-body">
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        <div class="form-group col-md-4">
          <label for="inputEmail4">Username</label>
          <input type="text" class="form-control" name="username" placeholder="" >
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail4">Old Password</label>
          <input type="password" class="form-control" name="old_pass" placeholder="" >
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail4">News Password</label>
          <input type="password" class="form-control" name="new_pass" placeholder="" >
        </div>
      <input type="submit" name="updatePass" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->

<?php
  if(isset($_POST['updatePass'])){
    $username = $_POST['username'];
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];

    global $connection;
    $query="select * from users";
    $select_user=mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($select_user);
    $old_pass = hash('ripemd160', $old_pass);
    if($old_pass == $row['password'] && $username == $row['username']){
      $new_pass = hash('ripemd160', $new_pass);
      $query_up = "UPDATE users SET password = '{$new_pass}' where role = 'admin'";
      $up_user = mysqli_query($connection, $query_up);
      echo '<script language="javascript">';
      echo 'alert("Cập nhật mật khẩu thành công!!")';
      echo '</script>';
    }
    else{

      echo '<script language="javascript">';
      echo 'alert("Bạn đã nhập sai mật khẫu cũ hoặc Username!!")';
      echo '</script>';
    }
  }

 ?>


<?php include "_layout/admin_footer.php"; ?>