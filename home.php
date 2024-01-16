<?php
get_header();
?>
<main class="blog">
  <div class="container">
    <div class="row">
      <div class="col-12">
      <?php
      //* LOOP
      if ( have_posts() ) : while ( have_posts() ) : the_post();
      the_content();
      endwhile;
      else :
      _e( 'Sorry, no posts matched your criteria.', 'darwin06' );
      endif;
      ?>
      </div>
    </div>
  </div>
</main>
<?php
get_footer();
?>
