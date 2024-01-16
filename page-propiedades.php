<?php
/*
*  Template Name: Properties
*  Template Post Type: page, posts
*/
?>

<?php
// * Get parameters from search form
//* ----------------------------------
//* GET ORDER by Radio buttons
$order_by = '';
if (isset($_GET['order']) && !empty($_GET['order'])) {
  $order_by = $_GET['order'];
}
//* Filter by checkboxes
//* taxonomy: Inmuebles
$inmuebles_options = ''; //Init clear
$inmuebles_options_array = ''; //Init clear
if (isset($_GET['inmuebles']) && !empty($_GET['inmuebles']) && is_array($_GET['inmuebles'])) {
  foreach ($_GET['inmuebles'] as $session_id) {
    $inmuebles_options .= $session_id . ',';
  }
} else {
  $inmuebles_options = '';
}
$inmuebles_options = substr($inmuebles_options, 0, -1); //string
$inmuebles_options_array = explode(",", $inmuebles_options); //array
$tax_query_term = '';
if (!empty($inmuebles_options_array[0])) {
  $tax_query_term = array( //Search for checkboxes
    'relation' => 'OR',
    array(
      'taxonomy' => 'inmuebles',
      'field'    => 'id',
      'terms'    => $inmuebles_options_array
    ),
  );
}

// * GET THE TERMS FROM TAXONOMY 'inmuebles'
$inmuebles_taxs = get_terms(
  array(
    'taxonomy' => 'inmuebles',
  )
);
?>

<?php get_header(); ?>

<div class="container py-5 ">
  <div class="d-grid">
    <!-- /* SIDEBAR */ -->
    <div class="grid-item grid-item-1 bg-black filter-sidebar">
      <div class="box-shadow">
        <div class="propiedad-body p-3 filter-logo">
          <!-- FILTERS -->
          <?php
          global $post;
          $post_slug = $post->post_name;
          ?>
          <form id="filters-sidebar-form" action="<?php echo home_url(); ?>/<?php echo $post_slug; ?>" role="search" method="get" class="blogsearchform">
            <div class="form-row">
              <div class="form-group col-md-12 mb-md-1 px-4 desarrollo-tipos">
                <div class="form-check mb-1 mr-2 mr-md-0 d-inline-block d-md-block ">
                  <label class="form-check-label">
                    <input type="checkbox" name="inmuebles[]" id="inmuebles-todos" value="all" <?php if (isset($_GET['inmuebles']) && is_array($_GET['inmuebles'])) {
                      checked(in_array('all', $_GET['inmuebles']));
                      } ?> class="form-check-input inmuebles-todos" />
                    <?php
                    _e('All', 'darwin06');
                    ?>
                  </label>
                </div>
                <?php
                foreach ($inmuebles_taxs as $term) {
                ?>
                  <div class="form-check mb-1 mr-2 mr-md-0 d-inline-block d-md-block ">
                    <label class="form-check-label">
                      <input type="checkbox" name="inmuebles[]" id="<?php echo $term->slug; ?>" value="<?php echo $term->term_id; ?>" <?php if (isset($_GET['inmuebles']) && is_array($_GET['inmuebles'])) {
                        checked(in_array(
                          $term->term_id,
                          $_GET['inmuebles']
                        ));
                      } ?> class="form-check-input
                    <?php echo $term->slug; ?>" />
                      <?php echo $term->name; ?>
                    </label>
                  </div>
                <?php
                }
                ?>
              </div>
              <div class="form-group col-md-12 mb-0 mt-1">
                <div class="form-radio mb-1 mr-2 mr-md-0 d-inline-block d-md-block ">
                  <label class="form-radio-label">
                    <input type="radio" name="order" id="ascendente" value="ASC" <?php if (isset($_GET['order'])) {
                      checked('ASC', $_GET['order']);
                    } ?> class="form-radio-input" />
                    <?php _e('Ascendant', 'darwin06'); ?>
                  </label>
                </div>
                <div class="form-radio mb-1 mr-2 mr-md-0 d-inline-block d-md-block ">
                  <label class="form-radio-label">
                    <input type="radio" name="order" id="descendente" value="DESC" <?php if (isset($_GET['order'])) {
                      checked('DESC', $_GET['order']);
                    } ?> class="form-radio-input" />
                    <?php _e('Descendent', 'darwin06'); ?>
                  </label>
                </div>
              </div>
              <div class="form-group col-md-12 mb-0 mt-1">
                <button class="btn btn-secondary btn-block filter-btn-submit" type="submit" name="">
                  <?php _e('Properties', 'darwin06'); ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /* POSTS CONTENT */ -->
    <?php
    // * Get the current page
    if (get_query_var('paged')) {
      $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
      $paged = get_query_var('page');
    } else {
      $paged = 1;
    }

    //* Args to filter query
    $custom_args = array(
      'posts_per_page' => -1,
      'post_type'      => 'desarrollos',
      'tax_query'      => $tax_query_term,
      'order'          => $order_by,
      // 'orderby'        => 'meta_value',
      'meta_key'       => 'des_precio',
      'paged'          => $paged,
      'page'           => $paged,
      // 'meta_value'    => '2018',
      // 'meta_value_num' => 2018,
    );

    //* Custom Query
    $custom_query = new WP_Query($custom_args);
    $countItem = 1;
    // * Custom Loop
    if ($custom_query->have_posts()) :
      while ($custom_query->have_posts()) :
        $custom_query->the_post();
        $countItem++;
        //* grab the url for the full size featured image
        if (has_post_thumbnail($post)) {
          $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
        } else {
          $featured_img_url = 'https://wordpress.dev/wp-content/uploads/2020/03/placeholder-city.jpg';
        }
    ?>
        <?php
        $terms = get_the_terms($post->ID, 'inmuebles');
        ?>
        <div class="grid-item grid-item-<?php echo $countItem; ?> d-flex align-items-stretch <?php echo $terms[0]->slug; ?>">
          <a class="d-flex flex-column p-5 propiedad-thumb-list w-100" style="background-image: url(<?php echo $featured_img_url; ?>);" href="<?php the_permalink(); ?>">
            <?php
            $terms = get_the_terms($post->ID, 'inmuebles');
            foreach ($terms as $term) {
              // print_r($term);
              $term_link = get_term_link($term->slug, 'inmuebles');
              // echo '<a href="'.esc_url( $term_link ).'">' . $term->name . '</a>';
              echo '<span class="desarrollo-tipo">' . $term->name . '</span>';
            }
            ?>
            <div class="btn btn-secondary my-5">
              <?php _e('View more', 'darwin06'); ?>
            </div>
          </a>
        </div>
    <?php
      endwhile;
    //* Working with WP_Query Objects Directly
    // echo $custom_query->posts[0]->post_title;
    else :
       _e('Info not found', 'darwin06');
    endif;

    // * PAGINATION
    // * URL REFERENCE - https://codex.wordpress.org/Function_Reference/paginate_links

    // $big = 999999999; // need an unlikely integer
    $translated = __('Page', 'darwin06'); // Supply translatable string
    $args_pagination = array(
      // 'base'      => '%_%',
      'format'    =>  'page/%#%', // Default '?paged=%#%' | Pretty links '/page/%#%'
      'current'   =>  max(1, $paged),
      'total'     =>  $custom_query->max_num_pages,
      'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>',
      'mid_size'  => 4,
      'prev_text' => __('<< Previous', 'darwin06'),
      'next_text' => __('Next >>', 'darwin06'),
      // 'type'      => 'list',
    );
    ?>
    <nav aria-label="Pagination" class="d-block w-100 text-center nav-links">
      <?php
      echo paginate_links($args_pagination);
      ?>
    </nav>
    <?php
    //* Restore original Post Data
    wp_reset_postdata();

    ?>
  </div>
</div>

<script>
  // function check($inputCheck) {
  //   document.getElementById($inputCheck).checked = true;
  // }

  // function uncheck($inputCheck) {
  //   document.getElementById($inputCheck).checked = false;
  // }
  var inputAll = 'inmuebles-todos';
  var inputTodos = document.getElementById(inputAll);
  var allInput = document.querySelectorAll('.form-check-input:not(.inmuebles-todos)');
  var inputsInmuebles = document.getElementsByClassName('form-check-input');

  for (var i = 0; i < inputsInmuebles.length; i++) {
    // if(inputsInmuebles[i].checked === true) {
    //   console.log('No está vacío');
    // }
    // console.log('vacío');

    inputsInmuebles[i].addEventListener('click', function() {
      if (this !== inputTodos) {
        var propInms = this.id;
        var propInm = document.querySelectorAll('.grid-item .' + propInms);
        console.log(propInm);
        if (this.checked === true) {
          inputTodos.checked = false;
        }
      } else {
        if (inputTodos.checked === true) {
          for (var j = 0; j < allInput.length; j++) {
            allInput[j].checked = false;
          }
        }
      }
    });
  }
</script>

<?php get_footer(); ?>
