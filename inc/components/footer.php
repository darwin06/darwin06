<footer id="main-footer" class="footer">
	<div class="footer-top-container bg-secondary py-3">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php
					$menuFooter = array(
						'theme_location' => 'footer',
						'menu_class' => 'text-center menu',
						'container_class' => 'footer-menu',
						'container_id' => 'footer-menu'
					);
					wp_nav_menu($menuFooter);
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bot-container py-2">
		<div class="container ">
			<div class="row align-content-center flex-wrap ">
				<div class="col-sm-3 ">
					<?php
					if (has_custom_logo()) {
						echo get_custom_logo();
					} else {
					?>
						<a class="logo-link scrollto mb-3 " href="#home">
							<img src="<?php echo get_template_directory_uri() . '/assets/images/wordpress-logo.png' ?>" class="img-fluid" />
						</a>
					<?php
					}
					?>
					<div class="social-links d-flex justify-content-center justify-content-lg-between text-center">
						<a href="https://www.facebook.com" target="_blank" data-toggle="tooltip" title="" data-original-title="Síguenos en Facebook" class=""><i class="fa fa-fw fa-facebook-square "></i></a>
						<a href="https://www.twitter.com" target="_blank" data-toggle="tooltip" title="" data-original-title="Síguenos en Instagram" class=""><i class="fa fa-fw fa-twitter "></i></a>
						<a href="https://www.instagram.com" target="_blank" data-toggle="tooltip" title="" data-original-title="Síguenos en Instagram" class=""><i class="fa fa-fw fa-instagram "></i></a>
						<a href="https://www.linkedin.com/in/" target="_blank" data-toggle="tooltip" title="" data-original-title="Síguenos en LinkedIn" class=""><i class="fa fa-fw fa-linkedin-square "></i></a>
						<a href="https://www.youtube.com/" target="_blank" data-toggle="tooltip" title="" data-original-title="Síguenos en Youtube" class=""><i class="fa fa-fw fa-youtube-square "></i></a>
					</div>
				</div>
				<div class="col-sm-6 ">

				</div>

				<div class="col-sm-3">
					<?php
					if (is_active_sidebar('footer-sidebar')) {
					?>
						<ul id="footerSidebar" class="list-unstyled">
							<?php
							dynamic_sidebar('footer-sidebar')
							?>
						</ul>
					<?php
					} else {
					?>
						<p>Add widget in Footer sidebar position</p>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</footer>
