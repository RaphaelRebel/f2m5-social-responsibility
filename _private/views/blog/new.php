<?php $this->layout('layouts::website');?>

<?php $this->start('title')?>Nieuwe topic<?php $this->stop();?>

<h1>Nieuwe topic</h1>

<form action="<?php echo url('topics.save')?>" method="POST" enctype="multipart/form-data">
            <!-- Hier komt de titel -->
            <p> Title</p>
           <input class="form-control" type="title" name="title" placeholder="title" value="<?php echo input('title')?>" required>*<br>
           <?php if (isset ($errors['title'] ) ): ?>
            <?php echo $errors['title']; ?>
            <?php endif;?></br>
            <!-- Hier komt de description -->
            <p>Description</p>

            <textarea class="form-control" name="description" id="description" ><?php echo input('description')?></textarea>    

            *<br>

           <?php if (isset ($errors['description'] ) ): ?><?php echo $errors['description']; ?> <?php endif;?></br>

            <p>Image</p>
            <input type="file" class="form-control" name="upload" id="upload" /><?php echo input('upload')?>   
            *<br>
            <?php if (isset ($errors['upload'] ) ): ?><?php echo $errors['upload']; ?> <?php endif;?></br>    
    <button type="submit">Opslaan</button>
</form>

<hr>

<p>
<a href="<?php echo url('topics.index')?>">Terug naar overzicht</a>
</p>