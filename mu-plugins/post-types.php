<?php function gacast_theme_custom_post_type() {

    register_post_type( 'podcasts', array(
        'labels' => array(
            'name' => 'podcasts',
            'singular_name' => 'podcast', 
        ),
        'has_archive' => true,
        'supports' => array(
            'title',
            'thumbnail',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-microphone',
        'menu_position' => 5,
        'taxonomies' => array('post_tag'),
        "show_in_rest" => true
    ));


    register_post_type( 'usernote', array(
        'labels' => array(
            'name' => 'User Notes',
            "all_items" => "All Notes",
            'singular_name' => 'Note',
            'add_new' => "new Note",
            "add_new_item" => "add new note",
            "not_found" => "no notes found",
            "edit_item" => "edit note"
        ),
        "show_in_rest" => true,
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
        ),
        'public' => false,
        "show_ui" => true,
        'menu_icon' => 'dashicons-clipboard',
        'menu_position' => 10,
        "capability_type" => "note",
        "map_meta_cap" => true,
    ));

    register_post_type( 'like', array(
        'labels' => array(
            'name' => 'User likes',
            "all_items" => "All likes",
            'singular_name' => 'like',
            'add_new' => "new like",
            "add_new_item" => "add new like",
            "not_found" => "no likes found",
            "edit_item" => "edit like"
        ),
        'has_archive' => false,
        'supports' => array(
            'title',
        ),
        'public' => false,
        "show_ui" => true,
        'menu_icon' => 'dashicons-heart',
    ));

};
add_action('init', 'gacast_theme_custom_post_type');

