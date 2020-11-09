

    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
         <div class="form-group col-md-6">
          <label for="cat_id">Category</label>
          
            <?php
              $category= getCatNews();
              echo $category;
            ?>
           
            
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="">
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Short Desc</label>
          <textarea type="text" class="form-control" name="short_desc" placeholder=""></textarea>
        </div>
      <input type="submit" name="addCategory" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->



<!-- ADD TO DATABASE -->

<?php

if(isset($_POST['addCategory'])){

    global $connection;
    $title = $_POST['title'];
    $data_desc['title']=$title;
    $data['display_order']=0;
    $data_desc['short_desc']=$_POST['short_desc'];
    $data_desc['link'] = makeUrl($title);
    $data['parentid'] = $_POST['cat_id'];
    $data['date_post'] = strtotime(date("Y-m-d H:i:s"));

    $result = insert('news_cat',$data,"addCategory"); 
    if( $result['mysqli_error'] ) {
      echo "Query Failed: " . $result['mysqli_error'];
    }
    else{
      $data_desc['cat_id'] = $result['mysqli_insert_id'];
      $result = insert('news_cat_desc',$data_desc,"addCategory"); 
    } 
    
    // header("Location: ./services.php");
    
    
   
}


?>
<!-- ADD TO DATABASE -->