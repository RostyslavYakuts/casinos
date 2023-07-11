<?php

namespace Classes\Casino;

class CasinoCustomFields
{
    private string $nonce = 'casino-custom-field-eer83du38h6uh35ei39';

    private string $action = 'casino_action';

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'casino_meta_boxes'], 10, 2);
        add_action('save_post', [$this, 'save_metabox'], 10, 2);
    }

    public function casino_meta_boxes($post_type, $post): void
    {
        add_meta_box('casino-year', 'Year', [$this, 'display_year'], ['casino'], 'normal', 'default');
        add_meta_box('casino-rating', 'Rating', [$this, 'display_rating'], ['casino'], 'normal', 'default');
        add_meta_box('casino-thumbnail', 'Thumbnail', [$this, 'display_thumbnail'], ['casino'], 'normal', 'default');
    }

    public function display_year($post): void
    {
        wp_nonce_field($this->action, $this->nonce);
        $casino_year = get_post_meta($post->ID, 'casino_year', true);
        ?>
        <h4 class="description">Casino Year</h4>
        <p>
            <label for="casino-year">
                <input type="text" id="casino-year" name="casino_year" value="<?php echo $casino_year; ?>">
            </label>
        </p>
        <p>Set casino year of foundation</p>

        <?php
    }

    public function display_rating($post): void
    {
        wp_nonce_field($this->action, $this->nonce);
        $casino_rating = get_post_meta($post->ID, 'casino_rating', true);
        ?>
        <h4 class="description">Casino Rating</h4>
        <p>
            <label for="casino-rating">
                <input type="text" id="casino-rating" name="casino_rating" value="<?php echo $casino_rating; ?>">
            </label>
        </p>
        <p>Set casino rating</p>

        <?php
    }

    public function display_thumbnail($post): void
    {
        wp_nonce_field($this->action, $this->nonce);
        $casino_thumbnail = get_post_meta($post->ID, 'casino_thumbnail', true);
        ?>
        <h4 class="description">Casino Thumbnail</h4>
        <p>
            <label for="casino-thumbnail">
                <input type="url" id="casino-thumbnail" name="casino_thumbnail" value="<?php echo $casino_thumbnail; ?>">
            </label>
            <img src="<?php echo $casino_thumbnail; ?>" alt="thumbnail">
        </p>
        <p>Set casino thumbnail url</p>

        <?php
    }

    public function save_metabox($post_id, $post): void
    {
        $nonce_name = $_POST[$this->nonce] ?? '';
        $nonce_action = $this->action;

        // Check if user has permissions to save data.
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Check if nonce is valid.
        if (!wp_verify_nonce($nonce_name, $nonce_action)) {
            return;
        }

        $casino_year = $_POST['casino_year'];
        $casino_rating = $_POST['casino_rating'];
        $casino_thumbnail = $_POST['casino_thumbnail'];

        update_post_meta($post_id, 'casino_year', $casino_year);
        update_post_meta($post_id, 'casino_rating', $casino_rating);
        update_post_meta($post_id, 'casino_thumbnail', $casino_thumbnail);
    }



}