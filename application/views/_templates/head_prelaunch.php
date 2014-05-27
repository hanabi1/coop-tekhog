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
        <link href="<?php echo URL; ?>public/css/style_prelaunch.css" rel="stylesheet">
        
        <!-- Google Fonts -->        
        <link href='http://fonts.googleapis.com/css?family=Rosarivo' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>  
        
        <!-- JavaScript -->
        <script src="<?php echo URL; ?>public/js/application_prelaunch.js"></script>

        <!--Google Analytics-->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-50893517-1', 'samhallssar.se');
          ga('send', 'pageview');

        </script>  

        <!--Countdown script & css-->
        <script src="<?php echo URL; ?>public/js/countdown.js"></script>
        <link href="<?php echo URL; ?>public/css/countdown.css" rel="stylesheet">
        
        <!-- CSS3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
         
    </head>
    <body>