<?php get_header() ?>
<section class="hero_section pd">
      <div class="main_content">
        <div class="mini_heading">
          <div class="line"></div>
          <span><?php __('trending post') ?></span>
        </div>

        <h1><?php echo get_theme_mod( 'trending_podcast_title' ) ?></h1>
        <p>
          <?php echo get_theme_mod( 'trending_podcast_description' ) ?>
        </p>
        <div class="audio_player">
          <button class="play_btn" aria-label="play button"><i class="fas fa-play-circle"></i></button>
          <span class="current_time">0.0 s</span>
          <div class="progress_bar"><input type="range" aria-label="podcast progress" id=""></div>
          <span class="total_time"></span>
          <div class="volume"><button aria-label="volume button"><i class="fas fa-volume-up"></i></button><input type="range" aria-label="volume range" id=""></div>
          <audio src="<?php echo get_theme_mod( 'trending_podcast_url' ) ?>"></audio>
        </div>
        <div class="mini_heading">
          <span>listen on also</span>
          <div class="line"></div>
        </div>
        <?php get_template_part( 'templates/content', 'streamlinks' ); ?>
      </div>
	<?php if ( !wp_is_mobile() ) { ?>
	<img
        class="profile_hero"
        src="<?php echo get_theme_file_uri("/src/assets/img/profile_hero.png") ?>"
        alt="profile img"
      />
	<?php } ?>
      
    </section>
    <section class="latest_podcasts pd">
      <div class="main_content">
        <div class="upper_section">
          <h2>latest podcast episodes</h2>
          <a href="<?php echo get_page_link(get_page_by_title( 'episodes' )) ?>" class="btn">view all</a>
        </div>

        <?php
        $podcastsQuery = new WP_Query(array(
      'post_type' => 'podcasts',
      'post_status' => 'publish',
      'posts_per_page' => 3,
        ));
    
    if( $podcastsQuery->have_posts() ) {
      while( $podcastsQuery->have_posts() ) {
        $podcastsQuery->the_post();
        get_template_part( 'templates/content', 'podcast-card' );
      }
    };
    wp_reset_postdata(); ?>
        <div class="down_section">
          <a href="<?php echo site_url( '/episodes' ) ?>" class="btn">view all</a>
        </div>
      </div>
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
<?php get_footer() ?>