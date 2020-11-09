

<div class="box_banner">
  <div class="banner" id="slick_banner">
    <?php

global $connection;
$query = "SELECT *from banner where pos = 'banner' and display= 1 order by display_order ASC, id DESC";
$select = mysqli_query($connection,$query);
if(mysqli_num_rows($select)){
  while ($row = mysqli_fetch_assoc($select)) {
    ?>
    <div class="item">
        <div class="img">
          <img src="uploads/weblink/<?php echo $row['src']; ?>" alt="<?php echo $row['title']; ?>">
        </div>
      </div>

    <?php
  }
}

?>
      
      </div>
     <div class="scroll">
        <p><?php echo $global_lang['scroll'] ?></p>
        <img src="4-images/mrev_scroll.png" alt="">
      </div>
</div>
