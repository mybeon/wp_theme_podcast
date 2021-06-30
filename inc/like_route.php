<?php
add_action('rest_api_init', function() {
    register_rest_route('gocast_api', 'likes', array(
        "methods" => "POST",
        "callback" => "likes_post"
    ));
    register_rest_route('gocast_api', 'likes', array(
        "methods" => "DELETE",
        "callback" => "likes_delete"
    ));
});

function likes_post($data) {
    if (is_user_logged_in()) {
        $postID = sanitize_text_field($data["postID"] );

        $user_liked_posts = new WP_Query(array(
            'post_type' => "like",
            "author" => get_current_user_id(),
            'meta_query' => array(
              array(
                "key" => "liked_post_id",
                "compare" => "=",
                "value" => $postID
              )
            )
          ));

            if($user_liked_posts->found_posts == 0 && get_post_type($postID) == "post") {
                return  wp_insert_post(array(
                    "post_type" => "like",
                    "post_status" => "publish",
                    "post_title" => "liked post",
                    "meta_input" => array(
                        "liked_post_id" => $postID
                    )
                ));
            } else {
                die("you already liked the post");
            }

        
    } else {

        die("you can't like post cause you're not logged in");
    }
    
}

function likes_delete($data) {

    $likeID = sanitize_text_field( $data["likeID"]);
    if(get_current_user_id() == get_post_field( 'post_author', $likeID ) && get_post_type($likeID) == "like") {
        wp_delete_post( $likeID, true);
    } else {
        die;
    }
    return "you deleted a like";
}