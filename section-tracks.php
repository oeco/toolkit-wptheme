<?php
$tracks_query = new WP_Query(array(
	'post_type' => 'track',
	'posts_per_page' => 10,
	'meta_query' => array(
		array(
			'key' => 'featured',
			'value' => 1
		)
	)
));
if($tracks_query->have_posts()) :
	?>
	<section id="tracks" class="row anti-row">
		<div class="container">
			<div class="row">
				<div class="four columns">
					<p class="pre-title"><?php _e('Introducing', 'toolkit'); ?></p>
					<h2 class="htitle"><?php _e('TRACKS'); ?></h2>
					<p class="tracks-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque et blandit quam, in dignissim justo. Morbi id egestas urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec hendrerit purus eu convallis luctus. Pellentesque non ipsum augue.</p>
				</div>
				<div class="four columns">
					<h3 class="htitle"><?php _e('Featured tracks'); ?></h3>
					<ul class="track-list">
						<?php
						while($tracks_query->have_posts()) :
							$tracks_query->the_post();
							?>
							<li id="track-<?php the_ID(); ?>" class="track-list-item" data-postid="<?php the_ID(); ?>">
								<article>
									<h3><?php the_title(); ?></h3>
									<?php the_excerpt(); ?>
								</article>
							</li>
							<?php
							wp_reset_postdata();
						endwhile;
						?>
					</ul>
				</div>
				<div class="four columns">
					<?php
					while($tracks_query->have_posts()) :
						$tracks_query->the_post();
						?>
						<div id="track-details-<?php the_ID(); ?>" class="track-details">
							<div class="no-title"></div>
							<div class="single-track">
								<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<p class="track-description"><?php echo get_the_excerpt(); ?> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Continue reading', 'toolkit'); ?></a></p>
								<p class="track-tutorials"><?php printf(__('This track has <strong>%s</strong> tutorials', 'toolkit'), toolkit_get_track_tutorials_count()); ?></p>
							</div>
						</div>
						<?php
						wp_reset_postdata();
					endwhile;
					?>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('.track-details').hide();

			$('.track-list-item').on('click', function() {

				$('.track-list-item').removeClass('active');
				$(this).addClass('active');
				$('.track-details').hide();
				$('#track-details-' + $(this).data('postid')).show();

			});

			$('.track-list-item:first-child').click();

		});
	</script>
<?php endif; ?>