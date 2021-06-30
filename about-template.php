<?php
/*
* Template Name: About template
*/

get_header(); 
page_banner();
?>
    <section class="about_me pd">
      <div class="main_img">
        <img src="<?php echo get_theme_file_uri("src/assets/img/about_photo.jpg") ?>" alt="moul lpodcast" />
      </div>
      <div class="about_text">
        <h2>
          <?php echo get_theme_mod('page-about-headline'); ?>
        </h2>
        <p>
        <?php echo get_theme_mod('page-about-text') ?>
        </p>
      </div>
    </section>

    <!-- featured with -->
    <section class="featured pd">
      <h2 class="section_heading">I Have Been Featured in</h2>
      <div class="companies">
        <img src="<?php echo get_theme_file_uri("src/assets/img/featured/amara.jpg") ?>" alt="" /><img
          src="<?php echo get_theme_file_uri("src/assets/img/featured/aven.jpg") ?>"
          alt=""
        /><img src="<?php echo get_theme_file_uri("src/assets/img/featured/circle.jpg") ?>" alt="" /><img
          src="<?php echo get_theme_file_uri("src/assets/img/featured/earth-2.0.jpg") ?>"
          alt=""
        /><img src="<?php echo get_theme_file_uri("src/assets/img/featured/fox-hub.jpg") ?>" alt="" /><img
          src="<?php echo get_theme_file_uri("src/assets/img/featured/goldline.jpg") ?>"
          alt=""
        /><img src="<?php echo get_theme_file_uri("src/assets/img/featured/kanba.jpg") ?>" alt="" /><img
          src="<?php echo get_theme_file_uri("src/assets/img/featured/kyan.jpg") ?>"
          alt=""
        /><img src="<?php echo get_theme_file_uri("src/assets/img/featured/muzica.jpg") ?>" alt="" /><img
          src="<?php echo get_theme_file_uri("src/assets/img/featured/nirastate.jpg") ?>"
          alt=""
        /><img src="<?php echo get_theme_file_uri("src/assets/img/featured/treva.jpg") ?>" alt="" />
      </div>
    </section>

    <!-- about me video -->
    <section class="about_video pd">
      <h2 class="section_heading">Directly Into Your Inbox Every Monday</h2>
      <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut dolore kasd gubergren, no sea takimata sanctus
        est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,
      </p>
      <img src="<?php echo get_theme_file_uri("src/assets/img/video_about.jpg") ?>" alt="" />
    </section>

    <section class="blog_posts pd">
      <h2>blog posts</h2>
      <div class="list_article">
        <?php 
            $homePosts = new WP_Query(array(
                'posts_per_page' => 3,
            ));

            if ( $homePosts->have_posts() ) {
                while ($homePosts->have_posts()) {
                    $homePosts->the_post();
                    get_template_part( 'templates/content', 'blog-card' );
              }
            }
            wp_reset_postdata();
        ?>
      </div>
    </section>
    <?php get_footer(); ?>