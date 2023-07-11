<?php

namespace UploadCasinos\Classes;

use WCP\Casino\Uploader\ThumbnailInserter;

class CasinoInserter
{
    private function transform_terms_list_to_array(string $terms): array
    {
        $result = [];
        if( $terms ){
            $termsExploded = explode(', ',$terms);
            foreach ($termsExploded as $term) {
                $result[] = $term;
            }
        }

        return $result;
    }

    public function is_image_hotlink_protected( $image_url ): bool
    {
        $headers = get_headers( $image_url, 1 );

        return isset($headers['X-Content-Type-Options']) && $headers['X-Content-Type-Options'] === 'nosniff';
    }

    public function handle(): void
    {


        if (!current_user_can('administrator')) {
            wp_send_json([], 403);
        }
        /**
         * name;year;rating;image url;software;deposits;withdrawal;language;licence;currencies;crypto
         */
        if (isset($_POST['page']) && isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'upload_casinos')) {

            $page = $_POST['page'];
            $res = array();
            $file = fopen(plugin_dir_path(__DIR__) . 'csv/casino_data.csv', 'r');
            while (($line = fgetcsv($file, null, ';')) !== FALSE) {
                $res[] = $line;
            }
            fclose($file);
            $total_pages = count($res);


            // Unset titles of the csv fields
            unset($res[0]);


            $i = $page;
            $casinoTitle = $res[$i][0];
            $year = $res[$i][1];
            $rating = $res[$i][2];
            $thumbnail_url = $res[$i][3];
            $software = $this->transform_terms_list_to_array($res[$i][4]);
            $deposits = $this->transform_terms_list_to_array($res[$i][5]);
            $withdrawal = $this->transform_terms_list_to_array( $res[$i][6]);
            $language = $this->transform_terms_list_to_array($res[$i][7]);
            $licence = $this->transform_terms_list_to_array( $res[$i][8]);
            $currencies = $this->transform_terms_list_to_array($res[$i][9]);
            $crypto = $this->transform_terms_list_to_array($res[$i][10]);


            if ($res[$i][0]) {

                $casino_id = wp_insert_post(array(
                    'post_title' => $casinoTitle,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_type' => 'casino'
                ));
                update_post_meta($casino_id, 'casino_year', $year);
                update_post_meta($casino_id, 'casino_rating', $rating);
                update_post_meta($casino_id, 'casino_thumbnail', $thumbnail_url);

                $hotlink_protected = '';
                $thumbnail_id = media_sideload_image($thumbnail_url, $casino_id, '','id');
                if( !$this->is_image_hotlink_protected($thumbnail_url) && ! is_wp_error($thumbnail_id) ){
                    set_post_thumbnail($casino_id, $thumbnail_id);
                }else{

                    $hotlink_protected = 'The image is hotlink protected: '.$thumbnail_url;
                }



                wp_set_object_terms($casino_id, $software, 'software');
                wp_set_object_terms($casino_id, $deposits, 'deposits');
                wp_set_object_terms($casino_id, $withdrawal, 'withdrawal');
                wp_set_object_terms($casino_id, $language, 'language');
                wp_set_object_terms($casino_id, $licence, 'licence');
                wp_set_object_terms($casino_id, $currencies, 'currencies');
                wp_set_object_terms($casino_id, $crypto, 'crypto');


                wp_send_json_success(array('page' => $page, 'total_pages' => $total_pages,'hotlink_protection'=>$hotlink_protected));

            }


        } else {
            wp_send_json_error('Nonce not valid');
        }


    }
}