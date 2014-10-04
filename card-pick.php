<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<?php
		/*
		<div class="three columns">
			<?php if(has_post_thumbnail()) : ?>
				<div class="thumbnail">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
				</div>
			<?php else : ?>
				&nbsp;
			<?php endif; ?>
		</div>
		*/
		?>
		<div class="four columns">
			<header class="post-header">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</header>
		</div>
		<div class="eight columns">
			<section class="post-excerpt">
				<?php the_excerpt(); ?>
			</section>
		</div>
	</div>
</article>