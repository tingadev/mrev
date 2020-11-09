
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
      $title = $row['title'];
    }
  } 
}
  
?>

<?php

if(isset($_POST['update'])){
  $data['title'] = $_POST['title'];
  $data['description']= $_POST['description'];
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
        
         
        <!-- <div style="margin-left: 10px;" class="form-group">
          <label for="inputPassword4">Nội dung</label>
          <textarea class="form-control" name="description" id="editor" cols="200" placeholder=""><?php echo $description; ?></textarea>

        </div> -->

        <link rel="stylesheet" href="editormd/css/editormd.css" />
<div id="test-editor" name="description">
    <textarea style="display:none;">### Editor.md

**Editor.md**: The open source embeddable online markdown editor, based on CodeMirror & jQuery & Marked.
    </textarea>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="editormd/editormd.min.js"></script>
<script type="text/javascript">
    $(function() {
        var editor = editormd("test-editor", {
            // width  : "100%",
            // height : "100%",
            path   : "editormd/lib/"
        });
    });
</script>

       
      <input type="submit" name="update" class="btn btn-primary" value="Submit">
    </form>
      </div>
    </div>
  </div>

    <!-- CONTENT -->
