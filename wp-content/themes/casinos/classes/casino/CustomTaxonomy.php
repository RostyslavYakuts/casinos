<?php
/**
 * Class CustomTaxonomy
 */

namespace Classes\Casino;

class CustomTaxonomy extends Registration
{
    private string $post_type;
    private string $name;
    private string  $slug;
    private bool $public;
    private bool $hierarchical;

    /**
     * @param string $post_type
     * @param string $name
     * @param string $slug
     * @param bool $public
     * @param bool $hierarchical
     */
    public function __construct(string $post_type, string $name, string $slug, bool $public = true, bool $hierarchical = true) {
        $this->post_type = $post_type;
        $this->name = $name;
        $this->slug = $slug;
        $this->public = $public;
        $this->hierarchical = $hierarchical;
        $this->registration();
    }

    protected function registration(): void{
        register_taxonomy(strtolower($this->slug),strtolower($this->post_type),$this->getEssenceData());
    }

    protected function getEssenceData(): array{

        return array(
            'label'                         => $this->name,
            'labels'                        => array(
                'name'                          => $this->name,
                'singular_name'                 => $this->name,
                'search_items'                  => 'Search '.$this->name,
                'popular_items'                 => 'Popular '.$this->name,
                'all_items'                     => 'All '.$this->name.'s',
                'parent_item'                   => 'Parent '.$this->name,
                'edit_item'                     => 'Edit '.$this->name,
                'update_item'                   => 'Update '.$this->name,
                'add_new_item'                  => 'Add New '.$this->name,
                'new_item_name'                 => 'New '.$this->name,
                'separate_items_with_commas'    => 'Separate '.$this->name.'s with commas',
                'add_or_remove_items'           => 'Add or remove '.$this->name.'s',
                'choose_from_most_used'         => 'Choose from most used '.$this->name.'s'
            ),
            'public'                        => $this->public,
            'hierarchical'                  => $this->hierarchical,
            'show_in_nav_menus'             => true,
            'args'                          => array( 'orderby' => 'term_order' ),
            'query_var'                     => true,
            'show_ui'                       => true,
            'rewrite'                       => true,
            'show_admin_column'             => true
        );

    }
}
