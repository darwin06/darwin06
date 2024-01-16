<div class="py-3">
  <div class="row">
<?php
$inmueble_media = get_post_meta( get_the_ID(), 'inmueble', true );
$postid = get_the_ID();
$meta = get_post_custom($postid);
$files = $meta['galeria'];
foreach ( $files as $key => $value ) {
  // echo $key . " => " . $value . "<br />";
?>
  <div class="col-12 col-md-4 col-lg-3 text-center mb-40">
    <a href="<?php echo wp_get_attachment_url( $value ); ?>" target="_blank">
      <img src="<?php echo wp_get_attachment_url( $value ); ?>" alt="" class="img-fluid">
      <?php
        // echo wp_get_attachment_link( $value, 'large', true ); 
      ?>
    </a>
  </div>
<?php
}
?>


<!-- Pull in Pods Field -->
<?php // $meta2 = get_post_meta( get_the_ID(), 'galeria', true ); ?>
<?php // print_r($meta2); ?>
</div>
</div>