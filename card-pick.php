<div class="three columns">
	<div class="row">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="post-header">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<section class="post-excerpt">
				<?php the_excerpt(); ?>
			</section>
		</article>
	</div>
</div>