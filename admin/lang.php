
<?php
  define('ROOT_MOD', dirname(__FILE__));
  include "../_layout/admin_header.php";
  include ROOT_SRC."/lang/$lang/global.php";
  include ROOT_SRC."/lang/$lang/contact.php";
  include ROOT_SRC."/lang/$lang/projects.php";
?>

<?php 
  global $connection;
  $query = "SELECT *from company where lang = '".$lang."' order by id DESC limit 0,1";
  $select_com = mysqli_query($connection,$query);
  if(mysqli_num_rows($select_com)){
    if($row = mysqli_fetch_assoc($select_com)){
      $id = $row['id'];
      $name = $row['name'];
      $email = $row['email'];
      $phone = $row['phone'];
      $meta_key = $row['meta_key'];
      $meta_desc = $row['meta_desc'];
      $title = $row['title'];
      $address = $row['address'];
      $website = $row['website'];
      $map = $row['map'];
    }
  } 
?>

<?php
if(isset($_POST['global_submit'])){
  //CONFIG
 $content = "<?php \r\n \r\n";
 $content .= " $"."global_lang". "= array(\r\n";
    foreach ($global_lang as $key =>$value) {
      
      $content .= "'{$key}' => '{$_POST[$key]}',\r\n";
      
     
    }
  $content .="); \r\n \r\n";
  $content .= "?>";
  file_put_contents(ROOT_SRC.'/lang/'.$lang.'/global.php', $content);   
  header("Location: lang.php");  
   
}

if(isset($_POST['contact_submit'])){
  //CONFIG
 $content = "<?php \r\n \r\n";
 $content .= " $"."contact_lang". "= array(\r\n";
    foreach ($contact_lang as $key =>$value) {
      
      $content .= "'{$key}' => '{$_POST[$key]}',\r\n";
      
     
    }
  $content .="); \r\n \r\n";
  $content .= "?>";
  file_put_contents(ROOT_SRC.'/lang/'.$lang.'/contact.php', $content);   
  header("Location: lang.php");  
   
}

if(isset($_POST['projects_submit'])){
  //CONFIG
 $content = "<?php \r\n \r\n";
 $content .= " $"."projects_lang". "= array(\r\n";
    foreach ($projects_lang as $key =>$value) {
      
      $content .= "'{$key}' => '{$_POST[$key]}',\r\n";
      
     
    }
  $content .="); \r\n \r\n";
  $content .= "?>";
  file_put_contents(ROOT_SRC.'/lang/'.$lang.'/projects.php', $content);   
  header("Location: lang.php");  
   
}
?>


    <!-- CONTENT -->
  <div class="content">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" class="btn-red btn active show" href="#global">Global</a></li>
          <li><a data-toggle="tab" class="btn-red btn" href="#contact">Contact</a></li>
          <li><a data-toggle="tab" class="btn-red btn" href="#projects">Dự án</a></li>
        </ul>
        <div class="tab-content">
          <div id="global" class="tab-pane fade in active show">
            <form method="post" action="">
              <div class="title" style="margin-top: 20px;"><h3>GLOBAL</h3></div>
              <div class="form-row">
                <?php
                foreach ($global_lang as $key => $value) {
                echo "
                <div class='form-group col-md-6'>
                <label for='{$key}'>{$key}</label>
                <input type='text' class='form-control' name='{$key}' id='{$key}' placeholder='' value='{$value}'>
                </div>
                ";
                }
                ?>
              </div>
              <button type="submit" name="global_submit" class="btn btn-primary">Update Global</button>
            </form>
          </div>
          <div id="contact" class="tab-pane fade">
            <form method="post" action="">
              <div class="title" style="margin-top: 20px;"><h3>CONTACT</h3></div>
              <div class="form-row">
                <?php
                foreach ($contact_lang as $key => $value) {
                echo "
                <div class='form-group col-md-6'>
                <label for='{$key}'>{$key}</label>
                <input type='text' class='form-control' name='{$key}' id='{$key}' placeholder='' value='{$value}'>
                </div>
                ";
                }
                ?>
              </div>
              <button type="submit" name="contact_submit" class="btn btn-primary">Update Contact</button>
            </form>
          </div>
          <div id="projects" class="tab-pane fade">
            <form method="post" action="">
              <div class="title" style="margin-top: 20px;"><h3>Dự án</h3></div>
              <div class="form-row">
                <?php
                foreach ($projects_lang as $key => $value) {
                echo "
                <div class='form-group col-md-6'>
                <label for='{$key}'>{$key}</label>
                <input type='text' class='form-control' name='{$key}' id='{$key}' placeholder='' value='{$value}'>
                </div>
                ";
                }
                ?>
              </div>
              <button type="submit" name="projects_submit" class="btn btn-primary">Update Projects</button>
            </form>
          </div>
      </div>
        </div>
        
    </div>
  </div>

    <!-- CONTENT -->

<?php include "../_layout/admin_footer.php"; ?>
