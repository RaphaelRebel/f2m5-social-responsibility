<?php $this->layout('layouts::website');?>

<?php $this->start('title')?>Admin<?php $this->stop();?>

<h1>Welkom <?php echo request()->user['voornaam']?></h1>

<p>
    Dit is de admin page
</p>

<p><a href="<?php echo url('topics.index')?>">Vind je posts hier</a></p>