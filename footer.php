<section class="newsletter_form pd">
      <h2>New Episode Every Week!</h2>
      <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed.
      </p>
      <form action="">
        <input
          type="email"
          name="email"
          id="email-newsletter"
          placeholder="Type Your Email"
        />
        <button type="submit" class="btn">
          subscribe<img src="<?php echo get_theme_file_uri("/src/assets/svg/arrow.svg") ?>" alt="" />
        </button>
      </form>
    </section>
    <footer class="pd">
      <div class="main">
        <div class="section_1">
          <div class="logo">
          <?php the_custom_logo() ?>
          </div>
          <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
            nonumy eirmod tempor invidunt.
          </p>
          <div class="social_links">
            <span class="footer_heading">socials</span>
            <div class="links">
              <a rel="noopener" aria-label="instagram link" href="<?php echo get_theme_mod('instagram-link') ?>" target="_blank"
                ><img src="<?php echo get_theme_file_uri("src/assets/svg/instagram.svg") ?>" alt="" /></a
              ><a rel="noopener" aria-label="linkedin link" href="<?php echo get_theme_mod('linkedin-link') ?>" target="_blank"
                ><img src="<?php echo get_theme_file_uri("src/assets/svg/linkedin.svg") ?>" alt="" /></a
              ><a rel="noopener" aria-label="facebook link" href="<?php echo get_theme_mod('facebook-link') ?>" target="_blank"
                ><img src="<?php echo get_theme_file_uri("src/assets/svg/facebook.svg") ?>" alt="" /></a
              ><a rel="noopener" aria-label="skype link" href="<?php echo get_theme_mod('skype-link') ?>" target="_blank"
                ><img src="<?php echo get_theme_file_uri("src/assets/svg/skype.svg") ?>" alt=""
              /></a>
            </div>
          </div>
        </div>
        <div class="section_list">
          <span class="footer_heading">Pages</span>

          <?php wp_nav_menu( array(
            'theme_location' => 'footer',
          )) ?>
        </div>
        <div class="section_list">
          <span class="footer_heading">Recent Episodes</span>
          <ul>
          <?php  
            $recentEpidodes = new WP_Query(array(
              "post_type" => "podcasts",
              "post_per_page" => 4
            ));

            while($recentEpidodes->have_posts()) {
              $recentEpidodes->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 5);?></a></li>
           <?php } ?>
          </ul>
        </div>
        <div class="section_4">
          <span class="footer_heading">Listen My Podcasts Also In</span>
          <?php get_template_part( 'templates/content', 'streamlinks' ); ?>
        </div>
      </div>
      <small>
        @2020 Themefisher All Rights Reserved | Design By : Themefisher.designer
      </small>
    </footer>
    <div class="preloader"><i class="fas fa-spinner" aria-hidden="true"></i></div>
    <?php wp_footer(); ?>
    <!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/60a97efba4114e480ad05ab0/1f6b1g25q';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
<!--End of Tawk.to Script-->
  </body>
</html>