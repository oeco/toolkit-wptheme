<div class="row">
	<div class="twelve columns">
		<article id="<?php echo sanitize_title(get_the_title()); ?>" <?php post_class(); ?>>
			<div class="clearfix">
				<div class="three columns alpha">
					<header class="post-header">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					</header>
				</div>
				<div class="nine columns omega">
					<section class="post-content">
						<?php the_field('meaning'); ?>
					</section>
				</div>
			</div>
		</article>
	</div>
</div>