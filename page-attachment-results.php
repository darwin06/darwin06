<?php
/*
*  Template Name: Attachment results
*  Template Post Type: post, page
*/

get_header();
//** Args for our query */
$args = array(
  'orderby'        => 'title',
  'order'          => 'DESC',
  'post_type'      => 'attachment',
  'post_mime_type' => array(
    'image/jpeg',
    'image/png',
    'video/mp4',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
  ),
  'post_status'    => array(
    // 'publish',
    'inherit',
    // 'any',
  ),
);
//** Query with custom arguments */
$query = new WP_Query($args);
echo '<div class="container"><div class="row"><div class="col-sm-12">';
// The Loop
if ($query->have_posts()) {
  while ($query->have_posts()) {
    $query->the_post();
    //** Get file url */
    $attachUrl = wp_get_attachment_url( );
  ?>
    <!-- Print the content to show the file path and url -->
    <a href="<?php echo $attachUrl; ?>"" target="_blank" title="<?php echo get_the_title() ?>"><h2><?php the_title(); ?></h2><?php echo $attachUrl; ?></a>
  <?php
  }
} else {
  esc_html_e( 'Nothing to display!', 'darwin06' );
}
echo '</div></div></div>';

// Restore original Post Data
wp_reset_postdata();

get_footer();
?>
