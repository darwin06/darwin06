<?php get_header(); ?>
<div id="myContainer" class="container py-5">
  <div class="row">
    <div class="col-sm-12">
      <h1>
      <?php _e('Search results for: ','darwin06'); the_search_query();  ?>
      </h1>
      <?php echo get_search_form(array(true, 'Search input')); ?>
    </div>
    <div class="col-sm-12">
      <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          echo '<div class="item-post">';
          echo '<h2>';
          the_title();
          echo '</h2>';
          echo get_the_content();
          echo '<p>';
          the_permalink();
          echo '</p>';
          echo '</div>';

        }
      } else {
      ?>
      <h2><?php _e('Nothing to display!', 'darwin06')?></h2>
      <?php
      }
      ?>
    </div>
    <nav>
    <?php the_posts_pagination(); ?>
    </nav>
  </div>
</div>

<?php get_footer(); ?>
