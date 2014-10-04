<?php
/**
 * The Template for displaying related content from YARPP (http://wordpress.org/plugins/yet-another-related-posts-plugin/).
 *
 * @package Cardume
 * @subpackage Humus
 */
?>
<?php if(have_posts()) : ?>
<div class="related-content row">
	<h3 class="section-title"><?php _e('Also in this topic...', 'toolkit'); ?></h3>
	<div class="related-posts">
		<ul class="post-list">
			<?php
			while(have_posts()) :
				the_post();
				?>
				<li>
					<p class="type"><?php echo toolkit_get_content_type(get_post_type()); ?></p>
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h2>
					<?php the_excerpt(); ?>
				</li>
				<?php
			endwhile;
			?>
		</ul>
	</div>
</div>
<?php endif; ?>