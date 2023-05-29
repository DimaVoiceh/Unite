<?php
add_action('init', 'register_post_types');

function register_post_types()
{
    register_post_type('building', [
        'label'  => null,
        'labels' => [
            'name'               => 'Недвижимость',
            'singular_name'      => 'Недвижимость',
            'add_new'            => 'Добавить объект',
            'add_new_item'       => 'Добавление объекта',
            'edit_item'          => 'Редактирование объекта',
            'new_item'           => 'Новый объект',
            'view_item'          => 'Смотреть объект',
            'search_items'       => 'Искать объект',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Недвижимость',
        ],
        'description'            => '',
        'public'                 => true,
        'publicly_queryable'  => false,
        // 'exclude_from_search' => null, 
        // 'show_ui'             => null, 
        // 'show_in_nav_menus'   => null, 
        'show_in_menu'           => null,
        // 'show_in_admin_bar'   => null, 
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-building',
        //'capability_type'   => 'post',
        //'capabilities'      => 'post',
        //'map_meta_cap'      => null, 
        'hierarchical'        => false,
        'supports'            => ['title', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => ['building-type'],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ]);
    register_post_type('agency', [
        'label'  => null,
        'labels' => [
            'name'               => 'Агентство',
            'singular_name'      => 'Агентство',
            'add_new'            => 'Добавить агентство',
            'add_new_item'       => 'Добавление агентства',
            'edit_item'          => 'Редактирование агентство',
            'new_item'           => 'Новое агентство',
            'view_item'          => 'Смотреть агентство',
            'search_items'       => 'Искать агентство',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Агентства',
        ],
        'description'            => '',
        'public'                 => true,
        'publicly_queryable'  => false,
        // 'exclude_from_search' => null, 
        // 'show_ui'             => null, 
        // 'show_in_nav_menus'   => null, 
        'show_in_menu'           => null,
        // 'show_in_admin_bar'   => null, 
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-businessman',
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', 
        //'map_meta_cap'      => null, 
        'hierarchical'        => false,
        'supports'            => ['title', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => [],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ]);
}

add_action('init', 'create_taxonomy');
function create_taxonomy()
{
    register_taxonomy('building-type', ['building'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Типы недвижимости',
            'singular_name'     => 'Тип недвижимости',
            'search_items'      => 'Искать тип',
            'all_items'         => 'Все типы',
            'view_item '        => 'Показать тип',
            'parent_item'       => 'Родительский тип',
            'parent_item_colon' => 'Родительский тип:',
            'edit_item'         => 'Редактировать',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить новый тип',
            'new_item_name'     => 'Имяы нового типа',
            'menu_name'         => 'Тип недвижимости',
            'back_to_items'     => '← Вернутся к типам',
        ],
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => false,
        // 'show_in_nav_menus'     => true, 
        // 'show_ui'               => true, 
        // 'show_in_menu'          => true, 
        // 'show_tagcloud'         => true, 
        // 'show_in_quick_edit'    => null, 
        'hierarchical'          => true,

        'rewrite'               => true,
        //'query_var'             => $taxonomy, 
        'capabilities'          => array(),
        'meta_box_cb'           => null,
        'show_admin_column'     => false,
        'show_in_rest'          => null,
        'rest_base'             => null,
        // '_builtin'              => false,
        //'update_count_callback' => '_update_post_term_count',
    ]);
}
