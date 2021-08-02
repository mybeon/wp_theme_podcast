<?php get_header(); ?>

<div style="margin-top: 20rem;">
    <?php while(have_posts()) {
        the_post();
        get_template_part('templates/content', 'podcast-card');
    } ?>
</div>

<?php get_footer();