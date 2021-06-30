<?php 
add_action('rest_api_init','gocast_rest_route');

function gocast_rest_route() {
    register_rest_route( "gocast_api/v1", "api", array(
        "methods" => WP_REST_SERVER::READABLE,
        "callback" => "gocast_fetch_api"
    ));
};

function gocast_fetch_api($data) {
    $results = new WP_Query(array(
        'post_type' => array("podcasts", "page", "post"),
        "s" => sanitize_text_field($data["search"])
    ));



    $allResult = array(
        "generalinfo" => array(),
        "podcasts" => array() 
    );
    
    while($results->have_posts()) {
        $results->the_post();

        if(get_post_type() == "post" || get_post_type() == "page") {
            array_push($allResult['generalinfo'], array(
                'title' => get_the_title(),
                'author' => get_author_name(),
                "link" => get_the_permalink(),
                "type" => get_post_type()
            ));
        }
        if(get_post_type() == "podcasts") {
            array_push($allResult['podcasts'], array(
                'title' => get_the_title(),
                "link" => get_the_permalink(),
                "image" => get_the_post_thumbnail()
            ));
        }
        
    };

    return $allResult;
}

