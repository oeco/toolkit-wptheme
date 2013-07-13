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
					<div class="row">
						<div class="nine columns">
							<section class="post-content row">
								<?php the_content(); ?>
							</section>
						</div>
						<div class="three columns">
							<aside class="post-aside">
								<div class="aside-item row">
									<?php toolkit_tool_description(); ?>
								</div>
							</aside>
						</div>
					</div>
				</header>
			</article>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>