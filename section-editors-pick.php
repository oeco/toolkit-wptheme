<?php
$picks_query = new WP_Query(array('post_type' => 'pick', 'posts_per_page' => 3));
if($picks_query->have_posts()) :
	?>
	<section id="editors-pick">
		<h3><?php _e('On the web', 'toolkit'); ?></h3>
		<h2><?php _e('Editor\'s picks', 'toolkit'); ?></h2>
		<ul class="pick-list">
			<?php 
			while($picks_query->have_posts()) : 
				$picks_query->the_post();
				?>
				<li>
					<article>
						<h3><?php the_title(); ?></h3>
						<?php the_excerpt(); ?>
					</article>
				</li>
				<?php
				wp_reset_postdata();
			endwhile; ?>
		</ul>
		<a class="button" href="<?php echo get_post_type_archive_link('pick'); ?>"><?php _e('All picks', 'toolkit'); ?></a>
	</section>
<?php endif; ?>