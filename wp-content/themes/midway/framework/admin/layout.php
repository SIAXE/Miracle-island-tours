<div class="themex_panel" id="themex_panel">
	<div class="themex_header">
		<h1><?php _e('Theme Options','travel2'); ?></h1>
		<div class="themex_main_button save_options disabled"><?php _e('Save Changes','travel2'); ?></div>
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
			<div class="themex_main_button reset_options"><?php _e('Reset Options','travel2'); ?></div>
			<div class="themex_main_button save_options disabled"><?php _e('Save Changes','travel2'); ?></div>
		</div>
	<div class="themex_popup"></div>
</div>