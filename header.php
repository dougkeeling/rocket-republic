<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
          <?php if(is_front_page()) { ?>
            <?php the_field('site_title', 'option'); ?> 
            <?php } else { ?>
            <?php the_field('seo_page_title'); ?> | <?php the_field('site_title', 'option'); ?> 
          <?php } ?>
        </title>
        
        <meta name="description" content="<?php if(is_front_page()) { the_field('site_description', 'option'); } else {  the_field('meta_description'); } ?>">

        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css">
        
        <?php wp_head(); ?>

        <!-- FitVids  
        <script src="<?php bloginfo('template_directory'); ?>/js/modules/fitvids/jquery.fitvids.js"></script> -->

        <!-- Background Stretch  
        <script src="<?php bloginfo('template_directory'); ?>js/modules/anystretch/jquery.anystretch.min.js"></script> -->

        <!-- Background Stretch 
        <script src="jquery.fittext.js"></script> -->

        <!-- Favicons
        ================================================== -->
        <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.png">
        <link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/img/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/img/apple-touch-icon-144x144.png">

        <script>
          jQuery(document).ready(function($) {
              // Inside of this function, $() will work as an alias for jQuery()
              // and other libraries also using $ will not be accessible under this shortcut

              //$(".something").anystretch("url");

              //$(".something").fitVids();

              //$("#fittext1").fitText();

              /* Mobile Menu */
              ('.show-mobile-menu').click(function() {
                  $(this).attr('style', '').toggleClass('active');
                  $('nav > ul').slideToggle('slow', function() {
                      $(this).attr('style', '').toggleClass('hide');
                  });
              });

              $('nav.mobile-nav ul li ul.sub-menu').parent().prepend('<span class="dropdown">+</span>');
              $('span.dropdown').click(function() {
                $(this).parent().children('.sub-menu').slideToggle();
                $(this).text($(this).text() == '+' ? '–' : '+');
              });
              /* End Mobile Menu */
          });
        </script>
        
    </head>

    <body>
      <header>
        <h1 id="logo"><a href="<?php bloginfo('url'); ?>"></a></h1>
        <nav class="clearfix mobile-nav hide-desktop">
            <div class="show-mobile-menu"><span><i></i><i></i><i></i></span>Menu</div>
            <?php wp_nav_menu( array(
            'theme_location' => 'mobile', 
            'container' => false, 
            'items_wrap' => '<ul class="hide">%3$s</ul>' 
            ) ); ?>
        </nav>

        <nav class="clearfix hide-mobile">
            <?php wp_nav_menu( array(
            'theme_location' => 'primary', 
            'container' => false, 
            'items_wrap' => '<ul>%3$s</ul>'
            ) ); ?>
        </nav>
        <div class="clear"></div>
      </header>