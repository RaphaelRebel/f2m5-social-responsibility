<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<div class="cont">
<div class="tent">
    
<img src="<?php echo site_url('/uploads/' . $topic['filename'])?>" alt="Blog photo" /> <br>
<h2><?php echo $story['title'];?></h2> <hr>
<p><?php echo $story['description'];?></p>

</div> 
</div>