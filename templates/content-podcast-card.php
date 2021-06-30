<article class="podcast_article" data-id="<?php the_ID() ?>">
          <div class="the_img">
            <?php  the_post_thumbnail(); ?>
          </div>
          <div class="the_content">
            <h3><?php the_title(); ?></h3>
            <p>
              <?php the_field('description') ?>
            </p>
            <div class="audio_player">
              <button class="play_btn" aria-label="play"><i class="fas fa-play-circle"></i></button>
              <span class="current_time">0.0 s</span>
              <div class="progress_bar"><input  type="range" aria-label="progress podcast" id=""></div>
              <span class="total_time"></span>
              <div class="volume"><button aria-label="volume"><i class="fas fa-volume-up"></i></button><input  type="range" aria-label="volume range" id=""></div>
              <a href="<?php the_field('audio_file') ?>" aria-label="download the podcast" download class="download_btn"><i class="fas fa-download"></i></a>
              <audio src="<?php the_field('audio_file') ?>"></audio>
            </div>
          </div>
          <div class="the_tags">
            <span># Season <?php the_field('season') ?></span><span># Posted on <?php echo get_the_date('M d, Y') ?></span
            ><span><?php the_tags('# ', " / ") ?></span>
          </div>
        </article>
