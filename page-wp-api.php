<?php
/*
*  Template Name: WP API info
*  Template Post Type: page
*/
?>
<?php get_header(); ?>

<div class="container py-5">
  <div class="row">
    <div class="col-sm-12">
    <?php the_title('<h2 class="title">', '</h2>') ?>
    </div>
    <div class="col-sm-12">
      <?php
      // Main Widget Content Here
      // get_search_form();
      ?>
      <form role="search" id="searchform" >
        <div class="form-group">
          <div class="form-row">
            <div class="input-group search col-md-12">
              <input id="searchInput" type="search" name="s" class="form-control search-field" placeholder="Search…" autocomplete="off" value="" aria-describedby="Search Field" title="Search for:">
            </div>
          </div>
        </div>
      </form>
      <div id="infoListed"></div>
    </div>
      <?php
      //* Request API URL
      $request = wp_remote_get('https://demo.wp-api.org/wp-json/wp/v2/search?search=');

      //* Validate it and ensure that we got back a response that we expected.
      if (is_wp_error($request)) {
          return false; // Bail early
      }

      //* Retrieving the data
      $body = wp_remote_retrieve_body($request);

      //* Translate the JSON into a format we can read
      $customSearch = json_decode($body);

      //* Print the get data
      $count = 0;
      if (! empty($customSearch)) {
          foreach ($customSearch as $cSearch) {
              $count++;
              if ($count <= 10) :
      ?>
          <div class="col-12 col-md-3 d-flex mb-3">
          <div class="card">
          <div class="card-body">
            <h4 class="card-title">
            <?php echo '<a href="' . $cSearch->url . '" target="_blank" >Post: ' . $cSearch->title . '</a>'; ?>
            </h4>
            <!-- <div class="card-text">
              Population: <b><?php // echo esc_html( $cSearch->population ); ?></b>
              <br>Region: <b><?php // echo esc_html( $cSearch->region ); ?></b>
            </div> -->
          </div>
        </div>
      </div>
      <?php
          endif;
          }
      }
    ?>
  </div>
</div>

<?php get_footer(); ?>
