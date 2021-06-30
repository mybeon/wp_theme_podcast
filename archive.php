<?php 
if( !defined('ABSPATH')) {
  echo "you can not acces these files directly";
  exit;
} 


get_header(); ?>

<section class="page_section">
      <h1><?php the_category() ?></h1>
</section>

 <!-- blog post section -->
 <section class="main_blog_posts pd">
      <div class="list_article">
        <?php if( have_posts() ) {
            while( have_posts() ) {
                the_post(); ?>

        <article>
          <div class="credits">
            <span class="author">By <?php the_author(); ?></span>
            <span class="date"><?php the_date('M d, Y') ?></span>
            <span class="category"><?php the_category(", "); ?></span>
          </div>
          <div class="main">
            <h3>
            <?php echo wp_trim_words(get_the_title(), 9)?>
            </h3>
            <p>
             <?php echo wp_trim_words(get_the_excerpt(), 18, "...") ?>
            </p>
            <div class="read_more_btn">
              <a href="<?php the_permalink( ); ?>" class="btn">read more</a>
            </div>
          </div>
        </article>


          <?php  }
        } ?>
        
      </div>
    </section>

<?php get_footer(); ?>