<div class="card w-100" >
  <?php
    if ( has_post_thumbnail($post) ) :
      the_post_thumbnail('full', ['class="card-img-top"']);
    else :
  ?>
    <img class="card-img-top" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/placeholder-car.jpeg' ?>" alt="<?php echo get_bloginfo('name'); ?>">
  <?php
    endif;
  ?>
  <div class="card-body d-flex flex-column">
    <h5 class="card-title"><?php the_title(); ?></h5>
    <div class="card-text">
      <?php the_excerpt(); ?>
      <p>
        <?php
        //* Get relational post from custom field
        $key_2_value = get_post_meta( $post->ID, 'relational_posts', true );
              if ( ! empty( $key_2_value ) ) {
                foreach ($key_2_value as $value) {
                  //* Get permalink of post
                  $post_permalink = get_post_permalink( $value );
                  $post_gotten = get_post( $value );
                  $title = $post_gotten->post_title;

                  echo '<a href="' . $post_permalink . '" title="' . $title . '">' . $title . '</a> ';

                }
              }
        ?>
      </p>
    </div>
    <div class="mt-auto">
      <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo __('Read More', 'darwin06'); ?></a>
    </div>
  </div>
  <div class="card-footer">
    <?php
      $key_1_value = get_post_meta( $post->ID, 'car_year', true );
      // Check if the custom field has a value.
      if ( ! empty( $key_1_value ) ) {
          echo $key_1_value;
      }

    ?>
    </div>
</div>
