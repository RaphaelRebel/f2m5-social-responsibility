<?php $this->layout('layouts::website');?>

<h1>Dashboard</h1>

<h1>Welkom 
        <?php echo request()->user['voornaam'];?>
</h1>

<p>Dit is je persoonlijke dashboard</p>

<p>
            <a href="<?php echo url('password.form');?>">Wachtwoord veranderen</a>
            </p>




