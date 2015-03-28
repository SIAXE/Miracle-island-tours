<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
    <input type="text" name="s" id="search" placeholder="<?php _e('Search','Travel2'); ?>" value="<?php the_search_query(); ?>" />
</form>