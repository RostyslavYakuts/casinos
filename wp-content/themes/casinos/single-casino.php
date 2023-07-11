<?php

/**
 * The template for displaying all single casino
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
$current_post = get_queried_object();
$id = $current_post->ID;
?>
<div class="container">
    <div class="single-casino-item">


    <?php
    /* Start the Loop */
    while (have_posts()) :
        the_post();

        $casino_thumbnail_url = get_the_post_thumbnail_url($id,'thumbnail') ?: get_post_meta($id, 'casino_thumbnail', true);
        $casino_rating = get_post_meta($id, 'casino_rating', true); ?>
        <div class="single-casino-top">
            <img width="120" height="120" src="<?php echo $casino_thumbnail_url; ?>" alt="<?php echo get_the_title(); ?>">
            <?php the_title('<h1>','</h1>'); ?>
            <div class="stars-rating-wrapper">
                <div class="stars-rating">
                    <span class="stars-rating_inner" style="width: <?php echo $casino_rating * 10; ?>%"></span>
                </div>
            </div>
        </div>

        <h2><?php the_title() ?> Details</h2>
        <div class="single-casino-table">

                <?php get_template_part('template-parts/single/single-casino/terms','items',array('id'=>$id));  ?>

        </div>


    <?php endwhile; // End of the loop.?>

    </div>
</div>

<?php
get_footer();
