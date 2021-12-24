<?php 

function lp_bp_register_block_categories() {
    
    register_block_pattern_category(
        'lpbp',
        array(
            'label' => __( 'My Block Patterns', 'lp-bp' ),
            'icon' => 'admin-post',
        )
    );
    register_block_pattern_category(
        'cta',
        array(
            'label' => __( 'LP Block Patterns', 'lp-bp' ),
            'icon' => 'admin-post',
        )
    );
}
add_action( 'init', 'lp_bp_register_block_categories' );