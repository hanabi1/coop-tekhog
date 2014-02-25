<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php if($title):?>
                    <?php echo ucfirst($title) . ' &middot; Samhällssår' ;?>
                <?php else:?>
                    <?php echo 'Samhällssår';?>
                <?php endif;?>
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- jQuery -->
        <script src="<?php echo URL; ?>public/js/jquery-1.11.0.min.js"></script>
        <!-- Bootstrap -->
        <link href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Theme -->
        <link href="<?php echo URL; ?>public/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">    
        <!-- css -->
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
        <!-- our JavaScript -->
        <script src="<?php echo URL; ?>public/js/application.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Rosarivo' rel='stylesheet' type='text/css'>   
    </head>
    <body>