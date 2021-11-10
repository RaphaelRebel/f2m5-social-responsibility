<?php $this->layout('layouts::website');?>
<link rel="stylesheet" href="<?php echo site_url( '/css/user.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
<link rel="stylesheet" href="<?php echo site_url( '/css/post.css' ) ?>" media="all">
<div class="cont">
<div class="tent">

<?php $this->start('title')?>Topics<?php $this->stop();?>

<h1>Overzicht topics</h1>


<?php foreach($topics as $topic):?>
    <h3>
<?php echo $topic['title'];?><a href="<?php echo url('topics.details', ['id' => $topic['id']])?>"> Check</a><br>
</h3>
<?php endforeach?>
<hr>

<h4>
<a href="<?php echo url('topics.new')?>">Nieuwe topic toevoegen</a>
</h4>
</div>
</div>