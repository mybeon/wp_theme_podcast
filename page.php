<?php  get_header(); 
	page_banner();
	?>
    <div class="blog_content">
        <div class="margin_reset" style="margin-top: -10rem">
            <?php the_content(); ?>
        </div>
    </div>

<?php get_footer(); ?>