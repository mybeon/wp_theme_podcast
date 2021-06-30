<?php
/**
 * Template Name: Episodes template
 */

get_header(); 
page_banner();
?>

    <section class="all_episodes pd">
        
      <div class="main_content">
        <h2 class="section_heading">All Podcast Episodes</h2>

        <?php 
    
    $podcasts = new WP_Query(array(
      'post_type' => 'podcasts',
      'post_status' => 'publish',
    ));
    
    if( $podcasts->have_posts() ) {
      while( $podcasts->have_posts() ) {
        $podcasts->the_post();
        
        get_template_part( 'templates/content', 'podcast-card' );
      }
    };
    wp_reset_postdata(); ?>        
    </section>
    <?php get_footer() ?>
