<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<div class="cont">
<div class="tent">

<?php $this->start('title')?>Admin<?php $this->stop();?>

<h1>Welkom <?php echo request()->user['voornaam']?></h1>

<p>
    Dit is de admin page
</p>

<p><a href="<?php echo url('topics.index')?>">Vind je posts hier</a></p>

<p>Accepteer user's</p>

<?php foreach($absolute_url as $url):?>
    <p>
        <?php echo $url ?>
    </p>
    <?php endforeach?>
</div>
</div>