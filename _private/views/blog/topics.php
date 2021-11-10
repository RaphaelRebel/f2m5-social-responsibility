<?php $this->layout('layouts::website');?>

<?php $this->start('title')?>Topics<?php $this->stop();?>

<h1>Overzicht topics</h1>

<?php foreach($topics as $topic):?>
<?php echo $topic['title'];?><a href=""> Edit</a><br>
<?php endforeach?>

<hr>

<p>
<a href="<?php echo url('topics.new')?>">Nieuwe topic toevoegen</a>
</p>