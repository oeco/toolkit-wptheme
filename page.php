<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content">
		<div class="container">
			<div class="row">
				<div class="ten columns offset-by-one">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="post-header row">
							<h1><?php the_title(); ?></h1>
						</header>
						<section class="post-content row">
							<?php the_content(); ?>
						</section>
					</article>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>