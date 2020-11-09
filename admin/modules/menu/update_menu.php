<!-- ADD TO DATABASE -->
<?php
if(isset($_GET['id'])){
  $edit_id = $_GET['id'];
  global $connection;
  $query = "SELECT *from menu m, menu_desc md where m.id = md.m_id and m.id = $edit_id and lang ='".$lang."'";
  $select = mysqli_query($connection,$query);
  if(mysqli_num_rows($select)){
    while ($row = mysqli_fetch_assoc($select)) {
        $info = $row;
    }
  }
  $parentid = $info['parentid'];
}
if(isset($_POST['updateMenu'])){
    $data['parentid'] = $_POST['parentid'];
    $data['pos'] = $_POST['pos'];
    $data_desc['title']=$_POST['title'];
    $data_desc['link'] = $_POST['link'];
    //MENU
    $res = update('menu',$data,'id',$edit_id);
    $res_desc=update('menu_desc',$data_desc,"lang` ='".$lang."' and `m_id",$edit_id); 
    if( $res_desc['mysqli_error'] ) {
      echo "Query Failed: " . $res_desc['mysqli_error'];
      die;
    }
    else{
      header("Location: ./menu.php");
    }
     
}
?>
<!-- ADD TO DATABASE -->

<!-- CONTENT -->
<div class="content">
  <div class="card">
    <div class="card-body">
      <h3>UPDATE MENU</h3>
      <form action='' method="post" enctype="multipart/form-data" target="_self">
        <div class="form-group col-md-4">
          <label for="inputEmail4">Type</label>
          <?php echo getPosMenu($info['pos']); ?>
        </div>
          <div class="form-group col-md-4">
            <label for="inputEmail4">Parent Menu</label>
            <?php
              $list_menu = getListMenu($lang,$info['parentid']);
              echo $list_menu;

             ?>
          </div>

          <div class="form-group col-md-6">
            <label for="inputEmail4">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="" value="<?php echo $info['title']; ?>">
          </div>
          
          <div class="form-group col-md-6">
            <label for="inputEmail4">Link</label>
            <input type="text" class="form-control" name="link" id="link" placeholder="" value="<?php echo $info['link']; ?>">
          </div>
        <input type="submit" name="updateMenu" class="btn btn-primary" value="Submit">
      </form>
    </div>
  </div>
</div>
<!-- CONTENT -->



