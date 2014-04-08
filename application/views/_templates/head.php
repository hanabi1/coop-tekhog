<!DOCTYPE html>
<html lang="sv">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
        <meta name="description" content="">
        
        <title><?php if($title):?>
                    <?php echo ucfirst($title) . ' &middot; Samhällssår' ;?>
                <?php else:?>
                    <?php echo 'Samhällssår';?>
                <?php endif;?>
        </title>
        
        <!-- jQuery -->
        <script src="<?php echo URL; ?>public/js/jquery-1.11.0.min.js"></script>
        
        <!-- Bootstrap -->
        <link href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Bootstrap Theme -->
        <link href="<?php echo URL; ?>public/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">    
        
        <!-- CSS -->
        <link href="<?php echo URL; ?>public/css/meyerReset.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/jquery.bxslider.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/jquery-ui.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/css.less" rel="stylesheet">
        
        <!-- Google Fonts -->        
        <link href='http://fonts.googleapis.com/css?family=Rosarivo' rel='stylesheet' type='text/css'>  
        
        <!-- JavaScript -->
        <script src="<?php echo URL; ?>public/js/application.js"></script>
        
        <!-- Videoslider script -->
        <script src="<?php echo URL; ?>public/js/jquery.bxslider.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.bxslider.min.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.easing.1.3.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.fitvids.js"></script>

        <!-- CSS3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
         
    </head>
    <body>