<?php

function afloat_config()
{
    //Registering our menus
    register_nav_menus(
        array(
            'main_menu' => 'Main Menu',
            'footer_menu' => 'Footer Menu',
            'arctic_main_menu' => 'Arctic Main Menu'
        )
    );

    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('video', 'image'));
    add_theme_support('title-tag');

    add_theme_support('custom-logo');
}

add_action('after_setup_theme', 'afloat_config', 0); //last parameter is priority


add_action('after_setup_theme', 'afloat_images_sizes');
//Responsive Images
function afloat_images_sizes()
{

    // wide aspect
    add_image_size('wide-full', 1920, 720, true);

    // 16:9 aspect
    add_image_size('landscape-full', 1920, 1080, true); 
    add_image_size('landscape-large', 1280, 720, true); 
    add_image_size('landscape-medium', 960, 540, true);
    add_image_size('landscape-small', 640, 360, true);

    // 4:3 aspect
    add_image_size('portrait-large', 960, 720, true);
    add_image_size('portrait-medium', 640, 480, true);
    add_image_size('portrait-small', 440, 330, true);

    // 1:1 aspect
    add_image_size('square-small', 325, 325, true); 
    add_image_size('square-thumb', 100, 100, true); 

}

add_filter('image_size_names_choose', 'afloat_images_sizes_add');
function afloat_images_sizes_add($sizes)
{
    $addsizes = array(
        "landscape-large" => 'Featured Largest',
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}


//Removes P tags on blog posts
function filter_ptags_on_images($content)
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


//Excerpt length
function custom_excerpt_length($length)
{
    return 32;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

//custom image size for blog thumbnails
//add_image_size('blog-image-crop', 510, 414, true);

function add_page_categories()
{
    // Add tag metabox to page
    // register_taxonomy_for_object_type('post_tag', 'page'); 
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');
}
// Add to the admin_init hook of your theme functions.php file 
add_action('init', 'add_page_categories');




// REMOVE DEFAULT BLOG TYPE ------------
// Remove side menu
add_action('admin_menu', 'remove_default_post_type');

function remove_default_post_type()
{
    remove_menu_page('edit.php');
}

// Remove +New post in top Admin Menu Bar
add_action('admin_bar_menu', 'remove_default_post_type_menu_bar', 999);

function remove_default_post_type_menu_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('new-post');
}

// Remove Quick Draft Dashboard Widget
add_action('wp_dashboard_setup', 'remove_draft_widget', 999);

function remove_draft_widget()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}


// REMOVE COMMENTS ------------------------------
// Removes from admin menu
add_action('admin_menu', 'my_remove_admin_menus');
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
// Removes from admin bar
function mytheme_admin_bar_render()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');


// PASSIVE LISTENER FIX ------------
function wp_dereg_script_comment_reply()
{
    wp_deregister_script('comment-reply');
}
add_action('init', 'wp_dereg_script_comment_reply');



// Honeypot
function forms_custom_honeypot( $honeypot, $fields, $entry, $form_data ) {
    $honeypot_class = 'verification-field';
    $honey_field = false;

    foreach( $form_data['fields'] as $form_field ) {
        if( false !== strpos( $form_field['css'], $honeypot_class ) ) {
            $honey_field = absint( $form_field['id'] );
        }
    }

    if( !empty( $entry['fields'][$honey_field] ) ) {
        $honeypot = 'Custom honeypot';
    }

    return $honeypot;

}
add_filter( 'wpforms_process_honeypot', 'forms_custom_honeypot', 10, 4 );


// Same Name Spam Check
function custom_name_validation( $errors, $form_data ) {
    $fields = $form_data['fields'];
    $is_multipage = false;

    if ($form_data['id'] == get_field('newsletter_form_id', 'options')) {
        $is_multipage = true;
    }

    // ── Case 1: Built-in name field with "name-check-field" class ──────────────
    $name_field_id = null;

    foreach ($fields as $id => $field) {
        if (isset($field['css']) && strpos($field['css'], 'name-check-field') !== false) {
            $name_field_id = $id;
            break;
        }
    }

    if ($name_field_id && isset($_POST['wpforms']['fields'][$name_field_id])) {
        $first_name = isset($_POST['wpforms']['fields'][$name_field_id]['first'])
            ? sanitize_text_field($_POST['wpforms']['fields'][$name_field_id]['first'])
            : '';
        $last_name = isset($_POST['wpforms']['fields'][$name_field_id]['last'])
            ? sanitize_text_field($_POST['wpforms']['fields'][$name_field_id]['last'])
            : '';

        if (!empty($first_name) && strtolower($first_name) === strtolower($last_name)) {
            if ($is_multipage) {
                $errors[$form_data['id']][$name_field_id] = esc_html__('First name and last name cannot be identical.', 'wpforms');
            } else {
                $errors[$form_data['id']]['header'] = esc_html__('First name and last name cannot be identical.', 'wpforms');
            }
        }
    }

    // ── Case 2: Two separate fields with "name-check-multifield" class ─────────
    $multifields = [];

    foreach ($fields as $id => $field) {
        if (isset($field['css']) && strpos($field['css'], 'name-check-multifield') !== false) {
            $multifields[] = $id;
        }
    }

    // Expect exactly two fields; first one = first name, second = last name
    if (count($multifields) === 2) {
        $first_field_id = $multifields[0];
        $second_field_id = $multifields[1];

        $submitted = $_POST['wpforms']['fields'] ?? [];

        if (isset($submitted[$first_field_id]) && isset($submitted[$second_field_id])) {
            $first_name = sanitize_text_field($submitted[$first_field_id]);
            $last_name  = sanitize_text_field($submitted[$second_field_id]);

            if (!empty($first_name) && strtolower($first_name) === strtolower($last_name)) {
                if ($is_multipage) {
                    // Attach the error to the last-name field so it's visible on the right page
                    $errors[$form_data['id']][$second_field_id] = esc_html__('First name and last name cannot be identical.', 'wpforms');
                } else {
                    $errors[$form_data['id']]['header'] = esc_html__('First name and last name cannot be identical.', 'wpforms');
                }
            }
        }
    }

    return $errors;
}
add_filter( 'wpforms_process_initial_errors', 'custom_name_validation', 10, 2 );

/**
 * Modify WPForms Date/Time field date picker to accept a range of dates.
 *
 * @link https://wpforms.com/developers/allow-date-range-or-multiple-dates-in-date-picker/
 */
 
function wpf_dev_date_picker_range() {
?>
    <script type="text/javascript">
 
        window.wpforms_datepicker = {
            mode: "range"
        }
 
    </script>
<?php
}
add_action( 'wpforms_wp_footer_end', 'wpf_dev_date_picker_range', 10 );