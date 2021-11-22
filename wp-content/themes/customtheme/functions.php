<?php

// Path: wp-content/themes/customtheme/functions.php
// load stylesheets
function load_css() {
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all' );
    wp_enqueue_style( 'bootstrap' );
  

    wp_register_style( 'main', get_template_directory_uri() . '/css/main.css', array(), false, 'all' );
    wp_enqueue_style( 'main' );
   
}
add_action( 'wp_enqueue_scripts', 'load_css' );

// Path: wp-content/themes/customtheme/functions.php
// load javascript
function load_js() {
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true );
    wp_enqueue_script( 'bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'load_js' );

// Theme options
add_theme_support( 'menus' );              // Add menu support
add_theme_support( 'post-thumbnails' );   // Add feature image support

// Custom Image Sizes
add_image_size( 'small-thumbnail', 180, 120, true );
add_image_size( 'banner-image', 1920, 210, true );
add_image_size( 'blog-image', 400, 400, true );
add_image_size( 'blog-image-small', 300, 200, true );
add_image_size( 'blog-image-large', 800, 400, true );

// Menus
register_nav_menus(
    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
        'footer-menu' => 'Footer Menu Location',
    )
);

//  Export Pages View to a spreadsheet
function func_export_all_posts() {
    if(isset($_GET['export_all_posts'])) {
        $arg = array(
            'post_type'      =>  $_GET['post_type'],
            'author'         =>  $_GET['author'],
            'post_status'    =>  $_GET['post_status'],
            'posts_per_page' => -1,
        );
        global $post;
        $arr_post = get_posts($arg);
        if ($arr_post) {
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="Custom_site_Export_'.date('Y-m-d').'.csv');
            header('Pragma: no-cache');
            header('Expires: 0');
            $file = fopen('php://output', 'w');
            fputcsv($file, array('Page Title', 'URL', 'Date Published', 'Last Modified', 'Author', 'Post Status'));
  
            foreach ($arr_post as $post) {
                setup_postdata($post);
                fputcsv($file, array(get_the_title(), get_the_permalink(), get_the_date('Y/m/d g:ia'), get_the_modified_date('Y/m/d g:ia'), get_the_author(), $current_post_status = get_post_status()));
            }
            exit();
        }
    }
}
add_action( 'init', 'func_export_all_posts' );

// Export Pages View to a spreadsheet button
function admin_page_list_add_export_button( $which ) {
    global $typenow;
    if ( 'page' === $typenow && 'top' === $which ) {
        ?>
    <input type="submit" name="export_all_posts" class="button button-primary" value="<?php _e('Export All Pages'); ?>" />
<?php
    }
    // Export Pages View to a spreadsheet button
    if ( 'post' === $typenow && 'top' === $which ) {
        ?>
    <input type="submit" name="export_all_posts" class="button button-primary" value="<?php _e('Export All Pages'); ?>" />
<?php
    }
}
add_action( 'manage_posts_extra_tablenav', 'admin_page_list_add_export_button', 20, 1 );



// Register the column for Last Modified
function bf_post_modified_column_register( $columns ) {
    $columns['post_modified' ] = __( 'Last Modified',  'textdomain' );
    return $columns;
}
add_filter( 'manage_edit-post_columns', 'bf_post_modified_column_register' );
add_filter( 'manage_edit-page_columns', 'bf_post_modified_column_register' );

function exlude_last_modified_columns(){
    if(isset($_GET['post_status'])) {
        switch ($_GET['post_status']) {
            case 'archive':
                remove_filter( 'manage_edit-post_columns', 'bf_post_modified_column_register' );
                remove_filter( 'manage_edit-page_columns', 'bf_post_modified_column_register' );
                break;
            case 'deprecate':
                remove_filter( 'manage_edit-post_columns', 'bf_post_modified_column_register' );
                remove_filter( 'manage_edit-page_columns', 'bf_post_modified_column_register' );
                break;
        }
    }
    
} 
add_action( 'load-edit.php', 'exlude_last_modified_columns' );
 
// Display the Last Modified column content
function bf_post_modified_column_display( $column_name, $post_id ) {
    if ( 'post_modified' != $column_name ){
        return;
    }
    $post_modified = get_post_field('post_modified', $post_id);
    if ( !$post_modified ){
        $post_modified = '' . __( 'undefined',  'textdomain' ) . '';
    }

    
    // echo $post_modified; 
    $m_orig     = get_post_field( 'post_modified', $post_id, 'raw' );
    $m_stamp    = strtotime( $m_orig );
    $modified   = date('Y/m/d \a\t g:i a', $m_stamp );
    $modr_id    = get_post_meta( $post_id, '_edit_last', true );
    $auth_id    = get_post_field( 'post_author', $post_id, 'raw' );
    $user_id    = !empty( $modr_id ) ? $modr_id : $auth_id;
    $user_info  = get_userdata( $user_id );

    echo '<p class="mod-date">';
    echo $modified.'<br />';
    
}
add_action( 'manage_posts_custom_column', 'bf_post_modified_column_display', 10, 2 );
add_action( 'manage_pages_custom_column', 'bf_post_modified_column_display', 10, 2 );


// Register the Last Modified column as sortable
function bf_post_modified_column_register_sortable( $columns ) {
    $columns['post_modified'] = 'post_modified';
    return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'bf_post_modified_column_register_sortable' );
add_filter( 'manage_edit-page_sortable_columns', 'bf_post_modified_column_register_sortable' );


 /**
* This section makes posts & pages in the admin filterable by the author.
*/

function ditt_filter_by_author() {
        $params = array(
            'show_option_all' => 'All Users',
            'name' => 'author',
            'role__in' => array('author','editor','administrator','contributor')
        );
        if ( isset($_GET['user']) ) {
            $params['selected'] = $_GET['user'];
            
    }
    wp_dropdown_users( $params ); 
}
add_action('restrict_manage_posts', 'ditt_filter_by_author');


//  The user role changes to the editor. The user receives an email
function user_role_changed( $user_id, $new_role ) { 
    if ($new_role == 'editor') {
        $blog_title = get_bloginfo("name");
        $site_url = get_bloginfo('wpurl');
        $user_info = get_userdata( $user_id );
        $to = $user_info->user_email;
        $subject = "Role changed: ".$site_url."";
        $message = "Hello " .$user_info->display_name . ",  <br><p>You have been granted edit permissions on ".$blog_title." ".$site_url." 
        <p>Before getting started, please take a moment and review the (company_name) User Guide documents located
        <br>here: ".$site_url."/wp-admin/admin.php?page=user_guide&ID=1&title=Introduction </p>
        Additionally, there are helpful technical guides, screen captures and FAQ on this external resource for WordPress, the technology the NCATS Intranet is built upon:
        <br> https://wordpress.org/support/article/wordpress-editor/ <br> <p>Thanks!</p>";
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $message, $headers);
    }
}
add_action( 'set_user_role', 'user_role_changed', 10, 2);

// add role Content Auditor
add_role('content_auditor', __(
    'Content Auditor'),
    array(
        'read'  => true,
    )
);

function hide_menu() {
    global $wp_post_types;
    // Use this for specific user role. Change content auditor part accordingly
    if (current_user_can('content_auditor')) {
       $role = get_role(  'content_auditor' );
       $role->add_cap(  'edit_pages' );
    }   
    // don't allow content auditor to create or publish pages
    $user = wp_get_current_user();
    if ($user->roles[0] == 'content_auditor') {
        $wp_post_types['page']->cap->create_posts = 'do_not_allow'; 
           /* DASHBOARD */	
        remove_menu_page('post-new.php?post_type=page');
        remove_menu_page('upload.php');
        remove_menu_page( 'edit.php?post_type=division' );
        remove_menu_page( 'profile.php' );
        remove_menu_page( 'index.php' );
        // disable "Add New" button on submenu and adminmenu
        echo '<style type="text/css">
         #adminmenu .wp-has-current-submenu ul > li > a, .folded #adminmenu li.menu-top .wp-submenu > li > a, .wp-submenu
         { display:none !important;  }
        </style>';
    }
}
add_action('admin_head','hide_menu');