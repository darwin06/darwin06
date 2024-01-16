<?php get_header(); ?>
<article>
  <div class="container-fluid hero-image" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/home/landing/02.jpg)"></div>
  <div class="container pt-4 pb-5">
    <div class="row justify-content-center text-center">
      <div class="col-12 content">
        <h1 class="display-1 text-primary font-weight-bold">404</h1>
        <h3 class="text-primary">¡Lo sentimos!</h3>
        <p>La página que busca no existe</p>
        <a class="btn btn-lg btn-outline-primary" href="<?php echo get_site_url(); ?>"><?php _e('Search properties','darwin06'); ?></a>
      </div>
    </div>
  </div>
</article>
<?php get_footer(); ?>
