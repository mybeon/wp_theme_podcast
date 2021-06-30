<article>
          <div class="credits">
            <span class="author">By <?php the_author(); ?></span>
            <span class="date"><?php the_date('M d, Y') ?></span>
            <span class="category"><?php the_category(", "); ?></span>
          </div>
          <div class="main">
            <a href="<?php the_permalink();?>">
              <h3>
                <?php echo wp_trim_words(get_the_title(), 9)?>
              </h3>
            </a>
            <p>
             <?php echo wp_trim_words(get_the_excerpt(), 18, "...") ?>
            </p>
            <div class="read_more_btn">
              <a href="<?php the_permalink( ); ?>" aria-label="<?php echo get_the_title() ?>" class="btn">read more</a>
            </div>
          </div>
        </article>