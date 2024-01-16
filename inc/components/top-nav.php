<div class="nav-header ">
  <div class="container">
    <div class="row">
      <div class="col-8">
        <nav id="primary-nav" class="navbar navbar-expand-md navbar-fixed-top" role="navigation">
          <a class="navbar-brand" href="<?php echo get_site_url(); ?>">
            <?php
            if (has_custom_logo()) {
              echo get_custom_logo();
            } else {
            ?>
              <img src="<?php echo get_template_directory_uri() . '/assets/images/wordpress-logo-white.png' ?>" class="img-fluid" width="72" alt="logo" />
            <?php } ?>
            <span class="description" ><?php bloginfo('description'); ?></span>
          </a>
          <!-- Brand and toggle get grouped for better mobile display -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
          </button>

          <!-- <a class="navbar-brand" href="#">Navbar</a> -->
          <?php // wp_nav_menu( array( 'theme_location' => 'top-menu', 'container_class' => 'top-menu darwin-menu' ) );
          ?>
          <?php
          wp_nav_menu(array(
            'theme_location'  => 'primary',
            'depth'            => 2, // 1 = no dropdowns, 2 = with dropdowns.
            'container'       => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id'    => 'bs-example-navbar-collapse-1',
            'menu_class'      => 'navbar-nav ml-auto',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
          ));
          ?>
        </nav>
      </div>
      <div class="col-4 d-flex align-items-center nav-login ">
        <button class="btn btn-third mr-3 text-white"><?php _e('Log in', 'darwin06'); ?></button>
        <button class="btn btn-secondary text-white"><?php _e('Join', 'darwin06'); ?></button>
      </div>
    </div>
  </div>
</div>
