<?php if(have_posts()) : ?>

	<section class="post-loop">
		<?php while(have_posts()) : the_post(); ?>
			<?php get_template_part('card', get_post_type()); ?>
		<?php endwhile; ?>
		<nav class="pagination clearfix">
			<div class="container">
				<div class="twelve columns">
					<span class="previous"><?php previous_posts_link(); ?></span>
					<span class="next"><?php next_posts_link(); ?></span>
				</div>
			</div>
		</nav>
	</section>

<?php endif; ?>

