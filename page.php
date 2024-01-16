<?php

/**
 * The Template for displaying all single pages.
 */

get_header();
?>
<article <?php post_class( $post->post_name ); ?>>
  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      ?>
      <?php
      the_content();
      ?>
    <?php
    }
  } else {
  ?>
  <h2><?php _e('Nothing to display!', 'darwin06')?></h2>
  <?php
    }
  ?>
</article>
<?php get_footer();
