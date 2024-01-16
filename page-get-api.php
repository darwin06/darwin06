<?php
/*
*  Template Name: Fetch API info
*  Template Post Type: page
*/
?>
<?php get_header(); ?>

<div class="container py-5">
  <div class="row">
    <div class="col-12">
    <?php the_title('<h2 class="mb-3">', '</h2>' ); ?>
    </div>
    <?php
      //* Request API URL
      $request = wp_remote_get( 'https://restcountries.eu/rest/v2/all' );

      //* Validate it and ensure that we got back a response that we expected.
      if( is_wp_error( $request ) ) {
        return false; // Bail early
      }

      //* Retrieving the data
      $body = wp_remote_retrieve_body( $request );

      //* Translate the JSON into a format we can read
      $countries = json_decode( $body );

      //* Print the get data
      $count = 0;
      if( ! empty( $countries ) ) {
	      foreach( $countries as $country ) {
          $count++;
          if ($count <= 10 ) :
      ?>
        <div class="col-12 col-md-3 d-flex mb-3">
          <div class="card">
          <img class="card-img-top" src="<?php echo $country->flag; ?>" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">
            <?php echo '<a href="http://maps.google.com/maps?q=' . $country->latlng[0] .',' .$country->latlng[1]. '" target="_blank" >Country: ' . $country->name . ' <br>Capital: ' . $country->capital . '</a>'; ?>
            </h4>
            <div class="card-text">
              Population: <strong><?php echo esc_html( $country->population ); ?></strong>
              <br>Region: <strong><?php echo esc_html( $country->region ); ?></strong>
            </div>
          </div>
        </div>
      </div>
      <?php
          endif;
        }
      }
    ?>
  </div>
  <button id="portfolio-cars-btn" class="btn">Load Countries</button>
  <div id="portfolio-cars-container"></div>
</div>

<?php get_footer(); ?>
