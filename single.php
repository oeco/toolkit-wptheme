<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content" class="tutorial">
		<div class="container">
			<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="post-header">
					<div class="row">
						<div class="nine columns">
							<h1><?php the_title(); ?></h1>
						</div>
						<div class="three columns">
							<div class="post-meta">
								<p class="author icon"><?php the_author(); ?></p>
								<p class="categories icon"><span class="clearfix"><?php toolkit_category_list(); ?></span></p>
								<p class="print icon"><?php _e('Print this tutorial', 'toolkit'); ?></p>
								<?php wp_enqueue_script('toolkit-print', get_template_directory_uri() . '/js/print.js', array('jquery')); ?>
							</div>
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
				<div class="row">
					<div class="nine columns">
						<section class="post-content row">
							<?php the_content(); ?>
						</section>
					</div>
					<div class="three columns">
						<aside class="post-aside">
							<div class="share">
								<ul>
									<li>
										<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="box_count" data-show-faces="false" data-send="false"></div>
									</li>
									<li>
										<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-lang="en" data-count="vertical">Tweet</a>
									</li>
									<li>
										<div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>"></div>
									</li>
								</ul>
							</div>
							<div class="aside-item row toolkit-summary">
								<?php toolkit_summary(); ?>
							</div>
							<?php if(get_field('files')) : ?>
								<div class="aside-item row">
									<?php toolkit_files(); ?>
								</div>
							<?php endif; ?>
							<?php if(get_field('knowledge')) : ?>
								<div class="aside-item row">
									<?php toolkit_knowledge(); ?>
								</div>
							<?php endif; ?>
							<?php if(get_field('software')) : ?>
								<div class="aside-item row">
									<?php toolkit_software(); ?>
								</div>
							<?php endif; ?>
							<?php if(get_field('tools')) : ?>
								<div class="aside-item row">
									<?php toolkit_tools(); ?>
								</div>
							<?php endif; ?>
							<?php if(get_field('examples')) : ?>
								<div class="aside-item row">
									<?php toolkit_examples(); ?>
								</div>
							<?php endif; ?>
						</aside>
					</div>
				</div>
			</article>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>