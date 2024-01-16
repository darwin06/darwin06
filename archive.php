<?php get_header(); ?>
<!-- Gallery -->

<div class="container-fluid hero-image" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/home/landing/02.jpg)"></div>
<div class="container pt-5 pb-5">
  <div class="row">
    <?php if (is_active_sidebar('archives-sidebar')) { ?>
    <div class="col-12 col-md-8 content">
    <?php } else { ?>
    <div class="col-12 content">
    <?php } ?>
      <h3><?php echo post_type_archive_title('', false); ?></h3>
      <?php
      if(have_posts()) {
        ?>
        <div class="card-columns">
          <?php
          while(have_posts()) {
            the_post();
            get_template_part('inc/postformats/card');
          }
          ?>
        </div>
        <?php
      }
      else {
      ?>
      <h3>No results.</h3>
      <?php wp_link_pages(); ?>
      <?php
        the_posts_pagination( array(
          'mid_size' => 2,
          'prev_text' => __( 'Back', 'darwin06' ),
          'next_text' => __( 'Onward', 'darwin06' ),
        ) ); 
      }
      ?>
    </div>
    <?php
    if (is_active_sidebar('archives-sidebar')) {
      get_sidebar('archive');
    }
    ?>
  </div>
</div>
<?php get_footer(); ?>
