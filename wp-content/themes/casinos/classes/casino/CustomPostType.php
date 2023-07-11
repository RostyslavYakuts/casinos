<?php
/**
 * Class CustomPostType
 */
namespace Classes\Casino;


class CustomPostType extends Registration
{
    private string $name;
    private string $slug;
    private string $icon;
    private bool $archive;
    private bool $public;
    private array $supports;

    /**
     * @param string $name
     * @param string $slug
     * @param string $icon
     * @param bool $archive
     * @param bool $public
     * @param array $supports
     */
    public function __construct(
        string $name, string $slug, string $icon = 'dashicons-admin-page',
        bool $archive = false, bool $public = true,
        array $supports = array( 'title', 'editor', 'thumbnail') ) {
        $this->name = $name;
        $this->slug = $slug;
        $this->icon = $icon;
        $this->archive = $archive;
        $this->public = $public;
        $this->supports = $supports;
        $this->registration();
    }

    protected function registration(): void{
        register_post_type( strtolower($this->slug),$this->getEssenceData());
    }

    protected function getEssenceData(): array{
        return array(
            'labels'                => array(
                'name'              => $this->name,
                'singular_name'     => $this->name,
                'menu_name'         => $this->name
            ),
            'public'                => $this->public,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'supports'              => $this->supports,
            'rewrite'               => array( 'slug' => $this->slug ),
            'has_archive'           => $this->archive,
            'hierarchical'          => true,
            'show_in_nav_menus'     => true,
            'capability_type'       => 'page',
            'query_var'             => true,
            'menu_icon'             => $this->icon,
        );
    }
}
