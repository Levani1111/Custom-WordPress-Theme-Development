<?php 
/**
 * Plugin Name: Kamo Contact Form
 * Plugin URI: 
 * Description: A Kamo Simple Contact Form Plugin.
 * Version: 1.0
 * Author: Levani Papashvili
 * Author URI: http://www.levanipapashvili.com/
 * License: GPL2
 * Text Domain: kamo-contact-form
 */

    if(!defined('ABSPATH')){
        echo 'What are you trying to do ?';
    	exit;
    }
    
    class KamoContactForm {
      
        public function __construct(){
            // Create custom post type
            add_action('init', array($this, 'create_custom_post_type'));
            // add assets (css, js)
            add_action('wp_enqueue_scripts', array($this, 'load_assets'));
            // Add shortcode
            add_shortcode('kamo-contact-form', array($this, 'load_kamo_contact_form_shortcode'));
            //  Load JavaScript 
            add_action('wp_footer', array($this, 'load_scripts'));
            // register REST API
            add_action('rest_api_init', array($this, 'register_rest_api'));
            
        }
    
        public function create_custom_post_type(){
            $args = array(
                'public' => true,
                'has_archive' => true,
                'supports' => array('title'),
                'exclude_from_search' => true,
                'publicly_queryable' => false,
                'capability' => 'manage_options',
                'labels' => array(
                    'name' => 'Contact Form',
                    'singular_name' => 'Contact Form Etry',
                ),
                'menu_icon' => 'dashicons-format-aside',
            );
        register_post_type('kamo_contact_form', $args);
    }

    public function load_assets() {
        // load css
        wp_enqueue_style('kamo-contact-form', plugins_url('/css/kamo-contact-form.css', __FILE__), array(), '1.0.0', 'all');
        // load js
        wp_enqueue_script('kamo-contact-form', plugins_url('/js/kamo-contact-form.js', __FILE__), array('jquery'), '1.0.0', true);

    }

    // Shortcode Method
    public function load_kamo_contact_form_shortcode() 
    {?>
        <div class="kamo-contact-form">
                <h1>Send us an email</h1>
                <p>Please fill the below form</p>
                <form id="kamo-contact-form__form">
                    <div class="form-group mb-2">
                        <input name="name" type="text" id="name" placeholder="Name" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <input name="email" type="text" id="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <input name="phone" type="tel" id="phoe" placeholder="Phone" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <textarea name="message" id="message" placeholder="Type your message" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button id="send-message" class="btn btn-primary btn-block w-100">Send</button>
                    </div>
                </form>
        </div>
    <?php }

    public function load_scripts()
        {?> 
            <script>
                var nonce = '<?php echo wp_create_nonce("wp_rest"); ?>';
                (function($){
                    $('#kamo-contact-form__form').submit(function(event){
                        event.preventDefault();
                    var form = $(this).serialize();
                    
                    $.ajax({
                        method: 'post',
                        url: '<?php echo get_rest_url(null, 'kamo-contact-form/v1/send-email'); ?>',
                        headers: { 'X-WP-Nonce': nonce },
                        data: form,
                    })
                })

                })(jQuery);
                
            </script>
        
        <?php }

        Public function register_rest_api(){
            register_rest_route('kamo-contact-form/v1', 'send-email', array(
                'methods' => 'POST',
                'callback' => array($this, 'handle_contact_form'),
            ));
        }

        public function handle_contact_form($data) {
            $headers = $data->get_headers();
            $params = $data->get_params();
            $nonce = $headers['x_wp_nonce'][0];

            if(!wp_verify_nonce($nonce, 'wp_rest')){
                return new WP_REST_Response('Message not sent', 422);
            }

            $post_id = wp_insert_post([
                'post_type' => 'kamo_contact_form',
                'post_title' => 'Contact enquiry',
                'post_status' => 'publish',
            ]);

            if($post_id){
                return new WP_REST_Response('Thank you for your email', 200);
               
            }
        }
    

    
}
    
new KamoContactForm;