
<?php

if(isset($_GET['id'])){
    
    $edit_id = $_GET['id'];
    
    $query = "select * from social where id = $edit_id";
    $select_query = mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($select_query)){
        $name=$row['name'];
        $link=$row['link'];
        $title=$row['title'];
        $display_order=$row['display_order'];
        $icon= $row['icon'];
        
    }

}


?>
   



  
  
  
   
    
    <!-- CONTENT -->
      <div class="content">
        <div class="card">
  <div class="card-body">
    <h3>UPDATE SOCIAL NETWORK</h3>
    <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        <div class="form-group col-md-6">
          <label for="inputEmail4">Name</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $name; ?>">
        </div>
        
        
        <div class="form-group col-md-4">
          <label for="inputEmail4">Link</label>
          <input type="text" class="form-control" name="link" placeholder="" value="<?php echo $link; ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail4">Title</label>
          <input type="text" class="form-control" name="title" placeholder="" value="<?php echo $title; ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail4">Icon</label>
          <input type="text" class="form-control" name="icon" placeholder="" value="<?php echo $icon; ?>">
        </div>
        
        <div class="form-group col-md-4">
          <label for="inputEmail4">Display order</label>
          <input type="text" class="form-control" name="display_order" placeholder="" value="<?php echo $display_order; ?>">
        </div>
      <input type="submit" name="updateSocial" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
    </div>

    <!-- CONTENT -->




  

<?php

    if(isset($_POST['updateSocial'])){
		    $name=$_POST['name'];
        $display_order=$_POST['display_order'];
        $link=$_POST['link'];
        $title=$_POST['title'];          
        $icon = $_POST['icon'];
       
        BUSupdateSocial($edit_id,$name,$title,$link,$icon,$display_order);
       
        header("Location: ./social.php");
        

    }


?>