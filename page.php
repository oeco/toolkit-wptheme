<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content">
		<div class="container">
			<div class="ten columns offset-by-one">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</article>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>