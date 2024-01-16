<?php get_header(); ?>
<article <?php post_class(); ?>>
  <!-- Gallery -->

  <!-- Thumbnail -->
  <?php if (has_post_thumbnail()) { ?>
  <div class="container-fluid hero-image py-5"
    style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>); padding: 36% 0 0; background-size: cover; background-repeat:no-repeat; background-position: center; ">
  </div>
  <?php } else { ?>
  <div class="container-fluid hero-image"
    style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/home/landing/01.jpg); padding: 36% 0 0; background-size: cover; background-repeat:no-repeat; background-position: center;">
  </div>
  <?php } ?>

  <div class="container page-body">
    <div class="row">
      <?php
      if (is_active_sidebar('singular-sidebar')) {
      ?>
      <div class="col-12 col-md-8 content">
      <?php
      } else {
      ?>
        <div class="col-12 content">
      <?php
      }

        if(have_posts()) {
          while(have_posts()) {
            add_thickbox();
            the_post();
            ?>
          <h1 class="pt-3">
            <?php the_title(); ?>
          </h1>
          <?php
            the_content();
            the_meta();

            // print_r(get_post_type());

            // * GALLERY MEDIA
            if(
              'inmueble' == get_post_type()
              && get_post_meta( get_the_ID(), 'galeria', true ) !== ''
              && get_post_meta( get_the_ID(), 'galeria', true ) !== null
            ) {
              get_template_part( 'inc/components/single', 'inmueble-gallery' );
            }
          }
          // wp_reset_postdata();
        }
        ?>

          <div class="clearfix mb-3" >
            <div class="prev-posts pull-left">
              <?php
          $prev_post = get_previous_post();
          if($prev_post) {
            $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
            echo "\t" . '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class=" "><strong><<< &quot;'. $prev_title . '&quot;</strong></a>' . "\n";
          }
          ?>
            </div>
            <div class="next-posts pull-right">
              <?php
          $next_post = get_next_post();
          if($next_post) {
            $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
            echo "\t" . '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class=" "><strong>&quot;'. $next_title . '&quot; >>></strong></a>' . "\n";
          }
          ?>
            </div>
          </div>


          <?php
        // * If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

          <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>

        </div>
        <?php
      if (is_active_sidebar('singular-sidebar')) {
        get_sidebar('singular');
      }
      ?>
      </div>
    </div>
</article>
<?php get_footer(); ?>
