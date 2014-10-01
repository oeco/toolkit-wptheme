<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content" class="track anti-row">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header id="track-header" class="post-header row">
				<div class="container">
					<div class="row">
						<div class="nine columns">
							<h1><?php the_title(); ?></h1>
						</div>
					</div>
					<div class="twelve columns">
						<section class="post-content row">
							<?php the_content(); ?>
						</section>
					</div>
				</div>
			</header>
			<?php
			global $post;
			$review = get_field('track_review');
			$tutorial_query = new WP_Query(array('track_tutorials' => $post->ID));
			$pick_query = new WP_Query(array('track_picks' => $post->ID));
			?>
			<nav id="track-nav" class="row anti-row">
				<div class="container">
					<div class="twelve columns">
						<ul>
							<?php if($review) : ?>
								<li class="track-review"><?php _e('Review', 'toolkit'); ?></li>
							<?php endif; ?>
							<?php if($tutorial_query->have_posts()) : ?>
								<li class="track-tutorials">
									<?php _e('Tutorials', 'toolkit'); ?>
									<span class="count"><?php echo $tutorial_query->found_posts; ?></span>
								</li>
							<?php endif; ?>
							<?php if($pick_query->have_posts()) : ?>
								<li class="track-picks">Editor's picks</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</nav>
			<section id="track-content" class="row">
				<?php if($review) : ?>
					<section id="track-review">
						<div class="container">
							<div class="twelve columns">
								<?php echo $review; ?>
							</div>
						</div>
					</section>
				<?php endif; ?>
				<?php if($tutorial_query->have_posts()) : ?>
					<section id="track-tutorials" class="post-loop">
						<div class="row">
							<div class="container">
								<div class="twelve columns">
									<div class="clearfix">
										<h2 class="track-content-title"><?php _e('Track tutorials', 'toolkit'); ?></h2>
										<nav class="track-content-filters">
											<ul>
												<li class="filter-item">
													<div class="dropdown-filter difficulty-filter">
														<ul>
															<li class="label active"><?php _e('Filter by difficulty', 'toolkit'); ?></li>
															<li class="all"><?php _e('All tutorials', 'toolkit'); ?></li>
															<li data-difficulty="easy"><?php _e('Easy', 'toolkit'); ?></li>
															<li data-difficulty="medium"><?php _e('Medium', 'toolkit'); ?></li>
															<li data-difficulty="hard"><?php _e('Hard', 'toolkit'); ?></li>
														</ul>
													</div>
													<script type="text/javascript">
														jQuery(document).ready(function($) {
															$('.difficulty-filter .all').hide();
															$('#track-tutorials .not-found').hide();
															$('.difficulty-filter li').on('click', function() {
																if($(this).is('.label'))
																	return false;
																$('#track-tutorials .not-found').hide();
																$(this).parent().find('li').removeClass('active');
																if($(this).is('.all')) {
																	$(this).hide();
																	$(this).parent().find('.label').show();
																	$(this).parent().find('.label').addClass('active');
																	$('#track-tutorials .post').show();
																} else {
																	$('#track-tutorials .post').hide();
																	$('#track-tutorials .post[data-difficulty="' + $(this).data('difficulty') + '"]').show();
																	$(this).parent().find('.label').hide();
																	$(this).parent().find('.all').show();
																	$(this).addClass('active');
																}
																if(!$('#track-tutorials .post:visible').length) {
																	$('#track-tutorials .not-found').show();
																}
															});
														});
													</script>
												</li>
											</ul>
										</nav>
									</div>
								</div>
							</div>
						</div>
						<?php
						while($tutorial_query->have_posts()) :
							$tutorial_query->the_post();
							get_template_part('card', 'post');
							wp_reset_postdata();
						endwhile;
						?>
						<div class="not-found">
							<div class="container">
								<div class="twelve columns">
									<p><?php _e('No tutorials found.', 'toolkit'); ?></p>
								</div>
							</div>
						</div>
					</section>
				<?php endif; ?>
				<?php if($pick_query->have_posts()) : ?>
					<section id="track-picks">
						<div class="container">
							<div class="twelve columns">
								<p>Test</p>
							</div>
						</div>
					</section>
				<?php endif; ?>
			</section>
		</article>
	</section>
	<script type="text/javascript">

		jQuery(document).ready(function($) {

			if($('#track-nav li').length <= 1) {
				$('#track-nav').hide();
			}

			changeSection($('#track-nav li:first-child').attr('class'));

			$('#track-nav li').on('click', function() {

				changeSection($(this).attr('class'));

			});

			function changeSection(section) {
				
				if(section.indexOf('active') !== -1)
					return false;

				$('#track-nav li').removeClass('active');
				$('#track-nav li.' + section).addClass('active');

				$('#track-content > section').hide();
				$('#track-content > section#' + section).show();

			}
		});
	</script>
<?php endif; ?>

<?php get_footer(); ?>