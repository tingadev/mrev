
<?php
    include ROOT_SRC."/lang/".$lang."/products.php";
  include ROOT_SRC."/lang/products_config.php";
?>


<?php


if(isset($_POST['extras_submit'])){
  //CONFIG
 $content = "<?php \r\n \r\n";
 $content .= " $"."products_lang". "= array(\r\n";
    foreach ($products_lang as $key =>$value) {
      
      $content .= "'{$key}' => '{$_POST[$key]}',\r\n";
      
     
    }
  $content .="); \r\n \r\n";
  $content .= "?>";
  file_put_contents(ROOT_SRC.'/lang/'.$lang.'/products.php', $content);   
  header("Location: ./products.php?mod=lang");  
   
}

if(isset($_POST['config_submit'])){
  //CONFIG
 $content = "<?php \r\n \r\n";
 $content .= " $"."products_config". "= array(\r\n";
    foreach ($products_config as $key =>$value) {
      
      $content .= "'{$key}' => '{$_POST[$key]}',\r\n";
      
     
    }
  $content .="); \r\n \r\n";
  $content .= "?>";
  file_put_contents(ROOT_SRC.'/lang/products_config.php', $content);   
  header("Location: ./products.php?mod=lang");  
   
}
?>


    <!-- CONTENT -->
  <div class="content">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" class="btn-red btn active show" href="#product_lang">Extras</a></li>
          
          <li><a data-toggle="tab" class="btn-red btn" href="#products_config">Config</a></li>
        </ul>
        <div class="tab-content">
          <div id="product_lang" class="tab-pane fade in active show">
            <form method="post" action="">
              <div class="title" style="margin-top: 20px;"><h3>GLOBAL</h3></div>
              <div class="form-row">
                <?php
                foreach ($products_lang as $key => $value) {
                echo "
                <div class='form-group col-md-6'>
                <label for='{$key}'>{$key}</label>
                <input type='text' class='form-control' name='{$key}' id='{$key}' placeholder='' value='{$value}'>
                </div>
                ";
                }
                ?>
              </div>
              <button type="submit" name="extras_submit" class="btn btn-primary">Update Extras</button>
            </form>
          </div>
          
          <div id="products_config" class="tab-pane fade">
            <form method="post" action="">
              <div class="title" style="margin-top: 20px;"><h3>Dự án</h3></div>
              <div class="form-row">
                <?php
                foreach ($products_config as $key => $value) {
                echo "
                <div class='form-group col-md-6'>
                <label for='{$key}'>{$key}</label>
                <input type='text' class='form-control' name='{$key}' id='{$key}' placeholder='' value='{$value}'>
                </div>
                ";
                }
                ?>
              </div>
              <button type="submit" name="config_submit" class="btn btn-primary">Update Config</button>
            </form>
          </div>
      </div>
        </div>
        
    </div>
  </div>

    <!-- CONTENT -->

