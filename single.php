<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content" class="tutorial">
		<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="post-header anti-row">
				<div class="row">
					<div class="container">
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
				</div>
				<?php if(has_post_thumbnail()) : ?>
					<div class="row">
						<div class="container">
							<div class="twelve columns">
								<?php the_post_thumbnail('featured-image', array('class' => 'scale-with-grid')); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</header>
			<div class="row">
				<div class="container">
					<div class="three columns">
						<aside id="summary-aside" class="post-aside">
							<div class="aside-item row toolkit-summary">
								<?php toolkit_summary(); ?>
							</div>
						</aside>
					</div>
					<div class="six columns">
						<section class="post-content row">
							<?php the_content(); ?>
						</section>
						<?php comments_template(); ?>
					</div>
					<div class="three columns">
						<footer class="tutorial-specs">
							<ul class="clearfix">
								<?php
								$difficulty = get_field('difficulty');
								if($difficulty) : ?>
									<li class="difficulty <?php echo $difficulty; ?>">
										<span><?php _e('Difficulty', 'toolkit'); ?></span>
										<div class="content">
											<p class="center"><?php _e($difficulty, 'toolkit'); ?></p>
										</div>
									</li>
								<?php endif; ?>

								<?php
								$tools = get_field('tools');
								if($tools) : ?>
									<li class="tools">
										<span class="label"><?php _e('Tools', 'toolkit'); ?></span>
										<span class="count"><?php echo count($tools); ?></span>
										<div class="content">
											<ul>
												<?php
												foreach($tools as $tool) :
													global $post;
													$post = $tool;
													setup_postdata($post);
													?>
													<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
													<?php wp_reset_postdata(); ?>
												<?php endforeach; ?>
											</ul>
										</div>
									</li>
								<?php endif; ?>

								<?php
								$skills = get_the_terms($post->ID, 'skill');
								if($skills) : ?>
									<li class="skills">
										<span class="label"><?php _e('Skills', 'toolkit'); ?></span>
										<span class="count"><?php echo count($skills); ?></span>
										<div class="content">
											<ul>
												<?php foreach($skills as $skill) : ?>
													<li><a href="<?php echo get_term_link($skill, 'skill'); ?>" title="<?php $skill->name; ?>"><?php echo $skill->name; ?></a></li>
												<?php endforeach; ?>
											</ul>
										</div>
									</li>
								<?php endif; ?>
							</ul>
						</footer>
						<aside id="main-aside" class="post-aside">
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
							<?php if(get_field('examples')) : ?>
								<div class="aside-item row">
									<?php toolkit_examples(); ?>
								</div>
							<?php endif; ?>
						</aside>
					</div>
				</div>
			</div>
		</article>
	</section>
<?php endif; ?>

<?php get_footer(); ?>