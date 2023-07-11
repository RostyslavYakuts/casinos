<?php
/**
 * Plugin Name:     Upload Casinos
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN for inserting data from csv file to WordPress database. Developed for Boosta company
 * Author:          Rostyslav Yakuts
 * Author URI:      YOUR SITE HERE
 * Text Domain:     uc
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package        upload_casinos
 */

if (!defined('WPINC')) {
    die;
}

require_once __DIR__ . '/vendor/autoload.php';

new \UploadCasinos\Classes\OptionsPage('Upload Casinos', 'upload-casinos', '1.0.0');

/**
 * Ajax solution
 */
add_action('wp_ajax_upload_casinos', 'upload_casinos_handler');
add_action('wp_ajax_nopriv_upload_casinos', 'upload_casinos_handler');

function upload_casinos_handler(): void
{
    $inserter = new \UploadCasinos\Classes\CasinoInserter();
    $inserter->handle();

}


























add_action( 'wp_ajax_insert_essays', 'rw_insert_essays' );



