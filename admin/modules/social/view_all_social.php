<!-- CONTENT -->
      <div class="content">
        <div class="row">

          <div class="col-12">
            <h3>QUẢN LÝ SOCIAL NETWORK</h3>
            <table class="table">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th>Name</th>
            <th>link</th>
            <th>Title</th>
            <th>Icon</th>
            <th>Display Order</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            global $connection;
                
            $query = "select * from social";
            $select= mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select)){
                $name=$row['name'];
                $id= $row['id'];
                $link =$row['link'];
                $title =$row['title'];
                $icon =$row['icon'];
                $display_order =$row['display_order'];
               
                ?>
                
                
                <tr>
                            <td class='text-center'><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $link; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $icon; ?></td>
                            <td><?php echo $display_order; ?></td>
                           
                            <td class='td-actions text-right'>
                                <button type='button' rel='tooltip' class='btn btn-info btn-link btn-icon btn-sm'>
                                    <i class='tim-icons icon-single-02'></i>
                                </button>
                                <button onclick="location.href='modules/social/social.php?act=update&id=<?php echo $id; ?>'" type='button' rel='tooltip' class='btn btn-success btn-link btn-icon btn-sm'>
                                    <i class='tim-icons icon-settings'></i>
                                </button>
                               <a rel='<?php echo $id; ?>' href='javascript:void(0)' class='delete_link' class='btn btn-danger btn-link btn-icon btn-sm'>
                                                            <i class='tim-icons icon-simple-remove'></i>
                                                        </a>
                            </td>
                     </tr>

                   

                  
           <?php } 

         ?>
                   
                   
                     

        
        
    </tbody>
</table>
        </div>
       
        
      </div>
    </div>

    <!-- CONTENT -->

     <?php

        if(isset($_GET['delete']))
        {

        $delete_id = $_GET['delete'];
          if($_SESSION['role'] == 'admin')
              {
                $query = "DELETE FROM social WHERE id = $delete_id";               
                $delete_query = mysqli_query($connection,$query);
                
                header("Location: ./social.php");

              }

            }
        ?>                  
                     
<script>
                            
    $(document).ready(function(){
        
        $(".delete_link").on('click',function(){
            
           var id =$(this).attr('rel'); 
            
            var delete_url = "modules/social/social.php?delete="+ id +"";

            
            $(".modal_delete_link").attr('href',delete_url);
            
            
            $('#myModal').modal('show');
        });
    });

</script>

