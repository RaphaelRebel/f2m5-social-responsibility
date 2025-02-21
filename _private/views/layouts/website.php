<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <?php if ($this->section('css')) : ?>
        <?php echo $this->section('css') ?>
    <?php endif; ?>
</head>

<body>
    <nav>
        <h2><a href="<?php echo url('home') ?>"><img class="" src="/images/Tc.png" alt="Logo"></a></h2>
        <?php if ($this->section('navigation')) : ?>
            <?php echo $this->section('navigation') ?>
        <?php else : ?>
            <?php echo $this->fetch('main/_navigation') ?>
        <?php endif ?>
    </nav>
    <div>
        <!-- <header>
        <h1><?php include('/text/paste.php') ?></h1>
    </header> -->

        <main>
            <section class="content">
                <?php echo $this->section('content') ?>
            </section>

        </main>
            <footer>

        <div class="footer-3">

            <div class="footer-content1"><img class="" src="/images/Tc-b.png" alt="Logo"></div>
            <div class="footer-content2"><h3>Mighty networks</h3></div>
            <div class="footer-content3"><h3>Terms of use - Privacy Policy</h3></div>

        </div>

    </footer>
    </div>
    <?php $this->start('javascript') ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <?php $this->stop(); ?>
</body>

</html>