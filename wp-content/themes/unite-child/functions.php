<?php

/**
 * Register Cuctom Post Types
 */

require get_stylesheet_directory() . '/inc/post-types.php';


/**
 * Register Custom Widget
 */

require get_stylesheet_directory() . '/inc/widgets/agency-widget.php';

/**
 * Child script
 */

add_action('wp_footer', 'scripts_theme');

function scripts_theme()
{
    wp_enqueue_script('script-child', get_stylesheet_directory_uri() . '/inc/js/script.js');

    wp_localize_script(
        'script-child',
        'ajax',
        array(
            'url' => admin_url('admin-ajax.php'),
        )
    );
}

/**
 * Transient functions
 */

add_action("save_post", "update_building_transient_on_save");
function update_building_transient_on_save($post_id)
{
    $post_type = get_post_type($post_id);
    if ($post_type != "building") return;

    $building = get_building_data($post_id);

    $trans_key = 'building_' . $post_id;
    set_transient($trans_key, $building, DAY_IN_SECONDS);
}

function get_building_data($post_id)
{
    $post = get_post($post_id);
    setup_postdata($post);
    $data =  [
        "title" => get_the_title(),
        "area" => get_field('building-area'),
        "price" => get_field('building-price'),
        "address" => get_field('building-address'),
        "living-area" => get_field('building-living-area'),
        "floor" => get_field('building-floor'),
    ];
    wp_reset_postdata();
    return $data;
}

/**
 * AJAX 
 */

require get_stylesheet_directory() . '/inc/ajax.php';
