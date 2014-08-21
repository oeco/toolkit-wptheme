<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
	<section id="content" class="track anti-row">
		<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="post-header">
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
			<nav id="track-nav" class="row">
				<div class="container">
					<div class="twelve columns">
						<ul>
							<li class="track-review">Review</li>
							<li class="track-tutorials">Tutorials</li>
							<li class="track-picks">Editor's picks</li>
						</ul>
					</div>
				</div>
			</nav>
			<section id="track-content" class="row">
				<section id="track-review">
					<div class="container">
						<div class="twelve columns">
							<p>Test</p>
						</div>
					</div>
				</section>
				<section id="track-tutorials">
					<div class="container">
						<div class="twelve columns">
							<p>Test</p>
						</div>
					</div>
				</section>
				<section id="track-picks">
					<div class="container">
						<div class="twelve columns">
							<p>Test</p>
						</div>
					</div>
				</section>
			</section>
		</article>
	</section>
<?php endif; ?>

<?php get_footer(); ?>