				<div class="clear"></div>
				<div class="footer-widgets">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Sidebar') ) ?>	
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>		
		</div><!-- content -->
		<div class="container footer">		
			<div class="row">
				<div class="copyright">
				<?php 
				if(get_option('Themex_copyright_text')) {
					echo Themex_html(ThemexCore::getOption('copyright_text'));
				} else {
					echo 'Travel2 Travel &copy; 2012';
				}
				?>
				</div>
				<?php wp_nav_menu( array( 'theme_location' => 'footer_menu','container_class' => 'menu' ) ); ?>
				<div class="clear"></div>
			</div>		
		</div><!-- footer -->
		<?php Themex_background(THEME_URI.'images/patterns/pattern_1.jpg', 'bottom-substrate'); ?>
	</div><!-- global -->
<?php wp_footer(); ?>
</body>
</html>