<?php
//load wordpress
$path_to_file = explode( 'wp-content', __FILE__ );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo THEMEX_URI; ?>extensions/themex-shortcoder/css/popup.css" />
</head>
<body>
<div id="themex-popup">
	<div id="themex-shortcode-wrap">		
		<div id="themex-shortcode-form-wrap">		
			<div id="themex-shortcode-form-head">			
				<?php echo ThemexShortcoder::$data[ThemexShortcoder::$id]['popup_title']; ?>			
			</div>
			<form method="post" id="themex-shortcode-form">			
				<table id="themex-shortcode-form-table">				
					<?php echo ThemexShortcoder::renderSettings(); ?>					
					<tbody>
						<tr class="form-row">
							<?php if( isset(ThemexShortcoder::$data[ThemexShortcoder::$id]['child_shortcode'])) { ?>
							<td class="label">&nbsp;</td>
							<?php } ?>
							<td class="field"><a href="#" class="button-primary themex-insert"><?php _e('Insert Shortcode','travel2'); ?></a></td>							
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