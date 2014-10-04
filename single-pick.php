<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content" class="pick single">
		<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="post-header main-header row">
				<div class="row">
					<div class="container">
						<div class="twelve columns">
							<h2><a href="<?php echo get_post_type_archive_link(get_post_type()); ?>"><?php _e('Editor\'s picks', 'toolkit'); ?></a></h2>
							<h1><?php the_title(); ?></h1>
							<div class="post-meta">
								<p class="author icon"><?php the_author(); ?></p>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div class="row">
				<div class="container">
					<div class="eight columns">
						<section class="post-content row">
							<?php the_content(); ?>
						</section>
						<?php comments_template(); ?>
					</div>
					<div class="four columns">
						<?php if(function_exists('related_posts')) related_posts(); ?>
					</div>
				</div>
			</div>
		</article>
	</section>
<?php endif; ?>

<?php get_footer(); ?>