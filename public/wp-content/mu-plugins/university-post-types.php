<?php 
// http://fictional-university.local/ - AIzaSyCzuksMdCFDKqZdKZ3L9m_Zqc1O6q2S9KQ
// Must use plugins - are automatically loaded and activated and cant be deactivated until the files exists in this folder

function university_post_types(){
    //Campus Post Type
    register_post_type('campus', array(
        'has_archive' => true,
        'supports' => array(
            'title','editor', 'excerpt'
        ),
        'rewrite' => array(
            'slug' => 'campuses'
        ),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt'
    ));

    //Event Post Type
    //specify the name of the custom post type that we want to create
    register_post_type('event', array(
        'has_archive' => true,
        'supports' => array(
            'title','editor', 'excerpt'
        ),
        'rewrite' => array(
            'slug' => 'events'
        ),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    //Program Post Type
    register_post_type('program', array(
        'has_archive' => true,
        'supports' => array(
            'title','editor'
        ),
        'rewrite' => array(
            'slug' => 'programs'
        ),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ));

    //Professor Post Type
    register_post_type('professor', array(
        //No need professor archive because we can either search the professor or identify from the assosiated program/campuses they teach
        // 'has_archive' => true,
        'supports' => array(
            'title','editor','thumbnail'
        ),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));
}

add_action('init','university_post_types');
