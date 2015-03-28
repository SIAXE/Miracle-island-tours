<?php if(comments_open()) { ?>
<div class="post-comments">
	<div class="block-title"><h1><?php _e('Comments','travel2'); ?></h1></div>
	<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'template-comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly.');

	 if ( get_comments_number()!=0 ) :
	 ?>
	<div class="comment-list">
		<ol id="comments">
			<?php wp_list_comments('avatar_size=75&callback=themex_comment'); ?>
		</ol>
	</div><!--/ comments-->
	<div class="pagination">
		<?php paginate_comments_links(); ?>
	</div><!--/ pagination-->
	<?php endif; ?>	
	<div class="eightcol">
	<?php 
	$defaults = array(
		'comment_field'        => '<div class="field-wrapper"><textarea id="comment" placeholder="'.__('Comment','travel2').'" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'title_reply'          => '',
		'title_reply_to'       => '',
	);
	comment_form($defaults);
	?>
	</div><!--/ comment form-->
	<div class="clear"></div>
</div>
<?php } ?>