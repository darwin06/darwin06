<?php
/*
*  Template Name: Custom Results
*  Template Post Type: post, page
*/
?>
<?php get_header(); ?>

<div class="container py-5">
  <div class="row">
    <div class="col-12">
    <?php the_title('<h2 class="mb-3">', '</h2>' ); ?>
    </div>
    <?php
      // * Get the current page
      if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
      elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
      else { $paged = 1; }

      //* Args to filter query
      $custom_args = array (
        'posts_per_page' => 5,
        'post_type'     => 'cars',
        // 'tax_query'     => array (
        //   array (
        //     'taxonomy'  => 'brands',
        //     'field'     => 'slug',
        //     'terms'     => array('kia','ford'),
        //     'operator'   => 'NOT IN',
        //   ),
        //  ),
        // 'meta_key'      => 'car_year',
        // 'meta_value'    => '2018',
        // 'meta_value_num' => 2018,
        'paged'           => $paged,
        'page'            => $paged,
      );

      //* Custom Query
      $custom_query = new WP_Query( $custom_args );

      // * Custom Loop
      if ( $custom_query->have_posts() ) :
        while ($custom_query->have_posts()) :
          $custom_query->the_post();
      ?>
      <div class="col-12 col-md-6 d-flex mb-3">
      <?php get_template_part('inc/components/custom', 'card'); ?>
      </div>
      <?php
        endwhile;
        //* Working with WP_Query Objects Directly
        // echo $custom_query->posts[0]->post_title;
      else :
        echo (__('Info not found!', 'darwin06'));
      endif;

      // * PAGINATION
      // * URL REFERENCE - https://codex.wordpress.org/Function_Reference/paginate_links

      // $big = 999999999; // need an unlikely integer
      $translated = __( 'Page', 'darwin06' ); // Supply translatable string
      $args_pagination = array(
        // 'base'      => '%_%',
        'format'    =>  'page/%#%', // Default '?paged=%#%' | Pretty links '/page/%#%'
        'current'   =>  max( 1, $paged ),
        'total'     =>  $custom_query->max_num_pages,
                        'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>',
        'mid_size'  => 4,
        'prev_text' => __('<< Previous', 'darwin06'),
        'next_text' => __('Next >>', 'darwin06'),
        // 'type'      => 'list',
      );
      ?>
      <nav aria-label="Pagination" class="d-block w-100 text-center nav-links">
      <?php
      echo paginate_links( $args_pagination );
      ?>
      </nav>
      <?php
      //* Restore original Post Data
      wp_reset_postdata();

    ?>
  </div>
</div>

<?php get_footer(); ?>
