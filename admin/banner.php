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
            $('#uploadStatus').html('<img src="uploading.gif"/>');
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
    <!-- CONTENT -->


<?php include "_layout/admin_footer.php"; ?>