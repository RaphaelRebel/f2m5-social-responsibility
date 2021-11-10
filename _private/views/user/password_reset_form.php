<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/post.css' ) ?>" media="all">
<div class="cont">
<div class="tent">

<h2>Wachtwoord resetten</h2>

<p>Vul je nieuwe wachtwoord in</p>

<form id="inlog" action = "<?php echo url('password.reset', ['reset_code' => $reset_code])?>" method="POST">
           <p> Wachtwoord</p>
           <input class="form-control" type="password" name="password" placeholder="Password" required>
           <br>
           <input class="form-control" type="password" name="password_confirm" placeholder="Confirm password" required>
           <?php if (isset ($errors['password'] ) ): ?>
            <?php echo $errors['password']; ?>
            <?php endif;?>
            <br><br>
            <input class="submit" type ="submit" value = "Inloggen!">
 </form>

</div>
</div>
