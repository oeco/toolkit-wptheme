<?php if(have_posts()) : ?>

	<section class="post-loop">
		<div class="container">
			<?php while(have_posts()) : the_post(); ?>
				<div class="row">
					<div class="twelve columns">
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
							<div class="post-content">
								<header class="post-header">
									<h2><?php the_title(); ?></h2>
									<?php the_author(); ?>
								</header>
								<section class="post-excerpt">
									<?php the_excerpt(); ?>
								</section>
							</div>
							<footer class="tutorial-specs">
								<ul>
									<li>
										<span><?php _e('Difficulty', 'toolkit'); ?></span>
									</li>
									<li>
										<span><?php _e('Tools', 'toolkit'); ?></span>
									</li>
									<li>
										<span><?php _e('Skills', 'toolkit'); ?></span>
									</li>
								</ul>
							</footer>
						</article>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</section>

<?php endif; ?>

