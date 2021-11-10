<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<div class="cont">
<div class="tent">

<h1>Dashboard</h1>

<h1>Welkom 
        <?php echo request()->user['voornaam'];?>
</h1>

<p>Dit is je persoonlijke dashboard</p>

<p>
            <a href="<?php echo url('password.form');?>">Wachtwoord veranderen</a>
            </p>
</div>
</div>



