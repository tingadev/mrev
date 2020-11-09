

<!-- CONTENT -->
<div class="content">
    <div class="row">
        <div class="col-12">
            <h3>QUẢN LÝ MAIL TEMPLATE</h3>
            <form action="" method="post">
                
                
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                            <th>ID</th>
                            <th>Title</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            global $connection;
                                
                            $query = "SELECT *from mail_template where lang = '$lang'";
                            $select= mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select)){
                                $title = $row['title'];                               
                                $id=$row['m_id'];
                                
                                
                                ?>  
                                
                                <tr>
                                    <td width="5%"><input class="checkBoxes" type='checkbox' name="checkBoxArray[]" value="<?php echo $id; ?>"></td>
                                    <td width="10%"><?php echo $id; ?></td>
                                    <td><a href="modules/mail_template/mail_template.php?act=update&id=<?php echo $id; ?>"><?php echo $title; ?></a></td>
                                    
                                    <td class='td-actions text-right'>
                                        
                                        <button onclick="location.href='modules/mail_template/mail_template.php?act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
                                            <i class='tim-icons icon-settings'></i>
                                        </button>
                                        
                                    </td>
                                 </tr>

                                   

                                  
                           <?php } 

                         ?>
                                   
                                   
                                     

                        
                            
                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div>

    <!-- CONTENT -->


    <!-- DATABASE -->




