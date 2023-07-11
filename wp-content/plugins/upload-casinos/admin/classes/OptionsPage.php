<?php

namespace UploadCasinos\Classes;


class OptionsPage
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private string $plugin_name;


    /**
     * @since 1.0.0
     * @access private
     * @var string $plugin_slug
     */
    private string $plugin_slug;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private string $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $plugin_slug The slug of plugin
     * @param string $version The version of this plugin.
     *
     * @since    1.0.0
     */

    public function __construct(string $plugin_name, string $plugin_slug, string $version)
    {
        $this->plugin_name = $plugin_name;
        $this->plugin_slug = $plugin_slug;
        $this->version = $version;

        add_action('admin_menu', array($this, 'admin_menu'));
        new Enqueuer($this->version, $this->plugin_name);
    }


    /**
     *  Adding menu and submenu pages
     */
    public function admin_menu(): void
    {
        add_menu_page(
            $this->plugin_slug,
            $this->plugin_name,
            'manage_options',
            $this->plugin_slug,
            array($this, 'uc_main_page'),
            'dashicons-filter',
            1
        );
        add_submenu_page(
            $this->plugin_slug,
            'How to use',
            'How to use',
            'manage_options',
            'uc-how-to-use',
            array($this, 'uc_how_to_use')
        );
    }

    protected function get_upload_form(): string
    {
        return '<div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div>
		
        <h1>Upload Casinos (version: ' . $this->version . ')</h1>
        <form method="post" id="casino_upload_form" class="casino-upload-form">
            <fieldset>
                <legend>Set the number of page</legend>
                    <label for="starting-page">Start from page (1 by default)</label>
                    <input id="starting-page" type="text" class="regular-text">
            </fieldset>
                <div class="casino-upload-counter">
                    <b>Current page: </b><span class="js-current-page current-page"></span> &nbsp;|&nbsp;
                    <b>Total pages: </b><span class="js-total-pages total-pages"></span>
                </div>
            
                <button class="js-run-upload">Run Uploading</button>
        </form>
        <div class="upload-casino-warning" id="hotlink_protected_warning"></div>
    
        </div>';
    }


    public function uc_main_page(): void
    {
        if (file_exists(plugin_dir_path(__DIR__) . 'csv/casino_data.csv')) {
            echo $this->get_upload_form();
        } else {
            echo '<p>File casino_data.csv with necessary data not found.</p>
            <p>The path we try to find is: <b>' . plugin_dir_path(__DIR__) . 'csv/casino_data.csv' . '</b></p>';
        }

    }

    public function uc_how_to_use(): void
    {

        echo '<div class="wrap how-to-use-wrapper">
                <div id="icon-options-general" class="icon32"><br></div>
        <h1>How to use</h1>
        <p>After installing this plugin ...
        
        
        </div>';
    }


}
