<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>

    <meta charset="<?php bloginfo(' charset ') ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <meta name="description" content="<?php bloginfo( 'description' )?>">
    <!-- link google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300;400;500;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div class="upper_bar">
      <div>
        <span>contact us: contact@contact.com</span>
        <span>call us: +6623665235</span>
      </div>
      <div class="upper_bar_btns">
        <?php if(is_user_logged_in()) { ?>
          <a href="<?php echo esc_url(site_url("/notes")) ?>">my notes</a>
            <a href="<?php echo wp_logout_url("/wordev") ?>" class="avatar_btn">
            <span class="user_avatar" ><?php echo get_avatar(get_current_user_id(), 15) ?></span>
            <span>log out</span>
          </a> 
        <?php }  else { ?>
          <a href="<?php echo wp_login_url() ?>">login</a>
          <a href="<?php echo wp_registration_url(); ?>">sign up</a>
         <?php } ?>
      </div> 
    </div>
    <header class="main_header pd">
      <div class="logo">
      <?php the_custom_logo() ?>
      </div>
      <?php  wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => 'nav',
      )) ?>
      <div class="cta_btn">
        <a href="#" class="btn">subscribe</a
        ><a href="#" class="btn"
          ><img src="<?php echo get_theme_file_uri ("src/assets/svg/paypal.svg") ?>" alt="" />donate</a
        >
      </div>
      <div class="search_btn">
        <i class="fas fa-search"></i>
      </div>
    </header>