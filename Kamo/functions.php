<?php

// Path: wp-content/themes/kamo/functions.php
// load stylesheets
function load_css() {
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all' );
    wp_enqueue_style( 'bootstrap' );
     
    // load magnific-popup css
    wp_register_style( 'magnific', get_template_directory_uri() . '/css/magnific-popup.css', array(), false, 'all' );
    wp_enqueue_style( 'magnific' );
    
    wp_register_style( 'main', get_template_directory_uri() . '/css/main.css', array(), false, 'all' );
    wp_enqueue_style( 'main' );
    
}
add_action( 'wp_enqueue_scripts', 'load_css' );

// Path: wp-content/themes/kamo/functions.php
// load javascript
function load_js() {
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true );
    wp_enqueue_script( 'bootstrap' );

    // load magnific-popup js
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', 'jquery', false, true );
    wp_enqueue_script( 'magnific' );

    // load custom js
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.js', 'jquery', false, true );
    wp_enqueue_script( 'custom' );

}
add_action( 'wp_enqueue_scripts', 'load_js' );

// Theme options
add_theme_support( 'menus' );              // Add menu support
add_theme_support( 'post-thumbnails' );   // Add feature image support
add_theme_support('widgets');             // Add widget support


// Custom Image Sizes
add_image_size( 'blog-image-small', 300, 200, true );
add_image_size( 'blog-large', 800, 600, true );
add_image_size( 'blog-medium', 400, 300, true );

// Menus
register_nav_menus(
    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
        'footer-menu' => 'Footer Menu Location',
    )
);

// register sidebars
function my_sidebars() {
    register_sidebar(
        array(
            'name' => 'Page Sidebar',
            'id' => 'page-sidebar',
            'before_widget' => '<div class="sidebar-module">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        )
    );
    register_sidebar(
        array(
            'name' => 'Blog Sidebar',
            'id' => 'blog-sidebar',
            'before_widget' => '<div class="sidebar-module">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        )
    );
}
add_action( 'widgets_init', 'my_sidebars' );

// Custom login 
function customtheme_custom_logo_setup() {
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description', 'tagline' ),
        'unlink-homepage-logo' => true, 
    );
    add_theme_support( 'custom-logo', $defaults ); 
 }
 add_action( 'after_setup_theme', 'customtheme_custom_logo_setup' );

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

// Identify External Links it not showing icons
function add_this_script_footer(){ ?>
    <script>
        jQuery('a[href]:not([href*="' + (location.host.match(/([^.]+)\.\w{2,3}(?:\.\w{2})?$/) || [])[0] + '"])a[href*="$url"],a[href*=".org/"],a[href*=".com/"],a[href*=".ie/"],a[href*=".eu/"],a[href*=".net/"],a[href*=".io/"]:not(:has(img)):not(#emergency-message a):not( #navigation a)').append(' <i class="fa fa-external-link-alt fa-xs"></i>');
    </script>
<?php }
add_action('wp_footer', 'add_this_script_footer');

// custome post type for cars 
function create_post_type() {
    $args = array(
        'labels' => array(
            'name' => __( 'Cars' ),
            'singular_name' => __( 'Car' )
        ),
        'hierarchical' => true,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-car',
        'supports' => array( 'title', 'editor', 'thumbnail',  'custom-fields'),
        // 'rewrite' => array('slug' => 'my-cars'),
    );
    register_post_type( 'cars', $args);
      
}
add_action( 'init', 'create_post_type' );

// taxonomy for cars
function create_taxonomy() {
    $args = array(
        'labels' => array(
            'name' => __( 'Brands' ),
            'singular_name' => __( 'Brand' )
        ),
        'hierarchical' => true,
        'public' => true,
       
    );
    register_taxonomy( 'brands', array('cars'), $args);
}
add_action( 'init', 'create_taxonomy' );

// Manipulate the data that's been posted enquiry form.
function enquiry_form() {
     
    if( !wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' )  ){
        wp_send_json_error('Nonce is incorrect', 401);
		die();
    }

    $formdata = [];
        
    wp_parse_str($_POST['enquiry'], $formdata);

    // Admin email.
    $admin_email = get_option('admin_email');

    // Email headers.
    $headers[] = 'content-type: text/html; charset=UTF-8';
    $headers[] = 'From: ' . $admin_email;
    $headers[] = 'Reply-To: ' . $formdata['email'];
    // $headers[] = 'cc: ' . $admin_email['email'];

    // Who are we sending the email to?
    $send_to = $admin_email;

    // Subject line.
    $subject = 'Enquiry from ' . $formdata['fname'] .' '. $formdata['lname'];

    // Message body.
    $message = '';

    foreach ($formdata as $index => $field) 
    {
        $message .= '<strong>' . $index . '</strong>: ' . $field . '<br />';
    }

    try { 
        if(wp_mail($send_to, $subject, $message, $headers ) ) 
        {
            wp_send_json_success( 'Emial sent' );
        }
        else
        {
            wp_send_json_error( 'Email not sent' );
        }
        
    } catch (Exception $e) {
        wp_send_json_error( $e->getMessage() );
    }
    
    wp_send_json_success( $formdata['fname'] );
}
add_action( 'wp_ajax_enquiry', 'enquiry_form' );
add_action( 'wp_ajax_nopriv_enquiry', 'enquiry_form' );

/**
 * Register Custom Navigation Walker
 * bootstrap 5 wp_nav_menu walker
 */

class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}