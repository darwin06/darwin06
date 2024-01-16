<?php
/* Template name: Custom Search */

if ( !defined( 'ABSPATH' ) ) {exit;} // Exit if accessed directly


if (isset($_GET['search_text']) && !empty($_GET['search_text'])) {
  $text = $_GET['search_text'];
} else {
  $text = '';
}
// if (isset($_GET['s']) && !empty($_GET['s'])) {
//   $text = $_GET['s'];
// } else {
//   $text = '';
// }

if (isset($_GET['type'])) {
  $type = $_GET['type'];
}

?>

<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1>
      <?php printf( esc_html__('Search results for: %1s ', 'darwin06'), $text );  ?>
      </h1>
      <!-- Search form on top -->
      <?php echo get_search_form(true, 'Search input'); ?>
    </div>
  </div>
</div>
<div class="container py5">
  <div class="row">
    <?php if (is_active_sidebar('archives-sidebar')) { ?>
    <div class="col-sm-12 col-md-8 content">
    <?php } else { ?>
    <div class="col-sm-12 content">
    <?php } ?>
    <h4 class="mb-3">
    <?php _e('Search results for: ', 'darwin06'); echo isset($text) ? $text : ''; ?></h4>
    <?php
      $typePost = array(
        'public'   => true,
        // '_builtin' => false
      );

      $output = 'names'; // names or objects, note names is the default
      $operator = 'and'; // 'and' or 'or'

      $post_types = get_post_types($typePost, $output, $operator);

      $args = array(
        'post_type' => isset($type) ? $type : $post_types,
        'posts_per_page' => -1,
        's' => isset($text) ? $text : '',
        // 'meta_key' => 'book_year',
        'meta_value' => isset($book_year) ? $book_year : '',
        'post__not_in' => array(74,75,76,77),
        // 'meta_compare' => '=',
        /*'exact' => true,
        'sentence' => true*/
      );
    $query = new WP_Query($args);


    $totalOfPosts = count($query->posts);

    $numberOfPost = 0;
    if($query -> have_posts()) {
        while($query -> have_posts()) : $query -> the_post();
        $numberOfPost++;
        if( $numberOfPost == 1 ) {
          echo "<ul class='list-group mb-3'>";
        }
    ?>
        <li class="list-group-item post clearfix">
            <?php
            if (has_post_thumbnail()) {
              the_post_thumbnail(
                'post-thumbnail',
                array(
                  'class' => 'img-thumbnail'
                )
              );
            }
            ?>
            <a href="<?php the_permalink(); ?>">
              <h5><?php the_title(); ?></h5>
              <?php
              $wpexcerpt = wp_trim_words( get_the_content(), 30, '&hellip;' );
              if (strlen($wpexcerpt) > 0 ) {
                echo "<p>$wpexcerpt</p>";
              }
              ?>
              <?php if(get_post_type() == 'post'){ echo '<strong>Post</strong> '; } ?>
              <?php if(get_post_type() == 'movies'){ echo '<strong>Movie<strong> '; } ?>
              <?php if(get_post_type() == 'books'){ echo '<strong>Book<strong> '; } ?>
              <?php if(get_post_type() == 'inmueble'){ echo '<strong>Inmueble<strong> '; } ?>
              <?php
              print_r(get_post_meta(get_the_ID(), 'book_year', true) );
              ?>
            </a>
        </li>
    <?php
        if ($numberOfPost == $totalOfPosts) {
          echo "</ul>";
        }
      endwhile;
    } else {
    ?>
      <h3><?php _e('No Results', 'darwin06') ?></h3>
    <?php
    }
    wp_reset_postdata();
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
