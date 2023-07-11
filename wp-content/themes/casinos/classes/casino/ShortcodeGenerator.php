<?php

namespace Classes\Casino;

class ShortcodeGenerator
{
    // Constructor
    public function __construct() {
        add_shortcode('filtered_casinos',array($this,'get_filtered_casinos'));
    }
    public function get_filtered_casinos($attr){
        if( $attr && isset($attr['year']) ){
           $casino_year = $attr['year'];
           $args = array(
               'post_type'=>'casino',
               'posts_per_page' => 15,
               'orderby' => 'post_date',
               'order'   => 'DESC',
               'post_status' => 'publish',
               'meta_key'=>'casino_year',
               'meta_value'=>$casino_year
           );
            $query = new \WP_Query( $args );
            if ( $query->have_posts() ) {
                echo '<table>
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Rating</th>
                                </tr>
                        </thead><tbody>';
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $id = get_the_ID();
                    $link = get_the_permalink();
                    $casino_thumbnail_url = get_the_post_thumbnail_url($id,'thumbnail') ?: get_post_meta($id, 'casino_thumbnail', true);
                    $casino_rating = get_post_meta($id, 'casino_rating', true);
                    $casino_year = get_post_meta($id, 'casino_year', true);
                    echo '<tr>
                            <td><a href="'.$link.'"><img src="'.$casino_thumbnail_url.'" alt="'.get_the_title().'"></a></td>
                            <td><a href="'.$link.'">'.get_the_title().'</a></td>
                            <td>'.$casino_year.'</td>
                            <td>'.$casino_rating.' <div class="stars-rating-wrapper">
                <div class="stars-rating">
                    <span class="stars-rating_inner" style="width:'. $casino_rating * 10 .'%"></span>
                </div>
            </div></td>
                           </tr>';
                }
                echo '</tbody></table>';
                wp_reset_postdata();
            } else {
                echo '<p>No posts found.</p>';
            }
        }
        return null;
    }



}
