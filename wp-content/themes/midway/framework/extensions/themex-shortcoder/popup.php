<?php
//load wordpress
$path_to_file = explode( 'wp-content', __FILE__ );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo Themex_URI; ?>extensions/Themex-shortcoder/css/popup.css" />
</head>
<body>
<div id="Themex-popup">
	<div id="Themex-shortcode-wrap">		
		<div id="Themex-shortcode-form-wrap">		
			<div id="Themex-shortcode-form-head">			
				<?php echo ThemexShortcoder::$data[ThemexShortcoder::$id]['popup_title']; ?>			
			</div>
			<form method="post" id="Themex-shortcode-form">			
				<table id="Themex-shortcode-form-table">				
					<?php echo ThemexShortcoder::renderSettings(); ?>					
					<tbody>
						<tr class="form-row">
							<?php if( isset(ThemexShortcoder::$data[ThemexShortcoder::$id]['child_shortcode'])) { ?>
							<td class="label">&nbsp;</td>
							<?php } ?>
							<td class="field"><a href="#" class="button-primary Themex-insert"><?php _e('Insert Shortcode','Travel2'); ?></a></td>							
						</tr>
					</tbody>				
				</table>
			</form>
		</div>
		<div class="clear"></div>		
	</div>
</div>
</body>
</html>