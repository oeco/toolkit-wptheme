<div class="row">
	<div class="twelve columns">
		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
			<div class="post-content">
				<header class="post-header clearfix">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="author icon"><?php the_author(); ?></p>
					<?php toolkit_category_list(); ?>
				</header>
				<section class="post-excerpt">
					<?php the_excerpt(); ?>
				</section>
			</div>
			<footer class="tutorial-specs">
				<ul>

					<?php
					$difficulty = get_field('difficulty');
					if($difficulty) : ?>
						<li class="difficulty balloon-container">
							<span><?php _e('Difficulty', 'toolkit'); ?></span>
							<div class="balloon balloon-left">
								<div class="content">
									<p class="center"><?php _e($difficulty, 'toolkit'); ?></p>
								</div>
							</div>
						</li>
					<?php endif; ?>

					<?php
					$tools = get_field('tools');
					if($tools) : ?>
						<li class="tools balloon-container">
							<span><?php _e('Tools', 'toolkit'); ?></span>
							<div class="balloon balloon-left">
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
							</div>
						</li>
					<?php endif; ?>

					<?php
					$skills = get_the_terms($post->ID, 'skill');
					if($skills) : ?>
						<li class="skills balloon-container">
							<span><?php _e('Skills', 'toolkit'); ?></span>
							<div class="balloon balloon-left">
								<div class="content">
									<ul>
										<?php foreach($skills as $skill) : ?>
											<li><a href="<?php echo get_term_link($skill, 'skill'); ?>" title="<?php $skill->name; ?>"><?php echo $skill->name; ?></a></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</li>
					<?php endif; ?>
				</ul>
			</footer>
		</article>
	</div>
</div>