<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="three columns">&nbsp;</div>
		<div class="four columns">
			<header class="post-header">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</header>
		</div>
		<div class="five columns">
			<section class="post-excerpt">
				<?php the_field('meaning'); ?>
			</section>
		</div>
	</div>
</article>