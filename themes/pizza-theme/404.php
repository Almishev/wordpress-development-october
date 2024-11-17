<?php get_header(); ?>

	<!-- Постове -->
	<section class="menu" id="recipe">
		<div class="menu-content">
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 4,
				'paged' => $paged
			);
			$query = new WP_Query($args);

			// Проверка дали има постове за показване
			if ($query->have_posts()) :

				// Показване на постове
				while ($query->have_posts()) : $query->the_post(); ?>

					<div class="row">
						<?php if (has_post_thumbnail()) : ?>
							<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
						<?php else : ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="default-image">
						<?php endif; ?>
						
						<div class="menu-text">
							<div class="menu-left">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							</div>
						</div>
						<p><?php the_excerpt(); ?></p>
					</div>

				<?php endwhile;

				// Добавяне на празни редове, ако няма 4 публикации
				$post_count = $query->post_count;
				for ($i = $post_count; $i < 4; $i++) : ?>
					<div class="row empty-row"></div>
				<?php endfor;

				// Странициране
				echo '<div class="pagination">';
				echo paginate_links(array(
					'total' => $query->max_num_pages,
					'current' => $paged,
					'format' => '?paged=%#%',
					'prev_text' => __('« Previous'),
					'next_text' => __('Next »'),
				));
				echo '</div>';

			else :
				// Ако няма постове за показване, не показваме 404 страница
				echo '<p>No posts found.</p>';
			endif;

			// Възстановяване на глобалния WP обект след custom query
			wp_reset_postdata();
			?>
		</div>
	</section>

<?php get_footer(); ?>
