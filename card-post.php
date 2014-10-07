<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-difficulty="<?php the_field('difficulty'); ?>">
	<div class="container">
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
					$tutorial_post = $post;
					$tracks = get_field('related_tracks');
					$tools = array();
					$skills = array();
					if($tracks) {
						foreach($tracks as $track) {
							$types = get_the_terms($track->ID, 'track-type');
							if(!empty($types)) {
								foreach($types as $type) {
									if($type->slug == 'tools' || $type->slug == 'tool') {
										$tools[] = $track;
									} elseif($type->slug == 'skills' || $type->slug == 'skill') {
										$skills[] = $track;
									}
								}
							}
						}
					}
					?>
					<?php
					if(!empty($tools)) : ?>
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
									<?php endforeach; ?>
									<?php
									if(!$GLOBALS['custom_query']) {
										wp_reset_postdata();
									}
									?>
								</ul>
							</div>
						</li>
					<?php endif; ?>

					<?php
					if(!empty($skills)) : ?>
						<li class="skills">
							<span class="label"><?php _e('Skills', 'toolkit'); ?></span>
							<span class="count"><?php echo count($skills); ?></span>
							<div class="content">
								<ul>
									<?php
									foreach($skills as $skill) :
										global $post;
										$post = $skill;
										setup_postdata($post);
										?>
										<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
									<?php endforeach; ?>
									<?php
									if(!$GLOBALS['custom_query']) {
										wp_reset_postdata();
									}
									?>
								</ul>
							</div>
						</li>
					<?php endif; ?>
				</ul>
			</footer>
			&nbsp;
		</div>
		<?php
		global $post;
		$post = $tutorial_post;
		setup_postdata($post);
		?>
		<div class="four columns">
			<header class="post-header clearfix">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<p class="author icon"><?php the_author(); ?></p>
				<?php toolkit_category_list(); ?>
			</header>
		</div>
		<div class="five columns">
			<section class="post-excerpt">
				<?php the_excerpt(); ?>
			</section>
		</div>
		<?php
		wp_reset_postdata();
		?>
	</div>
</article>