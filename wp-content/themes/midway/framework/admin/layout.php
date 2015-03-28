<div class="Themex_panel" id="Themex_panel">
	<div class="Themex_header">
		<h1><?php _e('Theme Options','Travel2'); ?></h1>
		<div class="Themex_main_button save_options disabled"><?php _e('Save Changes','Travel2'); ?></div>
	</div>
		<div class="Themex_pages">
			<form name="Themex_options" id="Themex_options">
			<?php self::renderPages(); ?>
			</form>
		</div>
		<div class="Themex_menu">
			<?php self::renderMenu(); ?>
		</div>
		<div class="Themex_footer">
			<div class="Themex_main_button reset_options"><?php _e('Reset Options','Travel2'); ?></div>
			<div class="Themex_main_button save_options disabled"><?php _e('Save Changes','Travel2'); ?></div>
		</div>
	<div class="Themex_popup"></div>
</div>