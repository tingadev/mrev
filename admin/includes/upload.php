
<?php include "../config.php"; ?>
<?php
// base directory
if(isset($_GET['ajax'])){
    $ajax_name = $_GET['ajax'];
    switch ($ajax_name) {
        case 'upload':
            upload();
            break;
        
         case 'del_img':
          
            delete_img();
            break;
    }
    
}

function upload(){
    $base_dir = dirname(dirname(__DIR__));

    // server protocol
    $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

    // domain name
    $domain = $_SERVER['SERVER_NAME'];
    $doc_root = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']);
    // base url
    $base_url = preg_replace("!^${doc_root}!", '', $base_dir);

    // server port
    $port = $_SERVER['SERVER_PORT'];
    $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

    // put em all together to get the complete base URL
    $url = "${protocol}://${domain}${disp_port}${base_url}";

    define('ROOT_P',$base_dir);
    define('ROOT_SRC',$base_url);
    // echo ROOT_P; die;
    if(isset($_FILES['images']) && !empty($_FILES['images'])){
        // File upload configuration

        $targetDir = ROOT_P."/uploads/products/";
        // die($targetDir);
        $allowTypes = array('jpg','JPG','png','jpeg','gif');
        // $images = $_POST['images'];
        $images_arr = array();
        foreach($_FILES['images']['name'] as $key=>$val){
            $image_name = $_FILES['images']['name'][$key];
            $tmp_name   = $_FILES['images']['tmp_name'][$key];
            $size       = $_FILES['images']['size'][$key];
            $type       = $_FILES['images']['type'][$key];
            $error      = $_FILES['images']['error'][$key];
            
            // File upload path
            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            $src = $fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
             
            if(in_array($fileType, $allowTypes)){ 

                // Store images on the server
                if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                    $images_arr[] = $src; 
                }
            }
        }
        $root = ROOT_SRC."/uploads/products/";
        // echo $src; die;
        // Generate gallery view of the images
        
        if(!empty($images_arr)){ ?>
            
                
            <?php
            $i=0;
            foreach($images_arr as $image_src){
                ?>
                    <li><img src="<?php echo $root.$image_src; ?>" alt="">
                        <input type="hidden" name="img[]" value="<?php echo $image_src; ?>">
                        <div class="close_img" onclick="delele_img(this);"></div>
                    </li>
                <?php
                $i++;  
                } ?>
           
    <?php }
    }
}
function delete_img(){
   $mess = "ok";
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $lang = $_POST['lang'];
        global $connection;
        $query = "DELETE from product_images where id = $id and lang ='".$lang."'";
        $delele = mysqli_query($connection,$query);
        
    }
}
?>