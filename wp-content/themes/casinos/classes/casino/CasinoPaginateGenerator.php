<?php
namespace Classes\Casino;



class CasinoPaginateGenerator {

	public static function generate_pagination($max_num_page): void {
		$big = 999999999;
		$params = array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1,get_query_var('paged')),
			'total' => $max_num_page,
			'show_all'     => false,
			'prev_next' => true,
			'prev_text'    => __('<'),
			'next_text'    => __('>'),
			'before_page_number' => '',
			'after_page_number'  => '',
			'end_size' => 1,
			'mid_size' => 1
		);
		echo '<div class="pagination">
                    <div class="pagination-row">'.
			             paginate_links( $params ) .
                    '</div>
                </div>';
	}
}