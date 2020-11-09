
<?php

if(isset($_GET['id'])){
    
    $pro_id = $_GET['id'];
    
    $query = "select *from table_product where id = $pro_id";
    $select_pro_query = mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($select_pro_query)){
        $pro_title=$row['ten'];
        $pro_dec=$row['mota'];
        $pro_cat=$row['id_list'];
        $pro_stt=$row['id_item'];
        $pro_key=$row['keywords'];
        $pro_img=$row['thumb'];
        $pro_content=$row['noidung'];
        
    }

}


?>
   



  
  
  
   
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">     
            <label for="img_title">Tên dự án</label>
            <input type="text" name="pro_title" class="form-control" value="<?php echo $pro_title; ?>">
        </div>
        <div class="form-group">     
            <label for="img_title">Danh mục dự án</label>
            <select name="pro_cat" id="">
               <?php
				if($pro_cat==23){
					echo "
					<option value='23' selected>Công trình dân dụng</option>
                	<option value='24'>Nhà tiền chế</option>"; 
				}
				
				?>
                
            </select>
        </div>
        <div class="form-group">     
            <label for="pro_stt">STT</label>
            <input type="text" name="pro_stt" class="form-control" value="<?php echo $pro_stt; ?>">
        </div>
        <div class="form-group">     
            <label for="pro_dec">Mô tả ngắn</label>
            <input type="text" name="pro_dec" class="form-control" value="<?php echo $pro_dec; ?>">
        </div>
        
        <div class="form-group">
            <label for="pro_key">keywords</label>
            <input type="text" name="pro_key" class="form-control" value="<?php echo $pro_key; ?>">
        </div>  
        
        <div class="form-group">
            <label for="pro_img">Hình ảnh</label>
            <input type="file" name="pro_img" class="form-control" value="<?php echo $pro_img; ?>">
        </div> 
        
        <div class="form-group">
            <label for="pro_content">Nội dung</label>
			<textarea name="pro_content" class="form-control" value=""><?php echo $pro_content; ?></textarea>
        </div>
        <div class="form-group">
        	<input type="submit" value="Update Project" name="update_project" class="btn btn-primary">
        </div>
    </form>



  

<?php

    if(isset($_POST['update_project'])){
		$pro_stt_up=$_POST['pro_stt'];
        $pro_title_up=$_POST['pro_title'];
        $pro_cat_up=$_POST['pro_cat'];
        $pro_source_up=$_FILES['pro_img']['name'];
        $pro_source_temp_up=$_FILES['pro_img']['tmp_name'];
        $pro_dec_up=$_POST['pro_dec'];
        $pro_key_up=$_POST['pro_key'];
        $pro_content_up=escape($_POST['pro_content']);

//        move_uploaded_file($pro_source_temp_up,"../4-images/img/$pro_source_up");
        

        if($pro_source_up=="" || empty($pro_source_up)){
           BUSupdatePro0($pro_id,$pro_stt_up,$pro_title_up,$pro_cat_up,$pro_dec_up,$pro_content_up,$pro_key_up);
        }
        else{
            BUSupdatePro1($pro_id,$pro_stt_up,$pro_title_up,$pro_cat_up,$pro_dec_up,$pro_content_up,$pro_source_up,$pro_key_up);
        }
        

    }


?>