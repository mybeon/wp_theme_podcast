<?php
/** ADD EDITABLE SECTIONS */

function gocast_theme_editable($wp_customize) {

// ADD ABOUT SECTION

$wp_customize->add_section('page-about-section', array(
    'title' => 'About section',
));

$wp_customize->add_setting('page-about-headline', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'page-about-headline-control', array(
    'section' => 'page-about-section',
    'settings' => 'page-about-headline',
    'label' => 'Title',
    'description' => 'type here to change the title of the about page',
)));


$wp_customize->add_setting('page-about-text', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'page-about-text-control', array(
    'section' => 'page-about-section',
    'settings' => 'page-about-text',
    'label' => 'description',
    'description' => 'type here to change the desciption of the about page',
    'type' => 'textarea',
)));

// ADD SOCIAL LINKS

$wp_customize->add_section('social-link-section', array(
    'title' => 'Social Links',
));

// INSTA
$wp_customize->add_setting('instagram-link', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'instagram-control', array(
    'section' => 'social-link-section',
    'settings' => 'instagram-link',
    'label' => 'Instagram',
    'description' => 'Example link : https://www.example.com/',
)));

// LINKEDIN
$wp_customize->add_setting('linkedin-link', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'linkedin-control', array(
    'section' => 'social-link-section',
    'settings' => 'linkedin-link',
    'label' => 'LinkedIn',
    'description' => 'Example link : https://www.example.com/',
)));

//SKYPE
$wp_customize->add_setting('skype-link', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'skype-control', array(
    'section' => 'social-link-section',
    'settings' => 'skype-link',
    'label' => 'Skype',
    'description' => 'Example link : https://www.example.com/',
)));

//FACEBOOK
$wp_customize->add_setting('facebook-link', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'facebook-control', array(
    'section' => 'social-link-section',
    'settings' => 'facebook-link',
    'label' => 'Facebook',
    'description' => 'Example link : https://www.example.com/',
)));

//SPOTIFY
$wp_customize->add_setting('spotify-link', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'spotify-control', array(
    'section' => 'social-link-section',
    'settings' => 'spotify-link',
    'label' => 'Spotify',
    'description' => 'Example link : https://www.example.com/',
)));

//APPLE
$wp_customize->add_setting('apple-link', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'apple-control', array(
    'section' => 'social-link-section',
    'settings' => 'apple-link',
    'label' => 'Apple podcasts',
    'description' => 'Example link : https://www.example.com/',
)));

//Google
$wp_customize->add_setting('google-link', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize
, 'google-control', array(
    'section' => 'social-link-section',
    'settings' => 'google-link',
    'label' => 'Google podcasts',
    'description' => 'Example link : https://www.example.com/',
)));


// TRENDING POCAST SECTION

$wp_customize->add_section('trending_podcast_section', array(
    'title' => 'Trending podcast',
));

$wp_customize->add_setting('trending_podcast_title', array(
    'default' => 'Dreams of an unique ideas scattered through a deserted.
    ',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'trending_podcast_title_control', array(
    'settings' => 'trending_podcast_title',
    'section' => 'trending_podcast_section',
    'label' => 'Title',
)));


$wp_customize->add_setting('trending_podcast_description', array(
    'default' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'trending_podcast_description_control', array(
    'settings' => 'trending_podcast_description',
    'section' => 'trending_podcast_section',
    'label' => 'Description',
    'type' => 'textarea',
)));


$wp_customize->add_setting('trending_podcast_url', array(
    'default' => '',
));

$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'trending_podcast_url_control', array(
    'settings' => 'trending_podcast_url',
    'section' => 'trending_podcast_section',
    'label' => 'Audio url',
    'description' => 'Example url: https://www.example.com/',
)));
};
add_action('customize_register','gocast_theme_editable' );