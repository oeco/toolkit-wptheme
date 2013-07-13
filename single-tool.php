<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content" class="tutorial">
		<div class="container">
			<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="post-header">
					<div class="row">
						<div class="twelve columns">
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
					<div class="row">
						<div class="nine columns">
							<section class="post-content">
								<?php the_content(); ?>
							</section>
						</div>
						<div class="three columns">
							<aside class="post-aside">
							</aside>
						</div>
					</div>
				</header>
			</article>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>