<?php get_header(); 
 page_banner(array(
   'title' => 'blog',
 ));
?>

 <!-- blog post section -->
 <section class="main_blog_posts pd">
    <h2 class="section_heading">blog posts</h2>
      <div class="list_article">  
        <?php
            while( have_posts() ) {
                the_post();
                get_template_part( 'templates/content', 'blog-card' );
          } ?>
        
        
      </div>
      <div class="pagination_container">
          <?php 
          previous_posts_link('<i class="fas fa-arrow-left"></i>');
          next_posts_link('<i class="fas fa-arrow-right"></i>');?>
        </div>
    </section>

<?php get_footer(); ?>