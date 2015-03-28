<div class="row subheader">
	<?php if(get_option('Themex_header_layout')=='fullwidth') { ?>
	<div class="subheader-block"><?php get_template_part('module','slider'); ?></div>				
	<?php } else { ?>
	<div class="threecol column subheader-block">
		<?php get_template_part('module','search'); ?>		
	</div>
	<div class="ninecol column subheader-block last">
		<?php get_template_part('module','slider'); ?>
	</div>
	<div class="clear"></div>
	<?php } ?>
</div><!-- subheader -->