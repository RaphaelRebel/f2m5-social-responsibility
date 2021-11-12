<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/blog.css' ) ?>" media="all">
<div class="cont">
<div class="tent">

<img class="foto" src="<?php echo site_url('/uploads/' . $story['filename'])?>" alt="Blog photo" /> <br>

<h2><?php echo $story['title'];?></h2> <hr>
<p><?php echo $story['description'];?></p>

</div> 
</div>