<?php
if(get_query_var('gallery_category')) {
	get_template_part('template','gallery');
} else if((isset($_GET['s']) && empty($_GET['s'])) || get_query_var('tour_destination') || get_query_var('tour_type')) {
	get_template_part('template','tours');
} else {
	get_template_part('template','blog');
}
?>