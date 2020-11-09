

    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>THÊM MENU</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
      <div class="form-group col-md-4">
          <label for="inputEmail4">Type</label>
          <?php echo getPosMenu('main'); ?>
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail4">Parent Menu</label>
          <?php
            $list_menu = getListMenu($lang,0);
            echo $list_menu;

           ?>
        </div>
        

        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="">
        </div>
        
        <div class="form-group col-md-6">
          <label for="inputEmail4">Link</label>
          <input type="text" class="form-control" name="link" id="link" placeholder="">
        </div>
      <input type="submit" name="addMenu" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addMenu'])){
    $data['parentid'] = $_POST['parentid'];
    $data['pos'] = $_POST['pos'];
    $data['display'] = 1;
    $data['display_order'] = 0;
    $data_desc['title']=$_POST['title'];
    $data_desc['link'] = $_POST['link'];

    


    //MENU
    $res=insert('menu',$data,'addMenu');
    $query = "select *from languages";
    $select_lang = mysqli_query($connection,$query);
      while($row_l = mysqli_fetch_assoc($select_lang)){
        $_POST['lang'] = $row_l['name'];
        
        if($res['mysqli_insert_id']) {
        $data_desc['m_id'] = $res['mysqli_insert_id'];
        // MENU DESC
        $data_desc['lang'] = $row_l['name'];
        $res_desc=insert('menu_desc',$data_desc,'addMenu'); 
        
        
        if( $res_desc['mysqli_error'] ) {
          echo "Query Failed: " . $res_desc['mysqli_error'];
          die;
        }
        else{
          header("Location: ./menu.php");
        }
      }
    }
    
    
    
   
}


?>
<!-- ADD TO DATABASE -->