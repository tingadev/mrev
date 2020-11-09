<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../../_layout/admin_header.php";
  include "../../lang/about.php";
?>

<!-- CONTENT -->
<div class="content">    
    <div class="card">
      <div class="card-body">
        <form action='' method="post" enctype="multipart/form-data" target="_self">
        <?php
          foreach ($lib as $key => $value) {
            echo "
              <div class='form-group col-md-6'>
                <label for='{$key}'>{$key}</label>
                <input type='text' class='form-control' name='{$key}' id='{$key}' placeholder='' value='{$value}'>
              </div>
            ";
          }
        ?>
        <input type="submit" name="updateLang" class="btn btn-primary" value="Submit">
        </form>
      </div>
    </div>
</div>
<!-- CONTENT -->

<!-- ADD TO DATABASE -->
<?php

if(isset($_POST['updateLang'])){
 
 $content = "<?php \r\n \r\n";
 $content .= " $"."lib". "= array(\r\n";
    foreach ($lib as $key =>$value) {
      
      $content .= "'{$key}' => '{$_POST[$key]}',\r\n";
      
     
    }
  $content .="); \r\n \r\n";
  $content .= "?>";
  file_put_contents(ROOTLANG.'/lang/about.php', $content);   
  header("Location: lang.php");
    
    
   
}
?>
<!-- ADD TO DATABASE -->
<?php include "../../_layout/admin_footer.php"; ?>