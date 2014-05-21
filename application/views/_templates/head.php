<!DOCTYPE html>
<html lang="sv">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
        <meta name="description" content="">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        
        <title><?php if($title):?>
                    <?php echo ucfirst($title) . ' &middot; Samhällssår' ;?>
                <?php else:?>
                    <?php echo 'Samhällssår';?>
                <?php endif;?>
        </title>
        
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-50893517-1', 'samhallssar.se');
          ga('send', 'pageview');

        </script>        

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
        <link href="<?php echo URL; ?>public/css/responsive.css" rel="stylesheet">
        
        <!-- Google Fonts -->        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,700' rel='stylesheet' type='text/css'>  
        
        <!-- JavaScript -->
        <script src="<?php echo URL; ?>public/js/application.js"></script>
        
        <!-- Videoslider script -->
        <script src="<?php echo URL; ?>public/js/jquery.bxslider.js"></script>
        <!--<script src="<?php echo URL; ?>public/js/jquery.bxslider.min.js"></script>-->
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