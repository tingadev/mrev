<?php 
// INSERT DATA
function insert($table, $data, $exclude = array()) {
    global $connection;
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "`$key`";
            // print_r($data[$key]) ; die;
            $values[] = "'" . mysqli_real_escape_string($connection,$data[$key]) . "'";
        }
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    $query = "INSERT INTO `$table` ($fields) VALUES ($values)";
    // die($query);
    $result= mysqli_query($connection,$query);
    if($result) {
        return array( "mysqli_error" => false,
                      "mysqli_insert_id" => mysqli_insert_id($connection),
                      "mysqli_affected_rows" => mysqli_affected_rows($connection),
                      "mysqli_info" => mysqli_info($connection)
                    );
    } else {
        return array( "mysqli_error" => mysqli_error($connection) );
    }
}
// UPDATE DATA
function update($table, $data, $id_field, $id_value) {
    global $connection;
    foreach ($data as $field=>$value) {
        $fields[] = sprintf("`%s` = '%s'", $field, mysqli_real_escape_string($connection,$value));
    }
    $field_list = join(',', $fields);
    
    $query = sprintf("UPDATE `%s` SET %s WHERE `%s` = %s", $table, $field_list, $id_field, intval($id_value));
    // die($query);
    $result= mysqli_query($connection,$query);
    if($result) {
        return array( "mysqli_error" => false,
                      "mysqli_affected_rows" => mysqli_affected_rows($connection),
                      "mysqli_info" => mysqli_info($connection)
                    );
    } else {
        return array( "mysqli_error" => mysqli_error($connection) );
    }
}

function getIDSEO($title, $lang='vn') {
    global $connection;
    $id="";
    $query_seo = "SELECT *from seo_url where url = '$title' and lang ='".$lang."'";
    $select_seo = mysqli_query($connection,$query_seo);
      if($select_seo){
        if($row = mysqli_fetch_assoc($select_seo)) {
            $id = $row['id'];
        }
    }
  
    return $id;
}
function checkTitleSEO($title, $lang='vn') {
    global $connection;
    $query_seo = "SELECT *from seo_url where url = '$title' and lang ='".$lang."'";
    // die($query_seo);
    $select_seo = mysqli_query($connection,$query_seo);
    $countrows = mysqli_num_rows($select_seo);
    if($countrows==0){
        return true;
    }
    else{
        return false;  
        
    }  
}
?>

<?php

function escape($string){
    global $connection;
    
    return mysqli_real_escape_string($connection,trim($string));
    
}


?>
<?php 
    function users_online(){
        
        if(isset($_GET['onlineusers'])){
            
         global $connection;
            
            
            if(!$connection){
                
                session_start();
                
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "qc";

foreach ($db as $key => $value){
    
    define(strtoupper($key),$value);
    
    
}

$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


if(!$connection)
{
    
    echo "Connect Database failed!";
    
}
                
                $session=session_id();
                $time = time();
                $time_out_in_seconds=30;
                $time_out=$time - $time_out_in_seconds;

                $query="select *from users_online where session='{$session}'";
                $send_query=mysqli_query($connection,$query);
               
                $count=mysqli_num_rows($send_query);

                if($count==NULL){

                    $test_query1=mysqli_query($connection,"insert into users_online(session,time) values('$session','$time')" );
                   
                }
                else{

                    mysqli_query($connection,"UPDATE users_online set time= '$time' where session = '$session'");
                }
                $users_online_query=mysqli_query($connection,"select *from users_online where time > '$time_out'");
               
                echo $count_user=mysqli_num_rows($users_online_query);

            }

                
        }
            
 }

users_online();

?>

<?php 
    function confirmQuery($result){
        
        global $connection;
        if(!$result){
            
           die ("QUERY FAILED!" . mysqli_error($connection));
        
        }
        else{
            return true;
        }
       
    }
    


?>

<?php

    function FindAllData(){
        
        global $connection;
        

            $query = "SELECT * FROM category";
            $select_category = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_category)){

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];


                echo "<tr>";   
                echo "<td>{$cat_id}</td>";
                echo "<td><a href='#'>{$cat_title}</a></td>";
                echo "<td><a href='categories.php?delete={$cat_id}' '>Delete</a></td>";
                echo "<td><a href='categories.php?edit={$cat_id}' '>Edit</a></td>"; 
                echo "</tr>";  
            }

                                       
                     
    }





?>

<?php

    function AddTitleCategories(){
        
        global $connection;
        
             if(isset($_POST['submit'])){
                               
                $cat_title = $_POST['cat_title'] ;
                if($cat_title == "" || empty($cat_title))
                {
                    echo "This field should not be empty!";
                }
                else
                {
                    $query = "INSERT into category(cat_title)";
                    $query.= "VALUES('{$cat_title}')";

                    $create_category_query= mysqli_query($connection,$query);

                    if(!$create_category_query){

                        die('QUERY FAILED!' .mysqli_error($connection));
                    }
                }
            }                                      
                     
    }


?>


<?php

    function PutTitleToInput(){
        
        global $connection;
        
             
        if(isset($_GET['edit'])){
            
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM category where cat_id =$cat_id";
            $select_category_id = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_category_id)){

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
             ?>


        <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" name="cat_title" class=" form-control">



<?php    }    }         
                     
    }


?>


<?php

    function DeleteRow(){
        
        global $connection;
        
        if(isset($_GET['delete'])){
                                            
            $the_cat_id = $_GET['delete'];

            if($the_cat_id)
            {
                $query = "DELETE FROM category WHERE cat_id = {$the_cat_id}";

                $delete_category = mysqli_query($connection,$query);

                if(!$delete_category)
                {
                    die("QUERY FAILED" . mysqli_error($connection) );

                }
               
            }

        }
                                        
                                        
    }


?>
<?php

    function UpdateRow(){
        
        global $connection;
        
    if(isset($_GET['edit'])){

        $the_cat_id = $_GET['edit'];
        

        
    if(isset($_POST['update_category'])){

        $edit_cat_title = $_POST['cat_title'];
        
        $query = "UPDATE category SET cat_title = '{$edit_cat_title}' WHERE cat_id ={$the_cat_id} ";
        $edit_category_query = mysqli_query($connection,$query);
        if(!$edit_category_query){

            die ("QUERY FAILED" . mysqli_error($connection));


        }

    }                                      
        }                                    
}


?>



<?php

function make_thumb($src, $dest, $desired_width = false, $desired_height = false) {
    
    /* If no dimenstion for thumbnail given, return false */    
    if (!$desired_height && !$desired_width)
        return false;
    
    $fparts = pathinfo($src);
    $ext = strtolower($fparts['extension']);
    
    /* if its not an image return false */
    if (!in_array($ext, array(
            'gif',
            'jpg',
            'png',
            'jpeg',
        )))
        return false;

    /* read the source image */
    if ($ext == 'gif')
        $resource = imagecreatefromgif($src);
    else if ($ext == 'png')
        $resource = imagecreatefrompng($src);
    else if ($ext == 'jpg' || $ext == 'jpeg')
        $resource = imagecreatefromjpeg($src);

    $width = imagesx($resource);
    $height = imagesy($resource);
    
    /* find the “desired height” or “desired width” of this thumbnail, relative
     * to each other, if one of them is not given */
    if (!$desired_height)
        $desired_height = floor($height * ($desired_width / $width));
    
    if (!$desired_width)
        $desired_width = floor($width * ($desired_height / $height));

    /* create a new, “virtual” image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    
    switch ($ext)
    {
    case "png":
        // integer representation of the color black (rgb: 0,0,0)
        $background = imagecolorallocate($virtual_image, 0, 0, 0);
        
        // removing the black from the placeholder
        imagecolortransparent($virtual_image, $background);

        // turning off alpha blending (to ensure alpha channel information 
        // is preserved, rather than removed (blending with the rest of the 
        // image in the form of black))
        imagealphablending($virtual_image, false);

        // turning on alpha channel information saving (to ensure the full range 
        // of transparency is preserved)
        imagesavealpha($virtual_image, true);

        break;
    case "gif":
        // integer representation of the color black (rgb: 0,0,0)
        $background = imagecolorallocate($virtual_image, 0, 0, 0);
        
        // removing the black from the placeholder
        imagecolortransparent($virtual_image, $background);

        break;
    }

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $resource, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    /* Use correct function based on the desired image type from $dest thumbnail
     * source */
    $fparts = pathinfo($dest);
    $ext = strtolower($fparts['extension']);
    /* if dest is not an image type, default to jpg */
    if (!in_array($ext, array(
            'gif',
            'jpg',
            'png',
            'jpeg'
        )))
        $ext = 'jpg';
    $dest = $fparts['dirname'] . '/' . $fparts['filename'] . '.' . $ext;

    if ($ext == 'gif')
        imagegif($virtual_image, $dest);
    else if ($ext == 'png')
        imagepng($virtual_image, $dest, 1);
    else if ($ext == 'jpg' || $ext == 'jpeg')
        imagejpeg($virtual_image, $dest, 100);

    return array(
        'width' => $width,
        'height' => $height,
        'new_width' => $desired_width,
        'new_height' => $desired_height,
        'dest' => $dest
    );
}

?>