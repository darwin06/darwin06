<?php
// Initial Setup
function darwin06_setup()
{
  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');

  /*
  * Let WordPress manage the document title.
  * By adding theme support, we declare that this theme does not use a
  * hard-coded <title> tag in the document head, and expect WordPress to
  * provide it for us.
  */
  add_theme_support('title-tag');

  /*
  * set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
  */
  if (!isset($content_width)) {
    $content_width = 1200;
  }

  /*
  * Enable support for Post Thumbnails on posts and pages.
  */
  add_theme_support('post-thumbnails');

  add_image_size('medium', get_option('medium_size_w'), get_option('medium_size_h'), array('center', 'center'));
  add_image_size('large', get_option('large_size_w'), get_option('large_size_h'), array('center', 'center'));

  //* Register Custom Navigation Walker
  require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

  //* Breadcrumb
  require_once get_template_directory() . '/inc/components/breadcrumb.php';

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(array(
    'primary'   =>  __('Primary Menu', 'darwin06'),
    'footer' => __('Footer Menu', 'darwin06'),
    'megamenu' => __('Mega menu', 'darwin06')
  ));

  /*
  * Switch default core markup for search form, comment form, and comments
  * to output valid HTML5.
  */
  add_theme_support('html5', array(
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'search-form'
  ));

  /*
  * Enable support for Post Formats.
  */
  add_theme_support('post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
    'gallery',
    'audio',
  ));

  // Add theme support for Custom Logo.
  add_theme_support('custom-logo');

  // Add theme support for custom background
  $defaultsBg = array(
    'default-color'          => '#efefef',
    'default-image'          => '',
    'default-repeat'         => 'no-repeat',
    'default-position-x'     => 'center',
    'default-position-y'     => 'top',
    'default-size'           => 'auto',
    'default-attachment'     => 'scroll',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => ''
  );
  add_theme_support('custom-background', $defaultsBg);

  // Add theme support for custom header
  $defaultsHdr = array(
    'default-image'          => '',
    'random-default'         => false,
    'width'                  => 1410,
    'height'                 => 480,
    'flex-height'            => true,
    'flex-width'             => true,
    'default-text-color'     => '',
    'header-text'            => true,
    'uploads'                => true,
    'wp-head-callback'       => '',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
    'video'                  => false,
    'video-active-callback'  => 'is_front_page',
  );
  add_theme_support('custom-header', $defaultsHdr);

  // Editor Styles
  add_theme_support('align-wide');
  add_theme_support('editor-styles');
  // add_theme_support( 'dark-editor-style' );
  add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'darwin06_setup');

/**
 * Registers an editor stylesheet for the theme.
 */
function darwin_theme_add_editor_styles()
{
  add_editor_style('style-editor.css');
}
add_action('admin_init', 'darwin_theme_add_editor_styles');

// Scripts & Styles
function darwin06_scripts()
{
  // Load main stylesheet
  wp_enqueue_style('above-the-fold', get_template_directory_uri() . '/assets/css/above-the-fold.min.css', array(), false);
  // Popper.js
  wp_enqueue_script('popper.js', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), null, true);
  // Bootstrap JS
  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery', 'popper.js'), null, true);
  // Main JS
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery', 'popper.js', 'bootstrap-js'), null, true);
}
add_action('wp_enqueue_scripts', 'darwin06_scripts');

// Add deferred files
function doms_deferred_scripts() {
  $style = '/assets/css/style.min.css';
  wp_enqueue_style( 'style',  get_template_directory_uri() . $style, [], false );
}
add_action('wp_footer', 'doms_deferred_scripts');

// Sidebars
function darwin06_widgets_init()
{
  register_sidebar(array(
    'name' => __('Primary Sidebar', 'darwin06'),
    'id'   => 'primary-sidebar'
  ));
  register_sidebar(array(
    'name' => __('Archive Sidebar', 'darwin06'),
    'id'   => 'archive-sidebar'
  ));
  register_sidebar(array(
    'name' => __('Singular Sidebar', 'darwin06'),
    'id'   => 'singular-sidebar'
  ));

  register_sidebar(array(
    'name' => __('Footer Sidebar', 'darwin06'),
    'id'   => 'footer-sidebar'
  ));
}
add_action('widgets_init', 'darwin06_widgets_init');

// Remove admin bar bump
function darwin06_remove_admin_bar_bump()
{
  remove_action('wp_head', '_admin_bar_bump_cb');
}
// add_action('get_header', 'darwin06_remove_admin_bar_bump');

// * Upload SVG files
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// * Enable Textdomain for Translate
function doms_enable_textdomain () {
  load_theme_textdomain( 'darwin06', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'doms_enable_textdomain');


function darwin_social_meta_tags()
{
  global $post;
  if (is_single() || is_page() || is_front_page()) {
    if (has_post_thumbnail($post->ID)) {
      $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
    } else {
      $img_src = get_stylesheet_directory_uri() . '/images/wbxpress.png';
    }
    if ($excerpt = $post->post_excerpt) {
      $excerpt = strip_tags($post->post_excerpt);
      $excerpt = str_replace("", "'", $excerpt);
    } else {
      $excerpt = get_bloginfo('description');
    }
?>

    <meta property="og:title" content="<?php echo the_title(); ?>" />
    <meta property="og:description" content="<?php echo $excerpt; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php echo the_permalink(); ?>" />
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>" />
    <meta property="og:image" content="<?php echo $img_src; ?>" />
    <meta name="twitter:card" content="summary_large_image">

    <!--  Non-Essential, But Required for Analytics -->

    <!-- <meta property="fb:app_id" content="your_app_id" />
   <meta name="twitter:site" content="@website-username"> -->
    <?php
  } else {
    return;
  }
}
add_action('wp_head', 'darwin_social_meta_tags', 5);

/*
* Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
* URL: https://zonewp.com/2020/02/duplicate-a-wordpress-page-or-post/
*/

function rd_duplicate_post_as_draft()
{

  global $wpdb;

  if (!(isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action']))) {

    wp_die('No post to duplicate has been supplied!');
  }

  /*
  * Nonce verification
  */

  if (!isset($_GET['duplicate_nonce']) || !wp_verify_nonce($_GET['duplicate_nonce'], basename(__FILE__)))

    return;

  /*
  * get the original post id
  */

  $post_id = (isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));

  /*
  * and all the original post data then
  */

  $post = get_post($post_id);

  /*
  * if you don't want current user to be the new post author,
  * then change next couple of lines to this: $new_post_author = $post->post_author;
  */

  $current_user = wp_get_current_user();

  $new_post_author = $current_user->ID;

  /*
  * if post data exists, create the post duplicate
  */

  if (isset($post) && $post != null) {
    /*
    * new post data array
    */

    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status' => $post->ping_status,
      'post_author' => $new_post_author,
      'post_content' => $post->post_content,
      'post_excerpt' => $post->post_excerpt,
      'post_name' => $post->post_name,
      'post_parent' => $post->post_parent,
      'post_password' => $post->post_password,
      'post_status' => 'draft',
      'post_title' => $post->post_title,
      'post_type' => $post->post_type,
      'to_ping' => $post->to_ping,
      'menu_order' => $post->menu_order
    );

    /*
    * insert the post by wp_insert_post() function
    */

    $new_post_id = wp_insert_post($args);

    /*
    * get all current post terms ad set them to the new post draft
    */

    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");

    foreach ($taxonomies as $taxonomy) {

      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));

      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }

    /*
    * duplicate all post meta just in two SQL queries
    */

    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");

    if (count($post_meta_infos) != 0) {

      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";

      foreach ($post_meta_infos as $meta_info) {

        $meta_key = $meta_info->meta_key;

        if ($meta_key == '_wp_old_slug') continue;

        $meta_value = addslashes($meta_info->meta_value);

        $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }

      $sql_query .= implode(" UNION ALL ", $sql_query_sel);

      $wpdb->query($sql_query);
    }

    /*
    * finally, redirect to the edit post screen for the new draft
    */

    wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));

    exit;
  } else {

    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}

add_action('admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft');

/*
* Add the duplicate link to action list for post_row_actions
*/

function rd_duplicate_post_link($actions, $post)
{

  if (current_user_can('edit_posts')) {

    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce') . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  }

  return $actions;
}

/* Duplicate Posts */
add_filter('post_row_actions', 'rd_duplicate_post_link', 10, 2);
/* Duplicate Pages */
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);