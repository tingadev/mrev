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

function make_thumb($src, $dest, $desired_width) {

	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}


?>