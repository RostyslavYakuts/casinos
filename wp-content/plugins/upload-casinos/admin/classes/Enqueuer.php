<?php

namespace UploadCasinos\Classes;

class Enqueuer
{

    public string $version;
    public string $name;

    public function __construct(string $version, string $name)
    {
        $this->version = $version;
        $this->name = $name;
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'), 0);
        add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'), 0);
        add_action('admin_enqueue_scripts', array($this, 'localize_custom_script'), 0);
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */


    public function enqueue_styles(): void
    {

        wp_enqueue_style($this->name, plugin_dir_url(__FILE__) . '../assets/css/upload-casinos.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */


    public function enqueue_scripts(): void
    {

        wp_enqueue_script($this->name, plugin_dir_url(__FILE__) . '../assets/js/upload-casinos.js', array('jquery'), $this->version, true);

    }

    /**
     * Localize custom data for ajax
     * @since 1.0.0
     */
    public function localize_custom_script(): void
    {

        wp_localize_script($this->name, 'ucLocalizedScript', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'action' => 'upload_casinos',
                'nonce' => wp_create_nonce('upload_casinos')
            )
        );
    }


}