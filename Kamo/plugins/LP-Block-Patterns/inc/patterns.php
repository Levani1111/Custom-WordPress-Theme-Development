<?php 

function lp_bp_patterns(){
    include ('patterns-content.php');

    $patterns = array(
        'lp-block-patterns/cta' => array( 
            'title' => __( "Call to Action", 'lp-bp' ),
            'description' => _x( 'a 2-column CTA with button', 'lp-bp' ),
            'content' => $cta,
            'categories' => array( 'buttons', 'columns', 'cta', 'lp' ),
            'keywords' => array( 'cta', 'call to action', 'content upgrade' ),
            
        ),

        'lp-block-patterns/pricing-table' => array( 
            'title' => __( "Pricing Table", 'lp-bp' ),
            'description' => _x( 'a 3-column pricing table with buttons', 'lp-bp' ),
            'content' => $pricing_table,
            'categories' => array( 'buttons', 'columns', 'lp' ),
            'keywords' => array( 'cta', 'call to action', 'pricing table' ),
            
        ),

        'lp-block-patterns/bio-box' => array( 
            'title' => __( "Bio Box", 'lp-bp' ),
            'description' => _x( 'a 2-column author bio box with social icons', 'lp-bp' ),
            'content' => $bio_box,
            'categories' => array( 'buttons', 'columns', 'lp' ),
            'keywords' => array( 'bio', 'author', 'social' ),
        ),

        'lp-block-patterns/contact-card' => array( 
        'title' => __( "Contact Card", 'lp-bp' ),
        'description' => _x( 'a 2-column contact card with social icons', 'lp-bp' ),
        'content' => $contact_card,
        'categories' => array( 'buttons', 'columns', 'lp' ),
        'keywords' => array( 'bio', 'contact', 'social', 'address', 'phone', 'email' ),
        ),

        'lp-block-patterns/query' => array( 
            'title' => __( "3 Column Posts", 'lp-bp' ),
            'description' => _x( 'a 3-column post layout', 'lp-bp' ),
            'content' => $query,
            'categories' => array( 'query', 'columns', 'lp' ),
            'keywords' => array( 'posts', 'query', 'post layout' ),
        ),

        'lp-block-patterns/masthead' => array( 
        'title' => __( "Masthead", 'lp-bp' ),
        'description' => _x( 'a 3-column header layout', 'lp-bp' ),
        'content' => $masthead,
        'categories' => array( 'columns', 'header', 'lpbp', 'lp' ),
        'keywords' => array( 'masthead', 'header', 'site info' ),
        ),

        'lp-block-patterns/currently-listening' => array( 
            'title' => __( "Currently Listening", 'lp-bp' ),
            'description' => _x( 'An embed widget to show what we are listening to', 'lp-bp' ),
            'content' => $listening,
            'categories' => array( 'text', 'lpbp', 'lp' ),
            'keywords' => array( 'music', 'embed', 'mood' ),
        ),

        'lp-block-patterns/hero' => array( 
        'title' => __( "Hero Section", 'lp-bp' ),
        'description' => _x( 'A cover block with text and a button for a CTA', 'lp-bp' ),
        'content' => $hero,
        'categories' => array( 'text', 'header', 'cta', 'lp' ),
        'keywords' => array( 'hero section', 'CTA', 'call to action' ),
        ),

        'lp-block-patterns/optin' => array( 
            'title' => __( "Content Upgrade", 'lp-bp' ),
            'description' => _x( 'A 2-column content upgrade with email optin', 'lp-bp' ),
            'content' => $optin,
            'categories' => array( 'columns', 'buttons', 'cta', 'lp' ),
            'keywords' => array( 'optin', 'email', 'CTA', 'call to action' ),
        ),
    );

    foreach ($patterns as $slug => $props){
        register_block_pattern($slug, $props);
    }
  
}
add_action('init', 'lp_bp_patterns');