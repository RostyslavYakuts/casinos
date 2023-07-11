<?php
/**
 * Template Name: All Casinos
 */


get_header();



$paged = ( get_query_var('paged') ) ? absint(get_query_var('paged')) : 1;
$args = array(
    'post_type'=>'casino',
    'posts_per_page' => 12,
    'orderby' => 'post_date',
    'order'   => 'DESC',
    'post_status' => 'publish',
    'paged' => $paged,
    'page' => $paged
);
get_template_part( 'template-parts/page/all-casinos/casinos','',array('args'=>$args) );


/* Start the Loop */
while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/content/content-page' );

    // If comments are open or there is at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
endwhile; // End of the loop.


get_footer();