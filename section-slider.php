<?php if(have_posts()) : ?>
	<section class="featured-slider">
		<ul class="slider-items">
			<?php $i = 0; while(have_posts()) : the_post(); ?>
				<?php
				$featured_image = get_field('background_image');
				$bg_color = get_field('background_color');
				$hide_title = get_field('hide_title');
				?>
				<li class="slider-item" data-sliderid="item-<?php echo $i; ?>" <?php if($bg_color) : ?> style="background-color: <?php echo $bg_color; ?>" <?php endif; ?>>
					<?php if($featured_image) : ?>
						<div class="stage-image-container">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" ></a>
						</div>
					<?php endif; ?>
					<div class="item-content">
						<?php if(!$hide_title) : ?>
							<h2><a href="<?php echo get_field('slider_url'); ?>" titlte="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<?php endif; ?>
					</div>
				</li>
			<?php $i++; endwhile; ?>
		</ul>
		<div class="slider-controller-container">
			<div class="container">
				<div class="twelve columns">
					<ol class="slider-controllers">
						<?php $i = 0; while(have_posts()) : the_post(); ?>
							<li data-sliderid="item-<?php echo $i; ?>"></li>
						<?php $i++; endwhile; ?>
					</ol>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>