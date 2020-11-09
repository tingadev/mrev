<?php include "../../includes/Parsedown.php"; ?>
<?php 
if(isset($_GET['id'])){
  $edit_id = $_GET['id'];
  global $connection;
  $query = "SELECT *from mail_template where m_id = $edit_id and lang = '$lang'";
  $select_com = mysqli_query($connection,$query);
  if(mysqli_num_rows($select_com)){
    if($row = mysqli_fetch_assoc($select_com)){
      $id = $row['id'];
      $description = $row['description'];
      $markdown = $row['markdown'];
      $title = $row['title'];
    }
  } 
}
  
?>

<?php

if(isset($_POST['update'])){
  $data['title'] = $_POST['title'];
  $data['description']=  $_POST['test-editor-html-code'];
  $data['markdown'] = $_POST['description'];


 
  
  $res = update('mail_template',$data,"lang` ='".$lang."' and `m_id",$edit_id);
  header('Location: ./mail_template.php');
}
?>


    <!-- CONTENT -->
  <div class="content">
    <div class="card">
      <div class="card-body">
        <h3>UPDATE MAIL TEMPLATE</h3>
       
         <form action='' method="post" enctype="multipart/form-data" target="_self">
     
        
        <div style="margin-left: 10px;"  class="form-group col-md-6">
          <label for="title">Title</label>
          <input name="title" type="text" class="form-control" value="<?php echo $title; ?>">
          
        </div>
        
         
       

       
<div id="test-editor" >
    <textarea style="display:none;" name="description">
<?php echo $markdown; ?>
    </textarea>
</div>

<script type="text/javascript">
    $(function() {
        var editor = editormd("test-editor", {
            // width  : "100%",
            // height : "100%",

            path   : "./assets/editormd.md/lib/"
        });
    });
</script>

       
      <input type="submit" name="update" class="btn btn-primary" value="Submit">
    </form>
      </div>
    </div>
  </div>

    <!-- CONTENT -->
