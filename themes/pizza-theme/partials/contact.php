<section class="contact" id="contact">
			<div class="main-contact">
				<div class="contact-content">
				
				<h4>Services</h4>
					<li><a href="#home">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#menu">Menu</a></li>
					<li><a href="#contact">Contact</a></li>
				
				</div>


                <div class="contact-content">
					
					<?php if (is_active_sidebar('sidebar-2')) : ?>
    <aside id="secondary-sidebar" class="secondary-sidebar widget-area">
        <?php dynamic_sidebar('sidebar-2'); ?>
    </aside>
<?php endif; ?>
				</div>

                <div class="contact-content">
				 
				   <?php get_sidebar(); ?>
				</div>
			</div>
			  
		
                 
            <div class="contact-content">
				<h4>Последвайте ни</h4>
				<div class="social-icons">
					<a href="https://www.facebook.com/pirinpixel/" class="social-icons-hover"><i class='bx bxl-facebook'></i></a>
					<a href="https://www.linkedin.com/in/anton-almishev-596aa5262/" class="social-icons-hover"><i class='bx bxl-linkedin'></i></a>
					<a href="https://www.instagram.com/almishev.anton/" class="social-icons-hover"><i class='bx bxl-instagram'></i></a>
				</div>
			</div>

		</section>