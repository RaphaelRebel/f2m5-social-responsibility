<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/blog.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/dashboard.css' ) ?>" media="all">

<div class="cont">
<div class="tent">

<?php $this->start('title')?>Dashboard<?php $this->stop();?>

<h1>Dashboard</h1>

        <img class="dashboard_image" src="<?php echo site_url('/uploads/' . request()->user['filename'])?>" alt="Blog name: <?php echo site_url('/uploads/' . request()->user['filename'])?>">

<h1>Welkom 
        <?php echo request()->user['voornaam'];?>
</h1>

<p>Dit is je persoonlijke dashboard</p>

<h3>Jouw posts:</h3>
<!-- Hier posts plaatsen -->
<div class="overview">
<?php foreach($topics as $topic):?>
        <div class="blog">
        <img src="<?php echo site_url('/uploads/' . $topic['filename'])?>" alt="Blog photo" /> <br>
                <h3>   <?php echo $topic['title'];?><a href="<?php echo url('topics.story', ['id' => $topic['id']])?>"> Check</a><br> </h3>
                <p>
                        <a href="<?php echo url('story.delete', ['id' => $topic['id']])?>">Delete</a>
                </p>
        </div>
<?php endforeach?>
</div>
<hr>
<p>
<a href="<?php echo url('topics.new')?>">Nieuwe topic toevoegen</a>
        </p>
<p>
            <a href="<?php echo url('password.form');?>">Wachtwoord veranderen</a>
            </p>
</div>
</div>



