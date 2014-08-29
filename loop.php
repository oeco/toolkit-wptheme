<?php if(have_posts()) : ?>

	<section class="post-loop">
		<?php while(have_posts()) : the_post(); ?>
			<?php get_template_part('card', get_post_type()); ?>
		<?php endwhile; ?>
	</section>

<?php endif; ?>

