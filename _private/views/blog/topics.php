<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/blog.css' ) ?>" media="all">
<div class="cont">
<div class="tent">

<?php $this->start('title')?>Topics<?php $this->stop();?>

<h1>Overzicht topics</h1>

<hr>

<div class="overview">
<?php foreach($topics as $topic):?>
    <div class="blog">
    <img src="<?php echo site_url('/uploads/' . $topic['filename'])?>" alt="Blog photo" /> <br>
        <h3>
<?php echo $topic['title'];?><a href="<?php echo url('topics.story', ['id' => $topic['id']])?>"> Check</a><br>
</h3>
<p>
    Made by
    <?php echo $topic['user_id'];?>
</p>
</div>
<?php endforeach?>
</div>
<hr>

<h4>
<a href="<?php echo url('topics.new')?>">Nieuwe topic toevoegen</a>
</h4>
</div>
</div>