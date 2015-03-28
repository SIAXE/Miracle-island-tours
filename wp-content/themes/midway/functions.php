<?php
//Error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR);

//Define constants
define('THEME_PATH',get_template_directory().'/');
define('THEME_URI',get_template_directory_uri().'/');
define('THEME_CSS_URI',get_stylesheet_directory_uri().'/');
define('Themex_PATH',THEME_PATH.'framework/');
define('Themex_URI',THEME_URI.'framework/');

//Set content width
if ( ! isset( $content_width ) ) $content_width = 1140;

//Include theme functions
include(Themex_PATH.'functions.php');

//Include theme configuration file
include(Themex_PATH.'config.php');

//Include core class
include(Themex_PATH.'classes/Themex.core.php');

//Init theme
$theme=new ThemexCore($config);
?>