<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="sub-header row">
				<div class="container">
					<div class="twelve columns">
						<h1><?php the_title(); ?></h1>
					</div>
				</div>
			</header>
			<section class="post-content row">
				<div class="container">
					<div class="twelve columns">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
		</article>
	</section>
<?php endif; ?>

<?php get_footer(); ?>