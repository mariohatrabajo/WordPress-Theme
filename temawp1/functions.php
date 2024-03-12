<?php

    // Add theme support
    add_theme_support('post-thumbnails'); // Allow us to add a featured images to our posts
    

    /**
    *    Add CSS, JS files to our themes
    */
    function temawp1_scripts() {
        // Add main css stylesheet
        wp_enqueue_style('style', get_stylesheet_uri());
        // Add secondary stylesheets
        wp_enqueue_style('aos', get_template_directory_uri().'/assets/vendor/aos/aos.css');
        wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/vendor/bootstrap/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap-icons', get_template_directory_uri().'/assets/vendor/bootstrap-icons/bootstrap-icons.css');
        wp_enqueue_style('boxicons', get_template_directory_uri().'/assets/vendor/boxicons/css/boxicons.min.css');
        wp_enqueue_style('glightbox', get_template_directory_uri().'/assets/vendor/glightbox/css/glightbox.min.css');
        wp_enqueue_style('remixicon', get_template_directory_uri().'/assets/vendor/remixicon/remixicon.css');
        wp_enqueue_style('swiper', get_template_directory_uri().'/assets/vendor/swiper/swiper-bundle.min.css');
        wp_enqueue_style('stylesheet', get_template_directory_uri().'/assets/css/style.css');
        
        // Add JS script files
        wp_register_script('purecounter', get_template_directory_uri().'/assets/vendor/purecounter/purecounter_vanilla.js', null, null, true);
        wp_enqueue_script('purecounter');
        
        wp_register_script('aos-js', get_template_directory_uri().'/assets/vendor/aos/aos.js', null, null, true);
        wp_enqueue_script('aos-js');
        
        wp_register_script('bootstrap-js', get_template_directory_uri().'/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', null, null, true);
        wp_enqueue_script('bootstrap-js');
        
        wp_register_script('glightbox-js', get_template_directory_uri().'/assets/vendor/glightbox/js/glightbox.min.js', null, null, true);
        wp_enqueue_script('glightbox-js');
        
        wp_register_script('isotope', get_template_directory_uri().'/assets/vendor/isotope-layout/isotope.pkgd.min.js', null, null, true);
        wp_enqueue_script('isotope');
        
        wp_register_script('swiper-js', get_template_directory_uri().'/assets/vendor/swiper/swiper-bundle.min.js', null, null, true);
        wp_enqueue_script('swiper-js');
        
        wp_register_script('validate', get_template_directory_uri().'/assets/vendor/php-email-form/validate.js', null, null, true);
        wp_enqueue_script('validate');
        
        wp_register_script('main', get_template_directory_uri().'/assets/js/main.js', null, null, true);
        wp_enqueue_script('main');
        
        wp_enqueue_script('masonry'); // Activate the masonry library
        
        wp_register_script('masonry-init', get_template_directory_uri().'/assets/js/masonry-init.js', null, null, true);
        wp_enqueue_script('masonry-init');
        
    }
    // Enlaza la funcion a un hook (Este hook enlaza scripts en el front end solo)
    add_action('wp_enqueue_scripts', 'temawp1_scripts');
    
    function add_admin_scripts() {
        wp_register_script('preview', get_template_directory_uri().'/assets/js/preview.js', null, null, true);
        wp_enqueue_script('preview');
        
    }
    // Enlaza scripts en admin area
    add_action('admin_enqueue_scripts', 'add_admin_scripts');
    

/* 
*   Retrieves a page object based on the title of the page
*   @param $title string Page title
*   @return $page Page object
*/
function get_page_object( $title) {
    $query = new WP_Query(
        array(
            'post_type'              => 'page',
            'title'                  =>  $title,
            'post_status'            => 'all',
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'ignore_sticky_posts'    => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'orderby'                => 'post_date ID',
            'order'                  => 'ASC',
        )
    );

    if ( ! empty( $query->post ) ) { // Si la ha encontrado
        $page = $query->post;
    } else {
        $page  = null;
    }
    return $page;
}
    
    
/* 
*   List post tags
*   @param $id integer post ID
*   @return $tags string list of the post's tags
*/
function get_post_tags($id){
    return $tags;
}

    
/* 
*   Register widget zone for tag-cloud and calendar in sidebar
*/
function register_widgets_zone(){
    $args = Array(
        'name' => 'Sidebar Widgets', // El nombre que hemos usado en el if del sidebar
        'id' => 'sidebar-widgets', // El id del div que va a crear esto donde lo llamemos
        'description' => 'Sidebar Widgets Zone',
        'before_widget' => '<div class="widget-zone">', // Para decidir que va a envolver a los widgets
        'after_widget' => '</div>',
    );
    register_sidebar($args);
}
add_action('widgets_init', register_widgets_zone);

 
/* 
*   Retrieve the number of visits of a post
*   @param int post_id
*   @return string number of visits
*/
function get_num_visits($post_id){
    $numvisits = get_post_meta($post_id, 'numvisits', true);
    
    // Si no se ha creado el dato, se pone a 0
    if(!$numvisits)
        $numvisits = 0;
        
    if($numvisits == 1)
        return $numvisits.' visit';
    else
        return $numvisits.' visits';
}
/* 
*   Update the number of visits of a post
*   @param int post_id
*/
function add_num_visits($post_id){
    $numvisits = get_post_meta($post_id, 'numvisits', true);
    
    if($numvisits == 0){ // The counter doesn't exist yet, we must create it
        add_post_meta($post_id, 'numvisits', 1, true);
    } else { // The counter exists, we add 1 to it
        update_post_meta($post_id, 'numvisits', $numvisits+1);
    }
}


/* ------------------ Authors -------------------- */

/* 
*   Returns an author's role
*   @param $author_id author's id
*   @return $role the author's roles as a string comma separated
*/
function get_author_role($author_id) {
    // Get the author object
    $author = get_userdata($author_id);
    // Store the author roles
    $roles = $author->roles;
    // Retrieve the author roless like a string comma separated
    return implode(',', $roles);
}

/* 
*   Add social media fields to the user settings in the admin area (Método simple)
*   @param $user_methods array with User profile fields - Provided by 'user_contactmethods' action hook
*   @return $user_methods array Usser profile fields with the new fields
*/
function add_social_media_fields ($user_methods){
    $user_methods["instagram"] = "Instagram";
    $user_methods["facebook"] = "Facebook";
    $user_methods["twitter"] = "Twitter";
    $user_methods["linkedin"] = "LinkedIn";
    
    return $user_methods;
}
add_action('user_contactmethods', 'add_social_media_fields');


/*  
*   Insert enctype to user profile form in admin area
*/
function add_enctype_to_user_form(){
    echo 'enctype="multipart/form-data"';
}
add_action('user_edit_form_tag', 'add_enctype_to_user_form');


/*  
*   Add skills to the user profile (Método versátil)
*   @param $user user object provided by the hooks 'show_user_profile' and 'edit_user_profile'
*/
function add_user_skill_info ($user){
    // Draw the form fields for skills with html tags
    
    // If we have an image uploaded, we get its url, on the contrary, display transparent miniature
    if( !empty( get_user_meta( $user->ID, 'user_pic', true ) ) ){
        $src = get_user_meta( $user->ID, 'user_pic', true );
    }else {
        $src = get_template_directory_uri()."/assets/img/transparente.png";
    }
    ?>
    <h3>User Profile Picture</h3>
    <div class="flex-profile-pic">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        <input type="file" id="user_pic" name="user_pic">
    </div>
    <div>
        <img src="<?php echo $src; ?>" id="previewImg" height="200">
        <p><?php echo get_user_meta( $user->ID, 'user_pic', true ); ?></p>
    </div>
    
    <h3>User Skills</h3>
    <table class="form-table">
        <tr>
            <th><label for="skill1">Skill 1</label></th>
            <td><input type="text" id="skill1" name="skill1" value="<?php echo get_user_meta($user->ID, 'skill1', true); ?>"></td>
            <th><label for="skill1V">Skill 1 Value</label></th>
            <td><input type="number" min="0" max="100"  id="skill1V" name="skill1V" value="<?php echo get_user_meta($user->ID, 'skill1V', true); ?>"></td>
        </tr>
        <tr>
            <th><label for="skill2">Skill 2</label></th>
            <td><input type="text" id="skill2" name="skill2" value="<?php echo get_user_meta($user->ID, 'skill2', true); ?>"></td>
            <th><label for="skill2V">Skill 2 Value</label></th>
            <td><input type="number" min="0" max="100"  id="skill2V" name="skill2V" value="<?php echo get_user_meta($user->ID, 'skill2V', true); ?>"></td>
        </tr>
        <tr>
            <th><label for="skill3">Skill 3</label></th>
            <td><input type="text" id="skill3" name="skill3" value="<?php echo get_user_meta($user->ID, 'skill3', true); ?>"></td>
            <th><label for="skill3V">Skill 3 Value</label></th>
            <td><input type="number" min="0" max="100"  id="skill3V" name="skill3V" value="<?php echo get_user_meta($user->ID, 'skill3V', true); ?>"></td>
        </tr>
        <tr>
            <th><label for="skill4">Skill 4</label></th>
            <td><input type="text" id="skill4" name="skill4" value="<?php echo get_user_meta($user->ID, 'skill4', true); ?>"></td>
            <th><label for="skill4V">Skill 4 Value</label></th>
            <td><input type="number" min="0" max="100" id="skill4V" name="skill4V" value="<?php echo get_user_meta($user->ID, 'skill4V', true); ?>"></td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'add_user_skill_info');
add_action('edit_user_profile', 'add_user_skill_info');


/*  
*   Save the skills fields values in user profile
*   @param $user_id user object provided by two hooks: 'personal_options_update' and 'edit_user_profile_update'
*/
function save_skills_info ($user_id){
    // Save our profile pic
    // Grab the file data
    $user_info = get_userdata($user_id);
    $user_name = $user_info->user_login; // We save the only name that is unique so the photo files have unique names
    
    if($_FILES['user_pic']['error'] == UPLOAD_ERR_OK){
        $upload_dir = wp_upload_dir(); // Directory where wp lets us upload files
        $subdir = "/team/";
        $upload_path = $upload_dir['basedir'].$subdir;
        $file_name = $user_name."_".$_FILES['user_pic']['name'];
        $file_temp = $_FILES['user_pic']['tmp_name'];
        $file_dest = $upload_path.$file_name;
        
        if( move_uploaded_file($file_temp, $file_dest)) {
            // The file has been correctly moved
            $upload_dir = wp_get_upload_dir();
            $file_url = $upload_dir['baseurl'].$subdir.$file_name;
            
            update_user_meta( $user_id, 'user_pic', $file_url );
        } else {
            // Some error has occurred -> store the error message
            $pic_error = "<strong>ERRORES!</strong> Something bad happens, the pic could not be loaded...";
            update_user_meta( $user_id, 'user_pic', $pic_error );
        }
    }
    
    // Save the skills
    update_user_meta($user_id, 'skill1', $_POST['skill1']);
    update_user_meta($user_id, 'skill1V', $_POST['skill1V']);
    update_user_meta($user_id, 'skill2', $_POST['skill2']);
    update_user_meta($user_id, 'skill2V', $_POST['skill2V']);
    update_user_meta($user_id, 'skill3', $_POST['skill3']);
    update_user_meta($user_id, 'skill3V', $_POST['skill3V']);
    update_user_meta($user_id, 'skill4', $_POST['skill4']);
    update_user_meta($user_id, 'skill4V', $_POST['skill4V']);
}
add_action('personal_options_update', 'save_skills_info');
add_action('edit_user_profile_update', 'save_skills_info');



/*  
*   List post tags
*   @param $limit integer Number of tags listed
*   @return $tag_list string List of tags
*/
function get_tag_list($limit) {

    $args = Array(
        'number' => $limit,    
        'orderby' => 'count',
        'order' => 'DESC',
    );
    $tags = get_tags($args); // Tag object collection
    
    $tag_list = '';
    
    foreach($tags as $tag){
        $tag_list .= '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.' <span class="category-count">'.$tag->count.'</span></a></li>';
    }
    
    return $tag_list;
}



// ---------------------------------------------------------------------------- COMMENTS

/*  
*   Remove the url field from the comments form
*   @param $fields array Form fields list -> from the hook comment_form_default_fields
*   @return $fields array
*/
function delete_url_from_comment_form($fields) {
    unset($fields['url']);
    
    return $fields;
}
add_action('comment_form_default_fields', 'delete_url_from_comment_form');


/*  
*   Reorder the comment form fields
*   @param $fields array Form fields list -> from the hook comment_form_fields
*   @return $fields array
*/
function reorder_comment_form_fields($fields){
    
    if(!is_user_logged_in()){
        $aux = array();
        
        array_push($aux, $fields['author']);
        array_push($aux, $fields['email']);
        array_push($aux, $fields['comment']);
        array_push($aux, $fields['cookies']);
        array_push($aux, $fields['consent']);
        
        return $aux;
    }else{
        return $fields;
    }
}
add_action('comment_form_fields', 'reorder_comment_form_fields');


/*  
*   Add consent field to the comment form
*   @param $fields array Form fields list -> from the hook comment_form_default_fields
*   @return $fields array
*/
function add_consent_field($fields) {
    
    $fields['consent'] = '<p class="comment-form-privacy-consent">
                            <input type="checkbox" name="consent" id="consent">
                            <label for="consent">Check this box to allow us to post your comment. Doing so, you are accepting our <a href="'.get_page_link(get_page_object('Privacy Policy')->ID).'" target="_blank">privacy policy</a>.</label>
                         </p>';
    
    return $fields;
}
add_action('comment_form_default_fields', 'add_consent_field');


/*  
*   Save comment consent field in the database
*   @param $comment_id int comment consent form field ID -> provided by the hook 'comment_post'
*/
function save_consent_field($comment_id) {
    
    $consent_value = $_POST['consent'];
    
    if($consent_value){
        $value = 'Consent checkbox is checked. I accept the privacy policy.';
    }else {
        // This can be the user didnt checked the box or they are already logged and the checkbox didnt show up
        if(is_user_logged_in()){
            $value = 'Logged user. Privacy Policy have been already accepted.';
        } else {
            $value = 'Consent checkbox NOT checked. I do NOT accept the privacy policy.';
        }
    }
    
    update_comment_meta($comment_id, 'consent', $value);
}
add_action('comment_post', 'save_consent_field');


/*  
*   Add consent column to the admin area
*   @param $columns array All the columns on the admin area comment table -> provided by the hook 'manage_edit-comments_columns'
*   @return $columns array
*/
function create_consent_column($columns){
    
    $columns = array(
        'cb' => '<input type="checkbox">',
        'author' => 'Author',
        'comment' => 'Comment',
        'consent' => 'Consent',
        'response' => 'In response to',
        'date' => 'Submitted on',
    );
    
    return $columns;
}
add_action('manage_edit-comments_columns', 'create_consent_column');


/*  
*   Display consent comment form field in admin area
*   @param $column string column where we will display the value -> provided by the hook 'manage_comments_custom_column'
*   @param $comment_id array Comment ID
*/
function display_consent_column_value($column, $comment_id){
    if($column == 'consent'){
        echo get_comment_meta($comment_id, 'consent', true);
    }
}
add_action('manage_comments_custom_column', 'display_consent_column_value', 1, 2);


// ---------------------------------------------- CUSTOMIZE LOGIN

/*  
*   Customize login template LOGO
*/
function custom_login_logo() {
    ?>
    <style>
        #login h1 a, .login h1 a {
            background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/Logo.png');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            width: 300px;
        }
        
        .login {
            background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .privacy-policy-page-link, #nav {
            background-color: white;
            padding: .5rem !important;
        }
        
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'custom_login_logo');


/*  
*   Redirect login logo url
*/
function redirect_login_logo_url(){
    return home_url("/");
}
add_filter('login_headerurl', 'redirect_login_logo_url');


/*  
*   Customize login errors
*/
function customize_login_error() {
    return "Ooopsies! You must enter a valid username and password...";
}
add_filter('login_errors', 'customize_login_error');

// ---------------------------------------------------------------------------- SHORTCODES
function br_callback(){
    return '<br/>';
}
add_shortcode('br', 'br_callback');


/**
* Custom posts per page depending on template
* @param $query object WP Query -> Provided by the hook 'pre_get_posts'
*/
function modify_query($query){
    if((is_search() || is_archive()) && $query->is_main_query() && !is_admin()){
        // Modify WP Query argument 'posts_per_page'
        $query->set('posts_per_page', '15');
        $query->set('post_type', array('post', 'page', 'coverage'));
    }
}
add_action('pre_get_posts', 'modify_query');
