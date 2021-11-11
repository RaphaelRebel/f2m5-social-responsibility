<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/blog.css' ) ?>" media="all">
<div class="cont">
<div class="tent">

<?php $this->start('title')?>Dashboard<?php $this->stop();?>

<h1>Dashboard</h1>

<h1>Welkom 
        <?php echo request()->user['voornaam'];?>
</h1>

<p>Dit is je persoonlijke dashboard</p>

<h3>Jouw posts:</h3>
<!-- Hier posts plaatsen -->


<p>
            <a href="<?php echo url('password.form');?>">Wachtwoord veranderen</a>
            </p>
</div>
</div>



