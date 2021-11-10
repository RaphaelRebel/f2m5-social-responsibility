<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/post.css' ) ?>" media="all">
<div class="cont">
<div class="tent">
<h2>Wachtwoord vergeten</h2>

<?php if( ! $mail_sent): ?>
<p>Vul hier je e-mail adres in en we sturen je een wachtwoord reset link</p>

<form id="inlog" action = "<?php echo url('password.form')?>" method="POST">
           <p> E-mail</p>
           <input class="form-control" type="email" name="email" placeholder="E-mail" value="<?php echo input('email')?>" required>*<br>
           <?php if (isset ($errors['email'] ) ): ?>
            <!-- werkt niet!!! -->
          <span class='error'> <?php echo $errors['email']; ?> </span>
            <?php endif;?></br>
            <input class="submit" type ="submit" value = "Reset wachtwoord">
 </form>

           <?php else: ?>
            <h4>De mail is verstuurd met de reset link</h4>
           <?php endif; ?>

</div>
</div>