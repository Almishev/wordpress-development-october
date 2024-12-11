<section class="contact" id="contact">
			<div class="main-contact">
            
			<div class="content-text">
    <?php if (is_active_sidebar('services-sidebar')) : ?>
        <aside id="services-sidebar" class="widget-area">
            <?php dynamic_sidebar('services-sidebar'); ?>
        </aside>
    <?php else : ?>
        <h4>Услуги</h4>
        <ul>
            <li>Поръчки по телефона</li>
            <li>Доставка до място</li>
            <li>Организира кетеринг</li>
            <li>Дългосрочно партньорство</li>
        </ul>
    <?php endif; ?>
</div>

                <div class="contact-content">
					
					<?php if (is_active_sidebar('sidebar-2')) : ?>
    <aside id="secondary-sidebar" class="secondary-sidebar widget-area">
        <?php dynamic_sidebar('sidebar-2'); ?>
    </aside>
<?php endif; ?>
				</div>

                <div class="contact-content">
				 
				<?php if (is_active_sidebar('sidebar-1')) : ?>
    <aside id="secondary-sidebar" class="secondary-sidebar widget-area">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside>
<?php endif; ?>
				</div>
			</div>
			  
		<!--
                 
            <div class="contact-content">
				<h4>Последвайте ни</h4>
				
				<div class="social-icons">
					<a href="https://www.facebook.com/pirinpixel/" class="social-icons-hover"><i class='bx bxl-facebook'></i></a>
					<a href="https://www.linkedin.com/in/anton-almishev-596aa5262/" class="social-icons-hover"><i class='bx bxl-linkedin'></i></a>
					<a href="https://www.instagram.com/almishev.anton/" class="social-icons-hover"><i class='bx bxl-instagram'></i></a>
				</div>
					
			</div>
			-->

		</section>