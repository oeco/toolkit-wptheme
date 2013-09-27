<?php do_action('toolkit_before_colophon'); ?>

<div id="colophon">
	<div class="container">
		<div class="two columns">
			<div class="license">
				<?php if(function_exists('qtrans_getLanguage') && qtrans_getLanguage() == 'pt') : ?>
					<a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.pt_BR"><img alt="Licença Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/88x31.png" /></a><br />Este obra foi licenciado sob uma Licença <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.pt_BR">Creative Commons Atribuição-NãoComercial 3.0 Não Adaptada</a>.
				<?php else : ?>
					<a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/">Creative Commons Attribution-NonCommercial 3.0 Unported License</a>.
				<?php endif; ?>
			</div>
		</div>
		<div class="ten columns">
			<div class="credits">
				<span class="credits-title"><?php _e('A project by', 'toolkit'); ?></span>
				<a class="c" href="http://oeco.com.br" title="O Eco"><img alt="O Eco" src="<?php echo get_template_directory_uri(); ?>/img/oeco.png" /></a>
				<a class="c" href="http://icfj.org" title="International Center for Journalists"><img alt="International Center for Journalists" src="<?php echo get_template_directory_uri(); ?>/img/icfj.png" /></a>
				<span class="credits-title"><?php _e('Supported by', 'toolkit'); ?></span>
				<span class="c"><img alt="Youth in Action" src="<?php echo get_template_directory_uri(); ?>/img/youth-in-action-small.jpg" /></span>
				<a class="c" href="http://ecolab.oeco.org.br/projects/flagit/" title="Flag It"><img alt="Flag It" src="<?php echo get_template_directory_uri(); ?>/img/flagit.png" /></a>
				<a class="c" href="http://earthjournalism.net" title="Earth Journalism Network"><img alt="Earth Journalism Network" src="<?php echo get_template_directory_uri(); ?>/img/ejn_logo.png" /></a>
			</div>
		</div>
	</div>
</div>


<?php wp_footer(); ?>
</body>
</html>