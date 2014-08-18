<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content" class="track anti-row">
		<div class="container">
			<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="post-header">
					<div class="row">
						<div class="nine columns">
							<h1><?php the_title(); ?></h1>
						</div>
					</div>
					<?php if(has_post_thumbnail()) : ?>
						<div class="row">
							<div class="twelve columns">
								<?php the_post_thumbnail('featured-image', array('class' => 'scale-with-grid')); ?>
							</div>
						</div>
					<?php endif; ?>
				</header>
				<div class="six columns">
					<section class="post-content row">
						<?php the_content(); ?>
					</section>
				</div>
			</article>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>