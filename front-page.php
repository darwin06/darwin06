<?php
get_header();
?>
<main class="main">
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

</main>
<?php
get_footer();
?>