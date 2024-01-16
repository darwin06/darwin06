<main id="landing">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
      <?php
        if(have_posts()) {
          echo '<div class="card"><div class="card-body">';
          while(have_posts()) {
            the_post();
            echo '<h3>';
            the_title();
            echo '</h3>';
            echo get_the_content();
          }
          echo '</div>';
        }
      ?>
      </div>
    </div>
  </div>
</main>
