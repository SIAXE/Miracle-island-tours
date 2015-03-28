<div class="themex_panel" id="themex_panel">
	<div class="themex_header">
		<h1><?php _e('Theme Options','miracleisland'); ?></h1>
		<div class="themex_main_button save_options disabled"><?php _e('Save Changes','miracleisland'); ?></div>
	</div>
		<div class="themex_pages">
			<form name="themex_options" id="themex_options">
			<?php self::renderPages(); ?>
			</form>
		</div>
		<div class="themex_menu">
			<?php self::renderMenu(); ?>
		</div>
		<div class="themex_footer">
			<div class="themex_main_button reset_options"><?php _e('Reset Options','miracleisland'); ?></div>
			<div class="themex_main_button save_options disabled"><?php _e('Save Changes','miracleisland'); ?></div>
		</div>
	<div class="themex_popup"></div>
</div>