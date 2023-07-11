<?php
/**
 * Template Part Casinos
 * @var $args
 * @package all-casinos
 */

$args = $args['args'];
$casinos = new WP_Query($args); ?>
<div class="container casino-items-wrapper">
    <div class="casino-items">
    <?php if ( $casinos->have_posts() ):
        while ( $casinos->have_posts() ):
            $casinos->the_post(); ?>
        <div class="casino-item">
            <?php
            $id = get_the_ID();
            $link = get_the_permalink();
            $casino_thumbnail_url = get_the_post_thumbnail_url($id,'thumbnail') ?: get_post_meta($id, 'casino_thumbnail', true);
            $casino_rating = get_post_meta($id, 'casino_rating', true);
            echo '<a href="'.$link.'"><img width="120" height="120" src="'.$casino_thumbnail_url.'" alt="'.get_the_title() .'"></a>';
            the_title('<h3>','</h3>');?>

            <div class="stars-rating-wrapper">
                <div class="stars-rating">
                    <span class="stars-rating_inner" style="width: <?php echo $casino_rating * 10; ?>%"></span>
                </div>
            </div>
            <a class="button-primary" target="_blank" rel="nofollow" href="<?php echo $link; ?>">Play Now</a>

        </div>

            <?php endwhile; ?>

        <?php else: ?>
        <?php endif; ?>

    </div>
    <?php \Classes\Casino\CasinoPaginateGenerator::generate_pagination($casinos->max_num_pages); ?>
</div>
