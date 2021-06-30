<?php
/**
* Template Name: My notes
*/

if (!is_user_logged_in()) {
    wp_redirect( esc_url(site_url("/")) );
    exit;
}

get_header();

$currentUser = wp_get_current_user();

page_banner(array(
    'title' => "Welcome back, " . $currentUser->user_login . "." 
));
	?>
    <div class="blog_content notes_content">
        <div class="margin_reset" style="margin-top: -10rem">
            <h2>my notes</h2>
            <div class="notes">
            <div class="create_note" id="create_note">
                <input type="text" class="create_note_title" placeholder="title">
                <textarea placeholder="description" cols="30" rows="10" class="create_note_text"></textarea>
                <button class="creat_note_btn btn">create note</button>
                <p class="alert_note">please make sure the fields are not empty</p>
            </div>
                <ul id="all_notes">
                    <?php 
                        $notesQuery = new WP_Query(array(
                            "post_type" => "usernote",
                            "author" => get_current_user_id(),
                        ));

                        while($notesQuery->have_posts()) {
                            $notesQuery->the_post(); ?>

                                <li data-id="<?php echo get_the_ID() ?>" data-edit="no">
                                    <div>
                                        <label for="note_title">note title</label>
                                        <button class="edit_note">edit</button><button class="delete_note">delete</button>
                                    </div>
                                    <input class="note_title" type="text" value="<?php echo esc_attr(get_the_title()); ?>"  readonly>
                                    <label for="note_desc">note description</label>
                                    <textarea name="note_desc" id="note_desc" cols="30" rows="10" readonly><?php echo esc_textarea(get_the_content())?></textarea>
                                    <button class="save_note">save</button>
                                    <!--<div class="popup_note">
                                        <h5>do you wanna delete ?</h5>
                                        <div>
                                            <button class="yes_btn">yes</button>
                                            <button class="no_btn">no</button>
                                        </div>
                                    </div>-->
                                    
                                </li>

                        <?php }
                        wp_reset_postdata();
                    ?>
                </ul>
            </div>
        </div>
    </div>

<?php get_footer(); ?>