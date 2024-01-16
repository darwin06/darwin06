<?php

?>
<article id="post-<?php the_ID(); ?>" <?php post_class("card grid-post"); ?>>
  <?php if (has_post_thumbnail()) { ?>
  <div class="card-img-top" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
    <div class="overlay"></div>
    <?php
      // * Meta field PRECIO
      $precio = get_post_meta(get_the_ID() , 'precio', true); 
      if ( !empty($precio) ) { ?>
      <span class="meta--tag--precio">
        <i class="fa fa-usd" aria-hidden="true"></i> <?php echo $precio . ' MXN.' ?>
      </span>
      <?php }
    ?>
    
  </div>
  <?php } else { ?>
  <div class="card-img-top" style="background-image: url(<?php echo  get_template_directory_uri() . '/assets/images/thumb-property-default.jpeg'; ?>);">
    <div class="overlay"></div>
    
    <?php
      // * Meta field PRECIO
      $precio = get_post_meta(get_the_ID() , 'precio', true); 
      if ( !empty($precio) ) { ?>
      <span class="meta--tag--precio">
        <i class="fa fa-usd" aria-hidden="true"></i> <?php echo $precio . ' MXN.' ?>
      </span>
      <?php }
    ?>

  </div>
  <?php
  }
  ?>
  <div class="card-body">
    <h5 class="mb-0 card-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
    <div class="property__address px-3 py-1">
      <div class="property_address--pin"></div>
      <div class="property_address--description"></div>
    </div>
    <div class="property__meta px-3 py-1">
    <?php
      //  $mykey_values = get_post_custom_values( 'precio' );
      //  foreach ( $mykey_values as $key => $value ) {
      //    echo "$key  => $value MXN<br />"; 
      //  }

      // $custom_field_keys = get_post_custom_keys();
      // foreach ( $custom_field_keys as $key => $value ) {
      //     $valuet = trim($value);
      //     if ( '_' == $valuet{0} )
      //         continue;
      //     echo $key . " => " . $value . "<br />";
      // }

      $banos = get_post_meta(get_the_ID() , 'banos', true); 
      if ( !empty($banos) ) { ?>
        <i class="fa fa-bath" aria-hidden="true"></i> <?php echo $banos . ' Baños' ?>
      <?php } 
      

    ?>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</article>
