<?php do_action('toolkit_before_colophon'); ?>

<div id="colophon">
	<div class="container">
		<div class="twelve columns">
			<div class="credits">
				<span class="credits-title"><?php _e('A project by', 'toolkit'); ?></span>
				<a class="c" href="http://oeco.com.br" title="O Eco"><img alt="O Eco" src="<?php echo get_template_directory_uri(); ?>/img/oeco.png" /></a>
				<a class="c" href="http://icfj.org" title="International Center for Journalists"><img alt="International Center for Journalists" src="<?php echo get_template_directory_uri(); ?>/img/icfj.png" /></a>
				<span class="credits-title"><?php _e('Supported by', 'toolkit'); ?></span>
				<a class="c" href="http://ecolab.oeco.org.br/projects/flagit/" title="Flag It"><img alt="Flag It" src="<?php echo get_template_directory_uri(); ?>/img/flagit.png" /></a>
				<a class="c" href="http://earthjournalism.net" title="Earth Journalism Network"><img alt="Earth Journalism Network" src="<?php echo get_template_directory_uri(); ?>/img/ejn_logo.png" /></a>
			</div>
		</div>
	</div>
</div>


<?php wp_footer(); ?>
</body>
</html>