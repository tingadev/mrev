<?php require_once "_layout/admin_header.php"; ?>
    <!-- CONTENT -->
    <div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
      
        <?php include "_layout/admin_nav.php"; ?>
        
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include "_layout/admin_top.php"; ?>
      <!-- End Navbar -->
<script>
$(document).ready(function(){
    $('#uploadForm').ajaxForm({
        target:'#imagesPreview',
        beforeSubmit:function(){
            // $('#uploadStatus').html('<img src="uploading.gif"/>');
        },
        success:function(){
            $('#images').val('');
            $('#uploadStatus').html('');
        },
        error:function(){
            $('#uploadStatus').html('Images upload failed, please try again.');
        }
    });
});
</script>
<div class="clear"></div>
<div class="content">
    <!-- images upload form -->
<form method="post" id="uploadForm" enctype="multipart/form-data" action="includes/upload.php">
    <label>Choose Images</label>
    <input type="file" name="images[]" id="images" multiple >
    <input type="submit" name="submit" value="UPLOAD"/>
</form>

<!-- display upload status -->
<div id="uploadStatus"></div>

<!-- gallery view of uploaded images --> 
<div class="gallery" id="imagesPreview"></div>
</div>

</div>
</div>

    <!-- CONTENT -->


<?php include "_layout/admin_footer.php"; ?>