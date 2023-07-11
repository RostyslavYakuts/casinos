<?php

namespace Classes\Casino;

class Helper
{
    public static function generate_row_table_casino_data($id,$taxonomy_name,$taxonomy_slug): string
    {

        $html = '';
        $terms = wp_get_object_terms( $id, $taxonomy_slug,array(
            'orderby' => 'name',
            'order'   => 'ASC',
            'fields' => 'all',
            'hide_empty' => false
            )
        );
        $html .= ' <div class="single-casino-table-row"><div class="taxonomy-title">'.$taxonomy_name.'</div>
                    <div class="terms-items">';
        foreach ( $terms as $term ) {
            $html .= '<a class="term-link" href="' . get_term_link( $term->slug,$taxonomy_slug ) . '" title="' . $term->name . '" >'.$term->name .'</a>';
        }

        $html .= '</div></div>';
        return $html;
    }


}