<?php
  $args = array(
    'public'   => true,
    // '_builtin' => false
 );

 $output = 'names'; // names or objects, note names is the default
 $operator = 'and'; // 'and' or 'or'

 $post_types = get_post_types( $args, $output, $operator );

?>
<div id="search_form" class="container">
  <div class="row">
    <div class="col-12">
      <form action="<?php echo esc_url( home_url( '/' ) ) ?>search"  role="search" method="get" id="searchform" class="searchform my-3">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
          <input type="text" name="search_text" class="form-control"
            placeholder="<?php esc_attr__('Search', 'darwin06')?>" aria-label="<?php esc_attr__('Search', 'darwin06')?>"
            aria-describedby="basic-addon1">
          <label class="input-group-text mb-0"><?php _e('Type: ', 'darwin06')?></label>
          <select class="form-control" name="type">
            <option value="any">Any</option>
            <?php
            foreach ( $post_types as $post_type ) {
              if ( 'attachment' != $post_type && 'page' != $post_type ) {
                echo '<option value="'. $post_type .'"'. selected($_GET['type'], $post_type) .'>' . $post_type . '</option>';
              }
            }
            ?>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <input type="checkbox" name="book_year" value="2018" id="book_year" />&nbsp;<label class="mb-0" for="book_year"><?php _e('Year', 'darwin06'); ?></label>
            </div>
            <button type="submit" class="btn btn-secondary" name=""><?php _e('Search', 'darwin06'); ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
